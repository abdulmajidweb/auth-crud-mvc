<?php
session_start();
if (!isset($_SESSION['userAuth'])) {
	header('location: login.php');
	die();
}
require_once dirname(__FILE__) . '/autoload_path.php';

use App\Controllers\AuthController;

$delete = new AuthController();
$delete->deleteAccount();

unset($_SESSION['userAuth']);
$_SESSION['message'] = 'Permanently deleted your account!';
$_SESSION['alert-type'] = 'success';
header('location: register.php');