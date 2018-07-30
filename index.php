<?php 
	session_start();
    if(!isset($_SESSION['userid'])){
        header('LOCATION:login.php');
    }
	include 'includes/header.php';
	include 'php_action/connect.php';
	$student = mysql_query('select COUNT(student_id) from student where action<>1');
	$row_student = mysql_fetch_array($student);
	$lecturer = mysql_query('select COUNT(lecturer_id) from lecturer where  action<>1');
	$row_lecturer = mysql_fetch_array($lecturer);

	$alll = mysql_query('select COUNT(course_id) from course where action<>1');
	$row_course = mysql_fetch_array($alll);

	$alld = mysql_query('select COUNT(dept_id) from departement where action<>1');
	$row_departement = mysql_fetch_array($alld);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Evluation System</title>
		<link rel="stylesheet" href="bootstrap/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"type="text/css">
		<link rel="stylesheet" href="bootstrap/css/main.css">
		<script src="bootstrap/js/main.js"></script>
	</head>
	<body>
			<div class="container">
				<?php if ($_SESSION['user_type'] == 3) {
					 echo '';
				}?>
				<?php 

				if($_SESSION['user_type']==1){
					$student_number= $row_student[0];
					echo '<div class="main" style="padding-top:10px;">
					<div class="panel panel-default" style="width:23%;margin-left:10px;">
				        <div class="panel-heading"><span>Student Information</span></div>
				        <div class="panel-body">
				            <div class="row">
				                <div class="col-sm-12">
				                	<span style="font-weight:bold;color:;font-size:30px;">Total Student:<span style="font-weight:bolder;" class="text text-primary text-col-lg-10">'.$row_student[0].'</span></span>
				                 </div>     
				            </div>
			            </div>
			            <div class="panel-footer">
			            	<span></span>
			            </div>
			       </div>
			       <div class="panel panel-default" style="width:23%; margin-left:10px;" >
				        <div class="panel-heading"><span>Lecturer Information</span></div>
				        <div class="panel-body">
				            <div class="row">
				                <div class="col-sm-12">
				                	<span style="font-weight:bold;color:;font-size:29px;">lecturer:<span style="font-weight:bolder;" class="text text-primary text-col-lg-10">'.$row_lecturer[0].'</span></span>
				                 </div>     
				            </div>
			            </div>
			            <div class="panel-footer">
			            	<span></span>
			            </div>
			       </div>
			       <div class="panel panel-default" style="width:23%; margin-left:10px;">
				        <div class="panel-heading"><span>Course Information</span></div>
				        <div class="panel-body">
				            <div class="row">
				                <div class="col-sm-12">
				                	<span style="font-weight:bold;color:;font-size:30px;">Total Course:<span style="font-weight:bolder;" class="text text-primary text-col-lg-">'.$row_course[0].'</span></span>
				                 </div>     
				            </div>
			            </div>
			            <div class="panel-footer">
			            	<span></span>
			            </div>
			       </div>
			       <div class="panel panel-default" style="width:23%; margin-left:10px;" >
				        <div class="panel-heading"><span>Departement Information</span></div>
				        <div class="panel-body">
				            <div class="row">
				                <div class="col-sm-12">
				                	<span style="font-weight:bold;color:;font-size:30px;">Total Departement:<span style="font-weight:bolder;" class="text text-primary text-col-lg-10">'.$row_departement[0].'</span></span>
				                 </div>     
				            </div>
			            </div>
			            <div class="panel-footer">
			            	<span></span>
			            </div>

			       </div> 
			     </div> 
			     <ul class="nav nav-tabs nav-justified">
  					<li class="active"><a data-toggle="tab" href="#vision">Home</a></li>
				  	<li><a data-toggle="tab" href="#menu1">mission</a></li>
				  	<li><a data-toggle="tab" href="#menu2">Motor</a></li>
				  	<li><a data-toggle="tab" href="#menu3">CORE FUNCTIONS OF IPRC-SOUTH</a></li>
				</ul>
				<div class="tab-content">
				  <div id="home" class="tab-pane fade in active">
				    <h3>Vision</h3>
				    <p>to be a leading TVET provider in the region..</p>
				  </div>
				  <div id="menu1" class="tab-pane fade">
				    <h3>Mission</h3>
				    <p>implement TVET programmes and facilitate the establishment of adequate, efficient and appropriate TVET offers in the Southern Province.</p>
				  </div>
				  <div id="menu2" class="tab-pane fade">
				    <h3>MOTTO</h3>
				    <p>Some content in menu 2.</p>
				  </div>
				  <div id="menu3" class="tab-pane fade">
				    <h3>CORE FUNCTIONS OF IPRC-SOUTH</h3>
				    <p>Some content in menu 2.</p>
				  </div>
				</div>
			</div>';
					}?>
				<?php
				  if($_SESSION['user_type']==2)
				  {
				  		echo '<div class="main" style="padding-top:10px;">
					<div class="panel panel-default" style="width:23%;margin-left:10px;">
				        <div class="panel-heading"><span>Student Information</span></div>
				        <div class="panel-body">
				            <div class="row">
				                <div class="col-sm-12">
				                	<span style="font-weight:bold;color:;font-size:30px;">Total Student:<span style="font-weight:bolder;" class="text text-primary text-col-lg-10">'.$row_student[0].'</span></span>
				                 </div>     
				            </div>
			            </div>
			            <div class="panel-footer">
			            	<span></span>
			            </div>
			       </div>
			       <div class="panel panel-default" style="width:23%; margin-left:10px;" >
				        <div class="panel-heading"><span>Lecturer Information</span></div>
				        <div class="panel-body">
				            <div class="row">
				                <div class="col-sm-12">
				                	<span style="font-weight:bold;color:;font-size:29px;">lecturer:<span style="font-weight:bolder;" class="text text-primary text-col-lg-10">'.$row_lecturer[0].'</span></span>
				                 </div>     
				            </div>
			            </div>
			            <div class="panel-footer">
			            	<span></span>
			            </div>
			       </div>
			       <div class="panel panel-default" style="width:23%; margin-left:10px;">
				        <div class="panel-heading"><span>Course Information</span></div>
				        <div class="panel-body">
				            <div class="row">
				                <div class="col-sm-12">
				                	<span style="font-weight:bold;color:;font-size:30px;">Total Course:<span style="font-weight:bolder;" class="text text-primary text-col-lg-">'.$row_departement[0].'</span></span>
				                 </div>     
				            </div>
			            </div>
			            <div class="panel-footer">
			            	<span></span>
			            </div>
			       </div>
			       <div class="panel panel-default" style="width:23%; margin-left:10px;" >
				        <div class="panel-heading"><span>Departement Information</span></div>
				        <div class="panel-body">
				            <div class="row">
				                <div class="col-sm-12">
				                	<span style="font-weight:bold;color:;font-size:30px;">Total Departement:<span style="font-weight:bolder;" class="text text-primary text-col-lg-10">5</span></span>
				                 </div>     
				            </div>
			            </div>
			            <div class="panel-footer">
			            	<span></span>
			            </div>

			       </div> 
			     </div> 
			     <ul class="nav nav-tabs nav-justified">
  					<li class="active"><a data-toggle="tab" href="#vision">Home</a></li>
				  	<li><a data-toggle="tab" href="#menu1">mission</a></li>
				  	<li><a data-toggle="tab" href="#menu2">Motor</a></li>
				  	<li><a data-toggle="tab" href="#menu3">CORE FUNCTIONS OF IPRC-SOUTH</a></li>
				</ul>

				<div class="tab-content">
				  <div id="home" class="tab-pane fade in active">
				    <h3>Vision</h3>
				    <p>to be a leading TVET provider in the region..</p>
				  </div>
				  <div id="menu1" class="tab-pane fade">
				    <h3>Mission</h3>
				    <p>implement TVET programmes and facilitate the establishment of adequate, efficient and appropriate TVET offers in the Southern Province.</p>
				  </div>
				  <div id="menu2" class="tab-pane fade">
				    <h3>MOTTO</h3>
				    <p>Some content in menu 2.</p>
				  </div>
				  <div id="menu3" class="tab-pane fade">
				    <h3>CORE FUNCTIONS OF IPRC-SOUTH</h3>
				    <p>Some content in menu 2.</p>
				  </div>
				</div>
			</div>';
				  }
				?>


	</body>
	<script type="text/javascript" src="bootstrap/js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript" src="assets/jquery/jquery-3.3.1.min.js"></script>
</html>