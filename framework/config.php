<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__ . DS);

define('IS_LOCAL', in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']) ? true : false);
define('URL', IS_LOCAL ? 'http://frameworkphp.zdes/' : 'ROMOTE_URL');

define('DB_HOST', IS_LOCAL ? 'localhost' : 'REMOTE_HOST');
define('DB_USER', IS_LOCAL ? 'zama' : 'REMOTE_USER');
define('DB_PASS', IS_LOCAL ? '1234' : 'REMOTE_PASS');
define('DB_NAME', IS_LOCAL ? 'framework' : 'REMOTE_DB');

define('CLASSES', ROOT . 'classes' . DS);
define('CLASSES_PATH', ROOT . '..' . DS);

define('RESOURCES', ROOT . 'resources' . DS);
define('LAYOUTS', RESOURCES . 'layouts' . DS);
define('VIEWS', RESOURCES . 'views' . DS);
define('HELPERS', RESOURCES . 'helpers' . DS);
?>
