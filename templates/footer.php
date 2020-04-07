		</main>

		<footer class="bg-dark p-3">
			<p class="text-white mt-2 text-center h5">&copy; <?= date('Y'); ?> <a href="https://www.facebook.com/abdulmajidweb" target="_blank" class="text-white"><em>Abdul Majid</em></a></p>
		</footer>

	</div>

	<!-- jquery -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<!-- bootstrap js -->
	<script src="assets/js/bootstrap.min.js"></script>
	<!-- sweet alert js -->
	<script type="text/javascript" src="assets/js/sweetalert.min.js"></script>

	<?php
	if (isset($_SESSION['message']) AND isset($_SESSION['alert-type'])) { ?>
		<script>
			swal("", "<?= $_SESSION['message']; ?>", "<?= $_SESSION['alert-type'] ?>");
		</script>
	<?php
		unset($_SESSION['message']);
		unset($_SESSION['alert-type']);
	}
	?>

	<script>
		//logout return confirm message**********
		$(document).on("click", "#logout", function(e){
		e.preventDefault();
			var link = $(this).attr("href");
			swal({
				title: "Are you want to logout?",
				text: "Click Yes to logout!",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes!",
				cancelButtonText: "No!",
				closeOnConfirm: false,
				closeOnCancel: false
			},
			function(isConfirm) {
				if (isConfirm) {
				window.location.href = link;
				} else {
				swal("Cancelled", "Continue to login...!", "success");
				}
			});
		});

		//delete account return confirm message**********
		$(document).on("click", "#delete_account", function(e){
		e.preventDefault();
			var link = $(this).attr("href");
			swal({
				title: "Are you ready?",
				text: "if you click Yes, Your account will be permanently delete!",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes!",
				cancelButtonText: "No!",
				closeOnConfirm: false,
				closeOnCancel: false
			},
			function(isConfirm) {
				if (isConfirm) {
				window.location.href = link;
				} else {
				swal("Cancelled", "Safe your account!", "success");
				}
			});
		});
	</script>

</body>
</html>