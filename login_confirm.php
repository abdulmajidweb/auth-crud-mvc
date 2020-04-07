<?php
session_start();
require_once dirname(__FILE__) . '/autoload_path.php';

use App\Controllers\AuthController;

if ($_POST) {
	$login = new AuthController();
	$login->login($_POST);
} else {
	header('location: login.php');
}