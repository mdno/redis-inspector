<code><?php echo "$command $curkey [$type]"?></code>

<h3>value:</h3>
<output>
<?php
switch ($type) 
{
	case 'string':
		echo $value;
	
		break;
	
	case 'list':
		echo "<ul>";
		foreach ($value  as $v)
			echo "<li>$v</li>";
		echo "</ul>";

		break;

	case 'set':
		echo "<ul>";
		foreach ( $value as $v)
			echo "<li>$v</li>";
		echo "</ul>";

		break;

	case 'set':
		echo implode(', ', $value);

		break;
	
	case 'zset':
		echo "<ol>";
		foreach ( $value as $k => $v)
			echo "<li>$k -> $v</li>";
		echo "</ol>";
	
		break;
	
	case 'hash':
		echo "<ul>";
		foreach ( $value as $k => $v)
			echo "<li>$k -> $v</li>";
		echo "</ul>";
		
		break;

} ?>
</output>
<code class="meta">Time to live: <?php echo ($ttl>0 ? "$ttl seconds. Will expire at ".date('r', time() + $ttl) : "&#8734;")?></code>