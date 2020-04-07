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
			<h5>Profile Information</h5>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-6 m-auto">
					<table class="table">
						<tr>
							<th>Name: </th>
							<td><?= isset($_SESSION['userAuth']) ? $_SESSION['userAuth']['name'] : '' ?></td>
						</tr>
						<tr>
							<th>Email: </th>
							<td><?= isset($_SESSION['userAuth']) ? $_SESSION['userAuth']['email'] : '' ?></td>
						</tr>
						<tr>
							<td></td>
							<td><a href="profile_edit.php" class="btn btn-outline-info btn-sm">Edit</a></td>
						</tr>
					</table>
				</div>
			</div>			
		</div>
	</div>

<?php require_once dirname(__FILE__) . '/templates/footer.php'; ?>