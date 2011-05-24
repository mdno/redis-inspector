<?php

class KeysController extends BaseController {
	
	protected $controller = 'keys';
	
	public function __construct($args)
	{	
		parent::__construct($args);
		
		if (!class_exists("Redis"))
		{
			$this->raiseError("Class Redis not found.");
			return;
		}
		
		try
		{
			$this->Redis = new Redis();
			@$this->Redis->connect(REDIS_HOST, REDIS_PORT);
			$this->Redis->select(REDIS_DB);
		}
		catch (RedisException $e)
		{
			$this->raiseError("Could not connect. Redis says: '{$e->getMessage()}'. Please check config.php.");
		}
	}
		
	protected function index()
	{
		$prefix = ( !isset($_GET['prefix']) ? PREFIX : $_GET['prefix'].SEPARATOR );
				
		$keys = $this->Redis->keys($prefix."*");		

		$this->data = array('total' => count($keys), 'curkey' => $prefix.'*', 'keys' => array());

		if (empty($keys))
		{
			return;
		}
		
		foreach ($keys as $key)
		{
			$levels = explode(SEPARATOR, $prefix ? str_replace($prefix, "", $key) : $key);
			$index_name = $prefix.$levels[0];			
			$index_keys[ $index_name ]['name'] = $index_name;	
		}
		
		foreach ($index_keys as $k => $index_key)
		{
			$index_keys[$k]['type'] = $this->getType($index_key['name']);
		}
		
		$this->data['keys'] = $index_keys;		
	}

	protected function key()
	{
		$key = $_GET['key'];
		
		$this->data = array('curkey' => $key, 'type' => $this->getType($key));
		
		$this->data['ttl'] = $this->Redis->ttl($key);
		
		switch ($this->data['type'])
		{
			case 'string':
				$this->data['value'] = $this->Redis->get($key);
				$this->data['command'] = 'GET';
				break; 

			case 'set':
				$this->data['value'] = $this->Redis->smembers($key);
				$this->data['command'] = 'SMEMBERS';
				break; 

			case 'list':
				$this->data['value'] = $this->Redis->lrange($key, 0, LIST_LIMIT);
				$this->data['command'] = 'LRANGE';
				break; 

			case 'zset':
				$this->data['value'] = $this->Redis->zrevrange($key, 0, LIST_LIMIT, true);
				$this->data['command'] = 'ZREVRANGE';
				break;
				
			case 'hash':
				$this->data['value'] = $this->Redis->hgetall($key);
				$this->data['command'] = 'HGETALL';
				break; 
		}
	}
	
	private function getType($key)
	{
		switch ($this->Redis->type($key))
		{
			case Redis::REDIS_STRING:
				return 'string';

			case Redis::REDIS_SET:
				return 'set';
			
			case Redis::REDIS_LIST:
				return 'list'; 

			case Redis::REDIS_ZSET:
				return 'zset';
				
			case Redis::REDIS_HASH:
				return 'hash';
		}
	}
}