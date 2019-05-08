<?php
session_start();

if (!isset($_SESSION['user_id']))
	header("Location: ../index.php");

include_once 'alertFunctions.php';

$id = $_SESSION['user_id'];
function isLogged()
{
	if ($_SESSION['user_name']) { # When logged in this variable is set to TRUE
		return TRUE;
	} else {
		return FALSE;
	}
}

# Log a user Out
function logOut()
{
	$_SESSION = array();
	if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time() - 42000, '/');
	}
	session_destroy();
}

# Session Logout after in activity
function sessionX()
{
	$logLength = 60; # time in seconds :: 1800 = 30 minutes
	$ctime = strtotime("now"); # Create a time from a string
	# If no session time is created, create one
	if (!isset($_SESSION['user_name'])) {
		# create session time
		$_SESSION['user_name'] = $ctime;
	} else {
		# Check if they have exceded the time limit of inactivity
		if (((strtotime("now") - $_SESSION['user_name']) > $logLength) && isLogged()) {
			# If exceded the time, log the user out
			logOut();
			# Redirect to login page to log back in
			header("Location:../index.php");
			exit;
		} else {
			# If they have not exceded the time limit of inactivity, keep them logged in
			$_SESSION['user_name'] = $ctime;
		}
	}
}

include("../includes/connections.php");

$query = "SELECT * FROM staff_reg where id = $id";
$result = mysqli_query($connect, $query);

while ($row = mysqli_fetch_assoc($result)) {
	$fullname = $row['first_name'] . " " . $row['last_name'];
	$title = $row['title_id'];
	$username = $row['username'];
	$office_type = $row['office_type'];
	$office_location = $row['office_location'];
	$access_right = $row['access_right'];
	$department = $row['department'];
	$section = $row['section_id'];
	$division = $row['div_id'];
	$unit = $row['unit'];
	$sub_unit = $row['sub_unit'];
}

$query_title = "SELECT * FROM title where title_id = $title";
$result_title = mysqli_query($connect, $query_title);

while ($row_title = mysqli_fetch_array($result_title)) {
	$tit = $row_title[1];
}

$query_office = "SELECT type FROM office_type where id = $office_type";
$result_office = mysqli_query($connect, $query_office);

while ($row_office = mysqli_fetch_assoc($result_office)) {
	$office_name = $row_office['type'];
}

$query_office = "SELECT * FROM area_office where office_type_id = $office_type and id = $office_location";
$result_office = mysqli_query($connect, $query_office);

while ($row_office = mysqli_fetch_array($result_office)) {
	$office_loc = $row_office['2'];
}

$query_access = "SELECT * FROM assess_right where right_id = $access_right";
$result_access = mysqli_query($connect, $query_access);

?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>ITF Data Bank</title>

	<!-- Custom fonts for this template-->
	<link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
	      rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">


	<!-- OLD ASSETS BEGINS -->

	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- jvectormap -->
	<link rel="stylesheet" href="../old_assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">

	<!-- AdminLTE Skins. Choose a skin from the css/skins
		 folder instead of downloading all of them to reduce the load. -->
	<!-- iCheck -->
	<link rel="stylesheet" href="../old_assets/plugins/iCheck/flat/blue.css">
	<!-- Morris chart -->
	<link rel="stylesheet" href="../old_assets/plugins/morris/morris.css">
	<!-- jvectormap -->
	<link rel="stylesheet" href="../old_assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
	<!-- Date Picker -->
	<link rel="stylesheet" href="../old_assets/plugins/datepicker/datepicker3.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="../old_assets/plugins/daterangepicker/daterangepicker-bs3.css">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="../old_assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- OLD ASSETS ENDS -->

	<style>
		p > input {
			margin-left: 20px;
		}
	</style>

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

	<!-- Sidebar -->
	<ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

		<!-- Sidebar - Brand -->
		<a class="sidebar-brand d-flex align-items-center justify-content-center h-auto" href="../admin/home.php">
			<img src="../assets/img/itf-logo.png" class="w-75" alt="">
		</a>

		<!-- Divider -->
		<hr class="sidebar-divider my-0">

		<!-- Nav Item - Dashboard -->
		<li class="nav-item active">
			<a class="nav-link" href="../admin/home.php">
				<i class="fas fa-fw fa-tachometer-alt"></i>
				<span>Dashboard</span></a>
		</li>

		<!-- Divider -->
		<hr class="sidebar-divider">

		<!-- Heading -->
		<div class="sidebar-heading">
			Reports
		</div>

		<!-- Nav Item - Pages Collapse Menu -->
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
			   aria-expanded="true" aria-controls="collapseTwo">
				<i class="fas fa-fw fa-calendar-check"></i>
				<span>Monthly Report</span>
			</a>
			<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<!--<h6 class="collapse-header">Custom Components:</h6>-->
					<a class="collapse-item" href="../admin/report.php">Add Report</a>
					<a class="collapse-item" href="../admin/vet_report.php">Edit Report</a>
					<a class="collapse-item" href="../admin/view_report.php">View Report</a>
					<a class="collapse-item" href="../admin/query_report.php">Query Report</a>
				</div>
			</div>
		</li>

			<li class="nav-item">
				<a class="nav-link" href="../admin/special_rpt.php?id=admin">
					<i class="fas fa-fw fa-sitemap"></i>
					<span>Departmental Reports</span></a>
			</li>

		<!-- Nav Item - Utilities Collapse Menu -->
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#areaoffice"
			   aria-expanded="true" aria-controls="collapseUtilities">
				<i class="fab fa-fw fa-readme"></i>
				<span>Area Office Report</span>
			</a>
			<div id="areaoffice" class="collapse" aria-labelledby="headingUtilities"
			     data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="../admin/arearep.php">Executive Summary</a>
					<a class="collapse-item" href="../admin/meeting.php">Add Minutes of Meeting</a>
					<a class="collapse-item" href="../admin/view_meeting.php">View Minute of Meeting</a>
				</div>
			</div>
		</li>

		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#otherreports"
			   aria-expanded="true" aria-controls="collapseUtilities">
				<i class="fas fa-fw fa-book-reader"></i>
				<span>Other Reports</span>
			</a>
			<div id="otherreports" class="collapse" aria-labelledby="headingUtilities"
			     data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="../admin/add_procurement.php">Create Procurement <br> Report</a>
					<a class="collapse-item" href="../admin/view_procurement.php">All Procurement Reports</a>
					<a class="collapse-item" href="../admin/add_legal.php">Create Legal Report</a>
					<a class="collapse-item" href="../admin/view_legals.php">All Legal Reports</a>
					<a class="collapse-item" href="../admin/add_vehicle.php">ITF Utility Vehicle Data</a>
					<a class="collapse-item" href="../admin/view_vehicle.php">All Vehicles</a>
				</div>
			</div>
		</li>


		<!-- Divider -->
		<hr class="sidebar-divider">

		<!-- Heading -->
		<div class="sidebar-heading">
			Organisation
		</div>

		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
			   aria-expanded="true" aria-controls="collapseUtilities">
				<i class="fas fa-fw fa-chart-line"></i>
				<span>Career Development</span>
			</a>
			<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
			     data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="../admin/add_nominal.php">Add Staff</a>
					<a class="collapse-item" href="../admin/view_nominal.php">Nominal Roll</a>
					<a class="collapse-item" href="../admin/view_archive.php">Retired Staff List</a>
				</div>
			</div>

		</li>

		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
			   aria-expanded="true" aria-controls="collapsePages">
				<i class="fas fa-fw fa-code-branch"></i>
				<span>Work Plan</span>
			</a>
			<div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="../admin/itf_prog.php">Work Plans</a>
					<a class="collapse-item" href="../admin/add_itf_programmes.php">Create Training <br>Programme</a>
					<a class="collapse-item" href="../admin/view_itf_programmes.php">All ITF Training <br> Programmes</a>
				</div>
			</div>
		</li>

		<li class="nav-item">
			<a class="nav-link" href="../admin/admin_log.php">
				<i class="fas fa-fw fa-sitemap"></i>
				<span>Manage Organisation</span>
			</a>
		</li>

		<!-- Divider -->
		<hr class="sidebar-divider">

		<!-- Heading -->
		<div class="sidebar-heading">
			Control Panel
		</div>

		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#settings"
			   aria-expanded="true" aria-controls="collapseUtilities">
				<i class="fas fa-fw fa-wrench"></i>
				<span>Settings</span>
			</a>
			<div id="settings" class="collapse" aria-labelledby="headingUtilities"
			     data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="../admin/new_user.php">Add New User</a>
					<a class="collapse-item" href="../admin/manage_account.php">Manage User Accounts</a>
					<a class="collapse-item" href="../admin/registered.php">Registered Users</a>
					<a class="collapse-item" href="../admin/pword_change.php">Reset Password</a>
					<!--<a class="collapse-item" href="#">Backup Database</a>-->
					<a class="collapse-item" href="../admin/change_role.php">Change Login Role</a>
					<a class="collapse-item" href="../admin/UsersStatus.php">User Status</a>
					<a class="collapse-item" href="../admin/log_latest.php">Latest User Log</a>
					<a class="collapse-item" href="../admin/log_all.php">All User Log</a>
				</div>
			</div>
		</li>

		<li class="nav-item">
			<a class="nav-link" href="../admin/signout.php" data-target="#logoutModal">
				<i class="fas fa-fw fa-sign-out-alt"></i>
				<span>Logout</span></a>
		</li>


		<!-- Divider -->
		<hr class="sidebar-divider d-none d-md-block">

		<!-- Sidebar Toggler (Sidebar) -->
		<div class="text-center d-none d-md-inline">
			<button class="rounded-circle border-0" id="sidebarToggle"></button>
		</div>

	</ul>
	<!-- End of Sidebar -->

	<!-- Content Wrapper -->
	<div id="content-wrapper" class="d-flex flex-column">

		<!-- Main Content -->
		<div id="content">

			<!-- Topbar -->
			<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

				<!-- Sidebar Toggle (Topbar) -->
				<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
					<i class="fa fa-bars"></i>
				</button>

				<h1 class="h3 mb-0 text-gray-800">ITF Data Bank System</h1>

				<!-- Topbar Search -->
				<!--<form
						class="float-right d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
					<div class="input-group">
						<input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
							   aria-label="Search" aria-describedby="basic-addon2">
						<div class="input-group-append">
							<button class="btn btn-danger" type="button">
								<i class="fas fa-search fa-sm"></i>
							</button>
						</div>
					</div>
				</form>-->

				<!-- Topbar Navbar -->
				<ul class="navbar-nav ml-auto">

					<!-- Nav Item - Search Dropdown (Visible Only XS) -->
					<li class="nav-item dropdown no-arrow d-sm-none">
						<a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
						   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-search fa-fw"></i>
						</a>
						<!-- Dropdown - Messages -->
						<div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
						     aria-labelledby="searchDropdown">
							<form class="form-inline mr-auto w-100 navbar-search">
								<div class="input-group">
									<input type="text" class="form-control bg-light border-0 small"
									       placeholder="Search for..." aria-label="Search"
									       aria-describedby="basic-addon2">
									<div class="input-group-append">
										<button class="btn btn-primary" type="button">
											<i class="fas fa-search fa-sm"></i>
										</button>
									</div>
								</div>
							</form>
						</div>
					</li>

					<div class="topbar-divider d-none d-sm-block"></div>

					<!-- Nav Item - User Information -->
					<li class="nav-item dropdown no-arrow">
						<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
						   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<div class="col">
								<p class="text-dark mb-0"> <?php echo $tit . " " . $fullname ?> </p>
								<span class=" text-gray-600 small">
									<?php
										while ($row_access = mysqli_fetch_array($result_access)) {
											echo  $row_access[1];
										}
									?>
								</span>
							</div>
							<img class="img-profile rounded-circle" src="../assets/img/person-icon.png">
						</a>
						<!-- Dropdown - User Information -->
						<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
						     aria-labelledby="userDropdown">
							<a class="dropdown-item" href="#">
								<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
								Settings
							</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="../admin/signout.php" data-toggle="modal"
							   data-target="#logoutModal">
								<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
								Logout
							</a>
						</div>
					</li>

				</ul>

			</nav>
			<!-- End of Topbar -->

			<!-- Begin Page Content -->
			<div class="container-fluid">
				<!-- Page Heading -->


