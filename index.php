<?php

require_once 'app/config/config.php';
require_once 'app/config/security.php';

error_reporting(DEBUG ? E_ALL : 0);
ini_set('display_errors', DEBUG);

require_once 'app/bootstrap.php';