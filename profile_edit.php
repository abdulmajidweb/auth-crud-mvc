<?php
session_start();
if (!isset($_SESSION['userAuth'])) {
	header('location: login.php');
}
require_once dirname(__FILE__) . '/autoload_path.php';
require_once dirname(__FILE__) . '/templates/header.php';
?>

	<div class="card">
		<div class="card-header text-center">
			<h5>Edit Profile Information</h5>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-6 m-auto">
					<form action="<?php echo htmlspecialchars('profile_update.php');?>" method="POST" class="was-validated">
						<label for="name">Name</label>
						<input type="text" name="name" class="form-control form-control-sm" value="<?= $_SESSION['userAuth']['name'] ?>" required="">
						<p class="text-danger m-0"><?= isset($_SESSION['form_error']['name_error']) ? $_SESSION['form_error']['name_error'] : '' ?></p>

						<label for="email">E-mail</label>
						<input type="email" name="email" class="form-control form-control-sm" value="<?= $_SESSION['userAuth']['email'] ?>" required="">
						<p class="text-danger m-0"><?= isset($_SESSION['form_error']['email_error']) ? $_SESSION['form_error']['email_error'] : '' ?></p>

						<label for="old_password">Old Password</label>
						<input type="password" name="old_password" class="form-control form-control-sm">
						<p class="text-danger m-0"><?= isset($_SESSION['form_error']['old_password_error']) ? $_SESSION['form_error']['old_password_error'] : '' ?></p>

						<label for="new_password">New Password</label>
						<input type="password" name="new_password" class="form-control form-control-sm">

						<label for="confirm_password">Confirm Password</label>
						<input type="password" name="confirm_password" class="form-control form-control-sm">
						
						<button type="submit" class="btn btn-outline-info btn-sm mt-2">Save</button>
					</form>
					<?php
					if (isset($_SESSION['form_error'])) {
						unset($_SESSION['form_error']);
					}
					?>
				</div>
			</div>			
		</div>
	</div>

<?php require_once dirname(__FILE__) . '/templates/footer.php'; ?>