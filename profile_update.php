<?php
session_start();
if (!isset($_SESSION['userAuth'])) {
	header('location: login.php');
	die();
}
require_once dirname(__FILE__) . '/autoload_path.php';

use App\Controllers\AuthController;

if ($_POST) {
	$update = new AuthController();
	$update->profileUpdate($_POST);
} else {
	header('location: profile.php');
}