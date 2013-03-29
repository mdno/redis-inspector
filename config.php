<?php

if (isset($_POST['reset'])) {
	$_POST['separator'] = $_SESSION['separator'] = null;
	$_POST['prefix'] = $_SESSION['prefix'] = null;
	$_POST['limit'] = $_SESSION['limit'] = null;
	$_POST['db'] = $_SESSION['db'] = null;
	$_POST['host'] = $_SESSION['host'] = null;
	$_POST['port'] = $_SESSION['port'] = null;
}

/**
 * Load config
 */
function get_config($name, $default = null) {
	if (isset($_POST[$name])) {
		return $_POST[$name];
	}

	if (isset($_SESSION[$name])) {
		return $_SESSION[$name];
	}

	return $default;
};

define('SEPARATOR', $_SESSION['separator'] = get_config('separator', ':'));

define('PREFIX', $_SESSION['prefix'] = get_config('prefix', ''));

define('LIST_LIMIT', $_SESSION['limit'] = (int) get_config('limit', -1));

define('REDIS_DB', $_SESSION['db'] = (int) get_config('db', 0));

define('REDIS_HOST', $_SESSION['host'] = get_config('host', '127.0.0.1'));

define('REDIS_PORT', $_SESSION['port'] = (int) get_config('port', 6379));
