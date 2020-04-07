<?php
session_start();
require_once dirname(__FILE__) . '/autoload_path.php';

use App\Controllers\AuthController;

if ($_POST) {
	$register = new AuthController();
	$register->register($_POST);
} else {
	header('location: register.php');
}