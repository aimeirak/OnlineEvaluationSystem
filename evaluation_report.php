<?php
session_start();
if(!isset($_SESSION['userid'])){
        header('LOCATION:login.php');
    }
	require_once 'php_action/connect.php';
	$qa1 = 0;$qb1 = 0;
	$qa2 = 0;$qb2 = 0;
	$qa3 = 0;$qb3 = 0;
	$qa4 = 0;$qb4 = 0;
	$qa5 = 0;$qb5 = 0;
	$qa6 = 0;$qb6 = 0;
	$qa7 = 0;$qb7 = 0;
	$qa8 = 0;$qb8 = 0;
	$qa9 = 0;$qb9 = 0;
	$qa10 = 0;$qb10 = 0;
	$qa11 = 0;$qb11 = 0;
	$qa12 = 0;$qb12 = 0;
?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Evaluation Report</title>
 	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="assets/jquery/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
 </head>
 <body class="container-fluid" style="">
 	<h3 style="padding:1%;">all course</h3>
 	<?php
 	if ($_SESSION['user_type'] == 1) {
 		
 		$course = mysql_query('select * from course where action=0');
 		while($row = mysql_fetch_assoc($course)){
 			echo'<a href="evaluation_report.php?course_report='.$row['course_id'].'" style="color:green;text-decoration:none;margin-left:3px;">'.$row['course_name'].'</a><br>';
 		}
 	}
 	if ($_SESSION['user_type'] == 2) {
 		
 		$course = mysql_query('select * from course where Lecturer_id= "'.$_SESSION['userLog'].'" AND action=0');
 		while($row = mysql_fetch_assoc($course)){
 			echo'<a href="evaluation_report.php?course_report='.$row['course_id'].'" style="color:green;text-decoration:none;margin-left:3px;">'.$row['course_name'].'</a><br>';
 		}
 		}
		if(isset($_GET['course_report'])){
			$all_std = 1;
			$data = array();
			for($no=0;$no<=11;$no++){
				$data[$no] = array(0=>0,1=>0);
			}
			$get_course = $_GET['course_report'];
			$crs = mysql_query('select * from course where course_id="'.$get_course.'"');
	 		$row_crs = mysql_fetch_assoc($crs);
	 		$le = mysql_query('select * from lecturer where lecturer_id="'.$row_crs['lecturer_id'].'"');
	 		$row_le = mysql_fetch_assoc($le);
	 		echo'<h4>Course name: '.$row_crs['course_name'].'<br>course Code:'.$row_crs['course_code'].'<br>Lecture name: '.$row_le['first_name'].' '.$row_le['last_name'].'</h4>';
	 		$all_std = mysql_query('select COUNT(student_id) from evaluation where course_id="'.$get_course.'" AND action=0');
	 		$a_std = mysql_fetch_array($all_std);

	 		$all_eva = mysql_query('select * from evaluation where course_id="'.$get_course.'" AND action=0');

	 		while($row_eva = mysql_fetch_array($all_eva)){
	 			$details = mysql_query('select * from evaluation_detail where evaluation_id="'.$row_eva['evaluation_id'].'" AND action=0');
	 			while($row_de = mysql_fetch_assoc($details)){
	 				for($no=0;$no<=11;$no++){
 						if($row_de['quest_'.($no+1)] == 1){
 						//$qa.$no = $qa.$no + 1;
 						//$data[$no] = array(0);
 						$data[$no][0] = $data[$no][0] + 1;
		 				}
		 				if($row_de['quest_'.($no+1)] == 2){
		 					//$qb.$no = $qb.$no + 1;
		 					//$data[$no] = array(1);
	 						$data[$no][1] = $data[$no][1] + 1;
		 				}
	 				}
	 			}
	 		}
	 		if($a_std[0] > 0){
	 			$all_std = (int) $a_std[0];
	 		}
	 		for($no=0;$no<=11;$no++){

	 			$data[$no][0] = (int) ($data[$no][0]*100);
	 			$data[$no][0] = $data[$no][0] / $all_std;

	 			$data[$no][1] = ($data[$no][1]*100);
	 			$data[$no][1] = $data[$no][1] / $all_std;
	 		}
	 		echo'
	 		<div class="table-responsive">
 		<table class="table" border="1">
			<thead>
				<tr>
					<th>No</th>
					<th>ITEMS</th>
					<th colspan="2">INDICATORS</th>
					<th colspan="2">PERCENTAGE</th>
				</tr>
			</thead>
			<tbody class="table-hover">
				<tr class="active">
					<td>1</td>
					<td>The trainer provided the module outline at the beginning of the course</td>
					<td>yes</td>
					<td>no</td>
					<td>'.$data[0][0].'%</td>
					<td>'.$data[0][1].'%</td>
				</tr>
				<tr>
					<td>2</td>
					<td>Module handout/syllabus was</td>
					<td>Provided & in line with module outline</td>
					<td>Provided but not in line with module outline</td>
					<td>'.$data[1][0].'%</td>
					<td>'.$data[1][0].'%</td>
				</tr>
				<tr>
					<td>3</td>
					<td>During teaching, the stated module learning outcomes and content were</td>
					<td>Fully covered</td>
					<td>Poorly covered</td>
					<td>'.$data[2][0].'%</td>
					<td>'.$data[2][1].'%</td>
				</tr>
				<tr>
					<td>4</td>
					<td>The trainer stated clearly at the beginning the procedures by which students will be assessed</td>
					<td>Clearly stated</td>
					<td>not Clearly stated</td>
					<td>'.$data[3][0].'%</td>
					<td>'.$data[3][1].'%</td>
				</tr>
				<tr>
					<td>5</td>
					<td>Assignments provided were relevant to content</td>
					<td>yes</td>
					<td>no</td>
					<td>'.$data[4][0].'%</td>
					<td>'.$data[4][1].'%</td>
				</tr>
				<tr>
					<td>6</td>
					<td>The feedback and comments on assessment (CAT and assignments) were</td>
					<td>Provided</td>
					<td>Not Provided</td>
					<td>'.$data[5][0].'%</td>
					<td>'.$data[5][1].'%</td>
				</tr>
				<tr>
					<td>7</td>
					<td>The trainer is available for consultation in case students are in need</td>
					<td>Always available</td>
					<td>Sometimes available</td>
					<td>'.$data[6][0].'%</td>
					<td>'.$data[6][1].'%</td>
				</tr>
				<tr>
					<td>8</td>
					<td>Trainer asks questions to ensure the students understand the taught content</td>
					<td>Always</td>
					<td>Sometime</td>
					<td>'.$data[7][0].'%</td>
					<td>'.$data[7][1].'%</td>
				</tr>
				<tr>
					<td>9</td>
					<td>In module syllabus provided references (books) were</td>
					<td>Provided</td>
					<td>Not Provided</td>
					<td>'.$data[8][0].'%</td>
					<td>'.$data[8][1].'%</td>
				</tr>
				<tr>
					<td>10</td>
					<td>The demonstration in classroom/workshop was</td>
					<td>Excellent</td>
					<td>Good</td>
					<td>'.$data[9][0].'%</td>
					<td>'.$data[9][1].'%</td>
				</tr>
				<tr>
					<td>11</td>
					<td>The trainer allowed students to ask questions in class, provided useful responses, and encouraged students participation </td>
					<td>Always</td>
					<td>Sometimes</td>
					<td>'.$data[10][0].'%</td>
					<td>'.$data[10][1].'%</td>
				</tr>
				<tr>
					<td>12</td>
					<td>The trainer attended class regularly and on time </td>
					<td>Always</td>
					<td>Sometimes</td>
					<td>'.$data[11][0].'%</td>
					<td>'.$data[11][1].'%</td>
				</tr>
			</tbody>
		</table>
 	</div>
	 		';
		}
	?>
 </body>
 </html>