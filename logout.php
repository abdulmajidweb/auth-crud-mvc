<?php
session_start();
if (isset($_SESSION['userAuth'])) {
	unset($_SESSION['userAuth']);
	$_SESSION['message'] = 'Successfully logout!';
	$_SESSION['alert-type'] = 'success';
	header('location: login.php');
} else {
	header('location: login.php');
}