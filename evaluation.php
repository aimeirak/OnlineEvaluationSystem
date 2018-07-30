<?php 
    session_start();
    if(!isset($_SESSION['userid'])){
        header('LOCATION:login.php');
    }
    include 'includes/header.php';
   include 'includes/header.php';
   require_once 'php_action/connection.php';
   require_once 'php_action/connect.php';
   $course_name="Choose Course Name";
 ?>
    <div class="container" class="col-lg-10 col-sm-10">
            <!-- content starts -->
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>
                <a href="evaluation.php">Evaluation</a>
            </li>
        </ul>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><span class="glyphicon glyphicon-edit">Evaluate</span></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <?php 
                        if (isset($_POST['save'])) {
                            $student_id = mysql_real_escape_string($_SESSION['userLog']);
                            $course_id = mysql_real_escape_string($_POST['course']);
                            $ques1 = mysql_real_escape_string($_POST['ques1']);
                            $ques2 = mysql_real_escape_string($_POST['ques2']);
                            $ques3 = mysql_real_escape_string($_POST['ques3']);
                            $ques4 = mysql_real_escape_string($_POST['ques4']);
                            $ques5 = mysql_real_escape_string($_POST['ques5']);
                            $ques6 = mysql_real_escape_string($_POST['ques6']);
                            $ques7 = mysql_real_escape_string($_POST['ques7']);
                            $ques8 = mysql_real_escape_string($_POST['ques8']);
                            $ques9 = mysql_real_escape_string($_POST['ques9']);
                            $ques10 = mysql_real_escape_string($_POST['ques10']);
                            $ques11 = mysql_real_escape_string($_POST['ques11']);
                            $ques12 = mysql_real_escape_string($_POST['ques12']);
                            mysql_query('insert into evaluation values("","'.$course_id.'","'.$student_id.'","")') or die(mysql_error());
                            $evaluation_id = mysql_insert_id();
                            mysql_query('insert into evaluation_detail values("","'.$evaluation_id.'","'.$ques1.'","'.$ques2.'","'.$ques3.'","'.$ques4.'","'.$ques5.'","'.$ques6.'","'.$ques7.'","'.$ques8.'","'.$ques9.'","'.$ques10.'","'.$ques11.'","'.$ques12.'","")') or die(mysql_error());
                            echo'<div class="alert alert-success">Evaluation done successfull !</div>';
                        }
                    ?>
                    <form class="form-horizontal" id="submitCourseForm" method="POST" action="">
                    
                    <?php
                     $get_student = mysql_query('select * from student where student_id="'.$_SESSION['userLog'].'"'); 
                     $check_student = mysql_fetch_assoc($get_student);
                    ?>
                     <div class="col-sm-6" style="padding-top:2%;">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Enter Student:</label>
                            <div class="col-sm-8">
                                <input type="text" name="student_name" id="student_name" placeholder="Enter Last Name.." class="form-control" value="<?php echo $check_student['first_name'].' '.$check_student['last_name']?>" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6" style="padding-top:2%;">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Course Name</label>
                            <div class="col-sm-7">
                                <select name="course" id="course" placeholder="choose Course.." class="form-control">
                                    <option value="<?php echo $course_id;?>"><?php echo $course_name;?></option>
                                    <?php
                                        $result = mysql_query("SELECT * FROM  course where action<>1");
                                            while ($row = mysql_fetch_assoc($result)) {
                                                echo '<option value="'.$row['course_id'].'">'.$row['course_name'].'</option>';
                                                 } 
                                            ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-6 control-label">The trainer provided the module outline at the beginning of the course:</label>
                            <div class="col-sm-5">
                                <select name="ques1" id="ques1" placeholder="choose Status.." class="form-control">
                                    <option value="">Choose Answer</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Module handout/syllabus was:</label>
                            <div class="col-sm-5">
                                <select name="ques2" id="ques2" placeholder="choose Status.." class="form-control">
                                    <option value="">Choose Answer</option>
                                    <option value="1">Provided & in line with module outline</option>
                                    <option value="2">Provided but not in line with module outline</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-6 control-label">During teaching, the stated module learning outcomes and content were:</label>
                            <div class="col-sm-5">
                                <select name="ques3" id="ques3" placeholder="choose Status.." class="form-control">
                                    <option value="">Choose Answer</option>
                                    <option value="1">Fully covered</option>
                                    <option value="2">Poorly covered</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-6 control-label">The trainer stated clearly at the beginning the procedures by which students will be assessed:</label>
                            <div class="col-sm-5">
                                <select name="ques4" id="ques4" placeholder="choose Status.." class="form-control">
                                    <option value="">Choose Answer</option>
                                    <option value="1">Clearly stated</option>
                                    <option value="2">Not Clearly Stated</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Assignments provided were relevant to content</label>
                            <div class="col-sm-5">
                                <select name="ques5" id="ques5" placeholder="choose Status.." class="form-control">
                                    <option value="">Choose Answer</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-6 control-label">The feedback and comments on assessment (CAT and assignments) were:</label>
                            <div class="col-sm-5">
                                <select name="ques6" id="ques6" placeholder="choose Status.." class="form-control">
                                    <option value="">Choose Answer</option>
                                    <option value="1">Provided</option>
                                    <option value="2">Not Provided</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-6 control-label">The trainer is available for consultation in case students are in need:</label>
                            <div class="col-sm-5">
                                <select name="ques7" id="ques7" placeholder="choose Status.." class="form-control">
                                    <option value="">Choose Answer</option>
                                    <option value="1">Always available</option>
                                    <option value="2">Sometimes available</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Trainer asks questions to ensure the students understand the taught content:</label>
                            <div class="col-sm-5">
                                <select name="ques8" id="ques8" placeholder="choose Status.." class="form-control">
                                    <option value="">Choose Answer</option>
                                    <option value="1">Always</option>
                                    <option value="2">Sometime</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-6 control-label">In module syllabus provided references (books) were:</label>
                            <div class="col-sm-5">
                                <select name="ques9" id="ques9" placeholder="choose Status.." class="form-control">
                                    <option value="">Choose Answer</option>
                                    <option value="1">Provided</option>
                                    <option value="2">Not Provided</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-6 control-label">The demonstration in classroom/workshop was:</label>
                            <div class="col-sm-5">
                                <select name="ques10" id="ques10" placeholder="choose Status.." class="form-control">
                                    <option value="">Choose Answer</option>
                                    <option value="1">Excellent1</option>
                                    <option value="2">Good</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-6 control-label">The trainer allowed students to ask questions in class, provided useful responses, and encouraged students participation :</label>
                            <div class="col-sm-5">
                                <select name="ques11" id="ques11" placeholder="choose Status.." class="form-control">
                                    <option value="">Choose Answer</option>
                                    <option value="1">Always</option>
                                    <option value="2">Sometimes</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-6 control-label">The trainer attended class regularly and on time:</label>
                            <div class="col-sm-5">
                                <select name="ques12" id="ques12" placeholder="choose Status.." class="form-control">
                                    <option value="">Choose Answer</option>
                                    <option value="1">Always</option>
                                    <option value="2">Sometimes</option>
                                </select>
                            </div>
                        </div>
                    </div>       
        </div>
        <div class="panel-footer">
           <button type="submit" class="btn btn-primary" id="createBrandbtn" data-loading-text="loading..." name="save">Submit</button>
        </div>
        </form>
    </div>
</div>	
    </div>
    <script type="text/javascript" src="custom/js/evaluation.js"></script>
	
	
