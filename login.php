<?php
session_start();
if (isset($_SESSION['userAuth']) AND $_SESSION['userAuth']['login'] == TRUE) {
	header('location: index.php');
}
require_once dirname(__FILE__) . '/autoload_path.php';
require_once dirname(__FILE__) . '/templates/header.php';
?>

	<div class="card">
		<div class="card-header text-center">
			<h5>Login Now!</h5>
		</div>
		<div class="card-body">
			
			<div class="row">
				<div class="col-md-6 m-auto">
					<form action="<?php echo htmlspecialchars('login_confirm.php');?>" method="POST" class="was-validated">

						<label for="email">E-mail</label>
						<input type="email" name="email" class="form-control form-control-sm" required="">
						<p class="text-danger m-0"><?= isset($_SESSION['form_error']['email_error']) ? $_SESSION['form_error']['email_error'] : '' ?></p>

						<label for="password">Password</label>
						<input type="password" name="password" class="form-control form-control-sm" required="">
						<p class="text-danger m-0"><?= isset($_SESSION['form_error']['password_error']) ? $_SESSION['form_error']['password_error'] : '' ?></p>
						
						<button type="submit" class="btn btn-outline-info btn-sm mt-2">Login</button>
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