<?php
	// start session
	session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Login - ITF Data Bank</title>

	<!-- Custom fonts for this template-->
	<link href="./assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
	      rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="./assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-danger">

<div class="container">

	<!-- Outer Row -->
	<div class="row justify-content-center">

		<div class="col-xl-10 col-lg-12 col-md-9">

			<div class="card o-hidden border-0 shadow-lg my-5">
				<div class="card-body p-0">
					<!-- Nested Row within Card Body -->
					<div class="row">
						<div class="col-lg-6 d-none d-lg-block bg-dark container">
							<h1 class="m-5 h1 text-capitalize text-gray-500 mb-4 text-center">Welcome</h1>
							<hr>
							<h1 class="m-5 h4 text-white" style="font-weight: 100; line-height: 2;">
								The ITF Data Bank System provides an interface for interacting with business
								intelligence, data, and reports generated to the Industrial Training Fund.
							</h1>
						</div>
						<div class="col-lg-6">
							<hr>
							<div class="col-sm-6" style="margin: 0 auto">
								<img class="img-fluid" alt="ITF Logo" src="./assets/img/itf-logo.png">
							</div>
							<div class="p-5">
								<div class="text-center">
									<h1 class="h1 text-capitalize text-dark mb-4">Data Bank System</h1>
								</div>
								<form class="user" name="signin" method="post" action="admin/processlogin.php">
									<div class="form-group">
										<input name="username" type="text" class="form-control form-control-user"
										       id="exampleInputEmail" aria-describedby="emailHelp"
										       placeholder="Enter Email Address...">
									</div>
									<div class="form-group">
										<input name="password" type="password" class="form-control form-control-user"
										       id="exampleInputPassword" placeholder="Password">
									</div>
									<div class="form-group">
										<div class="custom-control custom-checkbox small">
											<input type="checkbox" class="custom-control-input" id="customCheck">
											<label class="custom-control-label" for="customCheck">Remember Me</label>
										</div>
									</div>
									<input type="submit" value="Login" name="login" href="header.html"
									       class="btn btn-primary btn-user btn-block"/>
									<hr>
								</form>
								<!-- <div class="text-center">
									<a class="small" href="#forgot-password">Forgot Password?</a>
								</div>
								<div class="text-center">
									<a class="small" href="#register">Create an Account!</a>
								</div> -->
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

	</div>

</div>

<?php
	if(isset($_SESSION['user_name'])){
		$logged_out = "UPDATE staff_reg SET logged_users='0' WHERE username='".$_SESSION['user_name']."'";
		$loggedResult = mysqli_query($GLOBALS["___mysqli_ston"], $logged_out); //echo $logged_out; exit;
		session_destroy();
	}
?>

<!-- Bootstrap core JavaScript-->
<script src="./assets/vendor/jquery/jquery.min.js"></script>
<script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="./assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="./assets/js/sb-admin-2.min.js"></script>

</body>

</html>
