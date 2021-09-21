<?php

require_once 'kernel/kernel.php';
require_once 'kernel/request.php';
require_once 'kernel/db.php';
require_once 'kernel/db/mysql.php';
require_once 'kernel/model.php';
require_once 'kernel/view.php';
require_once 'kernel/controller.php';
require_once 'kernel/route.php';

spl_autoload_register( array('Kernel', 'loadClass') );

try {
	Route::init();
	Route::start();
} catch (Exception $e) {
	Route::error($e);
}