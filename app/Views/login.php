<!DOCTYPE html>
<html lang="en">

<head>
	<?php $session = session(); ?>
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12">
			<?php
			if ($session->getFlashdata('error_registration')) { ?>
				<div class="alert alert-danger" role="alert">
					<?php echo $session->getFlashdata('error_registration'); ?>
				</div>
			<?php
			}

			?>

		</div>
	</div>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

	<title>Sign In | Eseo CRM</title>

	<link href="<?= base_url(); ?>assets/css/app.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/css/custom.css" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Welcome back!</h1>
							<p class="lead">
								Sign in to your account to continue
							</p>
						</div>

						<div class="card">
							<div class="card-logo">
								<img src="<?= base_url() ?>assets/img/logo/eseologo.png">
							</div>
							<div class="card-body">
								<div class="m-sm-3">
									<form id="login-form" method="post" action="<?= base_url() ?>logining-in">

										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email" />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" />
										</div>
										<div>
											<div class="form-check align-items-center">
												<input id="customControlInline" type="checkbox" class="form-check-input" value="remember-me" name="remember-me" checked>
												<label class="form-check-label text-small" for="customControlInline">Remember me</label>
											</div>
										</div>
										<div class="d-grid gap-2 mt-3">
											<button type="submit" class="btn btn-lg btn-primary remember-btn">Login</button>

										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="<?= base_url() ?>assets/js/app.js"></script>
	<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

	<!-- <script>
		jQuery.validator.addMethod('check_phone',
			function(value, element) {
				return this.optional(element) || /^[0-9]{10}$/i.test(value);
			},
			'Enter valid phone number'
		);
		jQuery.validator.addMethod(
			'letters',
			function(value, element) {
				return this.optional(element) || /^[a-zA-Z\s]+$/i.test(value);
			},
			'Letters only please'
		);
	</script> -->

	<script>
		$("#login-form").validate({
			rules: {
				email: {
					required: true,
					email: true
				},
				password: {
					required: true,

				}

			}
		});
	</script>

</body>

</html>