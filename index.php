<?php
session_start();
if (!isset($_SESSION['userAuth'])) {
	header('location: login.php');
}
require_once dirname(__FILE__) . '/autoload_path.php';
require_once dirname(__FILE__) . '/templates/header.php';
?>

<!-- user dashboard main content -->
<div class="jumbotron">
	<h1 class="display-4">Welcome <?= isset($_SESSION['userAuth']) ? $_SESSION['userAuth']['name'] : 'to dashboard' ?>!</h1>
	<p class="lead">This is a dashboard for user only. You can change everything your profile to here.</p>
	<hr class="my-4">
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt perferendis, inventore natus, repellat iusto dolore, labore vel impedit vero totam unde quod dolor voluptatibus aliquam velit sed et reiciendis nulla.</p>
	<a class="btn btn-dark btn-lg" href="profile.php" role="button">Go to Profile</a>
	<a id="delete_account" class="btn btn-dark btn-lg" href="delete_account.php" role="button">Delete My Account</a>
</div> <!-- end of user dashboard main content -->

<?php require_once dirname(__FILE__) . '/templates/footer.php'; ?>