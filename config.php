<?php

define('SEPARATOR', isset($_GET['separator']) ? $_GET['separator'] : ':');

define('PREFIX', isset($_GET['prefix']) ? $_GET['prefix'] : '');

define('LIST_LIMIT', isset($_GET['limit']) ? (int) $_GET['limit'] : -1);

define('REDIS_DB', isset($_GET['db']) ? (int) $_GET['db'] : 0);

define('REDIS_HOST', isset($_GET['host']) ? $_GET['host'] : 'localhost');

define('REDIS_PORT', isset($_GET['port']) ? (int) $_GET['port'] : 6379);
