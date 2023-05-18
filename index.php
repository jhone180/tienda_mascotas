<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
require_once 'libs/database.php';
require_once 'libs/controller.php';
require_once 'libs/view.php';
require_once 'libs/app.php';
require_once 'config/config.php';

$app = new App();

?>