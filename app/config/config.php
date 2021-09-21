<?php

define('DEBUG', true);

define('SITE_PATCH', '');
define('SITE_URL', '//'.$_SERVER['HTTP_HOST'].'/'.SITE_PATCH);
define('SITE_DIR', dirname( __FILE__ ) . '/../../');

define('DB_TYPE', 'mysql');
define('DB_HOST', 'YOUR HOST HERE');
define('DB_BASE', 'YOUR BASE HERE');
define('DB_USER', 'YOUR USER HERE');
define('DB_PASS', 'YOUR PASS HERE');

define('TEMPLATE_NAME', 'default');
define('TEMPLATE_URL', SITE_URL.'public/templates/'.TEMPLATE_NAME.'/');
