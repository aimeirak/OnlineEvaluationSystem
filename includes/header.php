<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Evaluation System</title>
		<link rel="stylesheet" href="bootstrap/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"type="text/css">
		<link rel="stylesheet" href="bootstrap/css/main.css">
		<script src="../bootstrap/js/main.js"></script>
		<script type="text/javascript" src="bootstrap/jquery-3.3.1.min.js"></script>
   <link rel="stylesheet" type="text/css" href="assets/jquery-ui/jquery-ui.min.css">
   <link type="text/css" rel="stylesheet" href="assets/plugins/fileinput/css/fileinput.min.css">
   <script type="text/javascript" src="assets/jquery-ui/jquery-ui.min.js"></script>
   <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="assets/plugins/fileinput/js/plugins/canvas-to-blob.min.js"></script>
   <script type="text/javascript" src="assets/plugins/fileinput/js/plugins/sortable.min.js"></script>
   <script type="text/javascript" src="assets/plugins/fileinput/js/plugins/purify.min.js"></script>
   <script type="text/javascript" src="assets/plugins/fileinput/js/fileinput.min.js"></script>
   <script type="text/javascript" src="assets/plugins/DataTables-1.10.16/dataTables.min.js"></script>
   <link type="text/css" rel="stylesheet" href="assets/plugins/DataTables-1.10.16/dataTables.min.css">
	</head>
	<body>				
		<div class="header" style="position:fixed;" class="bg-primary">
			<div class="logo">
				<i class="fa fa-tachometer"></i>
				<span>Evaluate</span>
			</div>
			<a href="#" class="nav-trigger"><span></span></a>
			<i style="padding-left:40%;font-size:30px; color:#6A9AF5;"> </span>Trainers Evaluation Information Management System</i>
		</div>
		<div class="side-nav">
			<div class="logo">
				<i class="fa fa-tachometer" style="color:#fff;"></i>
				<a href="index.php"><span style="color:#fff;">Evaluation</span></a>
			</div>
			<nav>
				<ul>
				<?php
					if($_SESSION['user_type'] == 1){
						echo'<li>
							<a href="student.php">
								<span><i class="fa fa-user"></i></span>
								<span>Student</span>
							</a>
						</li>
						<li>
							<a href="course.php">

								<span><i class="fa fa-envelope"></i></span>
								<span>course</span>
							</a>
						</li>
						<li>
							<a href="lecturer.php">
								<span><i class="glyphicon glyphicon-education"></i></span>
								<span>Trainer</span>
							</a>
						</li>
						<li>
							<a href="Departement.php">
								<span><i class="fa fa-credit-card-alt"></i></span>
								<span>Departement</span>
							</a>
						</li>
						<li>
							<a href="add_admin.php">
								<span><i class="glyphicon glyphicon-plus"></i></span>
								<span>Add Users</span>
							</a>
						</li>
						<li class="link">
							<a href="#collapse1" data-toggle="collapse">
								<i class="glyphicon glyphicon-print"></i><span>Reports</span>
							</a>
							<div id="collapse1" class="collapse">
								<ul class="link-menu" id="more" class="collapse" >
									<li class="" style="list-style:none;"><a href="studentReport.php"><i class="fa fa-circle-o"></i> Student</a></li>
									<li style="list-style:none;"><a href="LecturerReport.php"><i class="fa fa-circle-o"></i>Trainer</a></li>
									<li style="list-style:none;"><a href="departementReport.php"><i class="fa fa-circle-o"></i>Departement</a></li>
									<li style="list-style:none;"><a href="courseReport.php"><i class="fa fa-circle-o"></i> course</a></li>
									<li style="list-style:none;"><a href="evaluation_report.php"><i class="fa fa-circle-o"></i>Evaluation Report</a></li>
								</ul>
							</div>
						</li>';
					}
					if($_SESSION['user_type'] == 2){
						echo'
						<li>
							<a href="lecturer.php">
								<span><i class="glyphicon glyphicon-education"></i></span>
								<span>lecturer</span>
							</a>
						</li>
							<li class="link">
							<a href="#collapse1" data-toggle="collapse">
								<i class="glyphicon glyphicon-print"></i><span>Reports</span>
							</a>
							<div id="collapse1" class="collapse">
								<ul class="link-menu" id="more" class="collapse" >
									<li class="" style="list-style:none;"><a href="studentReport.php"><i class="fa fa-circle-o"></i> Student</a></li>
									<li style="list-style:none;"><a href="LecturerReport.php"><i class="fa fa-circle-o"></i>Trainer</a></li>
									<li style="list-style:none;"><a href="departementReport.php"><i class="fa fa-circle-o"></i>Departement</a></li>
									<li style="list-style:none;"><a href="courseReport.php"><i class="fa fa-circle-o"></i> course</a></li>
									<li style="list-style:none;"><a href="evaluation_report.php"><i class="fa fa-circle-o"></i>Evaluation Report</a></li>
								</ul>
							</div>
						</li>
						';
					}
					if($_SESSION['user_type'] == 3){
						echo'
						<li>
							<a href="student.php">
								<span><i class="fa fa-user"></i></span>
								<span>Student</span>
							</a>
						</li>
						<li> 
							<a href="Evaluation.php">
								<span><i class="glyphicon glyphicon-cog"></i></span>
								<span>Evaluation Form</span>
							</a>
						</li>';
					}
				?>
				
					<li id="topNavLogout"><a href="<?php echo 'login.php?LogOut' ?>"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
				</ul>
			</nav>
		</div>
		<script type="text/javascript" src="bootstrap/js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript" src="assets/jquery/jquery-3.3.1.min.js"></script>	
