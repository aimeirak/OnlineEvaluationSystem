<?php 
    session_start();
    if(!isset($_SESSION['userid'])){
        header('LOCATION:login.php');
    }
    include 'includes/header.php';
 require_once 'php_action/connection.php';
 require_once 'php_action/connect.php';
 $edit_state=false;
 $text_color = "";
 $msg = "";
 $course_name="";
 $credit = "";
 $lecturer_id = "";
 $first_name = "Choose First Name";
 $last_name = "Choose Last Name";
 $course_code = "";
 $dept_id = 0;
 $departement = "Choose Departement";
 $level ="";
 $credit="";


?>
<div class="container" class="col-lg-10 col-sm-10">
            <!-- content starts -->
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>
                <a href="course.php">Courses</a>
            </li>
        </ul>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><span class="glyphicon glyphicon-edit">Enter Course</span></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <?php
                            if(isset($_POST['save'])){
                                $course_name = mysql_real_escape_string($_POST['courseName']);
                                $course_code = mysql_real_escape_string($_POST['course_code']);
                                $credit= mysql_real_escape_string($_POST['credit']);
                                $lecturer_id = mysql_real_escape_string($_POST['lecturername']);
                                $dept_id = mysql_real_escape_string($_POST['departement']);
                                $level = mysql_real_escape_string($_POST['level']);
                                mysql_query('insert into course values("","'.$course_name.'","'.$course_code.'","'.$credit.'","'.$lecturer_id.'","'.$dept_id.'","'.$level.'","")')or die(mysql_error());
                                $text_color = "alert alert-success";
                                $msg = "Well done! the course has been added.";
                            }
                            if (isset($_GET['EditID'])) {
                                $id = $_GET['EditID'];
                                $edit_state = true; 
                                 $rec = mysql_query("SELECT * FROM course where course_id = $id") or die(mysql_error());
                                 $record = mysql_fetch_assoc($rec);
                                 $course_name = $record['course_name'];
                                 $course_code = $record['course_code'];
                                 $credit = $record['credit'];
                                 $lecturer_id = $record['lecturer_id'];
                                 $lect = mysql_query('select * from lecturer where lecturer_id = "'.$lecturer_id.'"') or die(mysql_error());
                                 $lect_record = mysql_fetch_array($lect);
                                 $first_name = $lect_record['first_name'];
                                 $last_name = $lect_record['last_name'];
                                 $dept_id = $record['dept_id'];
                                 $res = mysql_query('select * from departement where dept_id = "'.$dept_id.'"') or die(mysql_error());
                                 $reco = mysql_fetch_array($res);
                                 $departement = $reco['dept_name'];
                                 $level = $record['level'];
                                 if(isset($_POST['update']))
                                    {
                                        $course_name = mysql_real_escape_string($_POST['courseName']);
                                        $course_code = mysql_real_escape_string($_POST['course_code']);
                                        $credit = mysql_real_escape_string($_POST['credit']);
                                        $lecturer_id = mysql_real_escape_string($_POST['lecturername']);
                                        $dept_id = mysql_real_escape_string($_POST['departement']);
                                        $level = mysql_real_escape_string($_POST['level']);
                                        mysql_query("UPDATE course set course_name = '".$course_name."', course_code ='".$course_code."', credit='".$credit."',lecturer_id = '".$lecturer_id."',dept_id = '".$dept_id."',level='".$level."' where course_id = '".$id."'") or die(mysql_error());
                                        $text_color = "alert alert-success";
                                        $msg = "Well done! the Course has been Updated.";   
                                    }

                             } 
                             if(isset($_GET['DeleteID'])){
                                $get_delete = (int) $_GET['DeleteID'];
                                mysql_query('update course set action=1 where course_id="'.$get_delete.'"')or die(mysql_error());
                                $text_color = "alert alert-success";
                                $msg = "Well done! Course has been deleted.";
                            }
                        ?>
                        <div class="<?php echo $text_color;?>">
                            <?php echo $msg;?>
                        </div>
                    <form class="form-horizontal" id="submitCategoriesForm" method="POST" action= "">
                     <div id="add-brand-messages"></div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Course Name:</label>
                            <div class="col-sm-8">
                                <input type="text" name="courseName" id="courseName" placeholder="Enter Course Name.." class="form-control" value="<?php echo $course_name ;?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Course Code:</label>
                            <div class="col-sm-8">
                                <input type="text" name="course_code" id="course_code" placeholder="Enter Course Code.." class="form-control" value="<?php echo $course_code ;?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Enter Credit:</label>
                            <div class="col-sm-8">
                                <input type="text" name="credit" id="credit" placeholder="Enter Credit.." class="form-control" value="<?php echo $credit; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Lecturer First Name</label>
                            <div class="col-sm-8">
                                <select name="lecturername" id="Lecturername" placeholder="choose Lecturer Name.." class="form-control">
                                    <option value="<?php echo $lecturer_id; ?>"><?php echo $first_name;?></option>
                                    <?php
                                        $result = mysql_query("SELECT * FROM  Lecturer where action<>1");
                                            while ($row = mysql_fetch_assoc($result)) {
                                                echo '<option value="'.$row['lecturer_id'].'">'.$row['first_name'].' </option>';
                                                 } 
                                            ?>
                                </select>
                            </div>   
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Lecturer Last Name</label>
                            <div class="col-sm-8">
                                <select name="Lecturelastname" id="Lecturerlastname" placeholder="choose Lecturer Name.." class="form-control">
                                    <option value=""><?php echo $last_name;?></option>
                                    <?php
                                        $result = mysql_query("SELECT * FROM  Lecturer where action<>1");
                                            while ($row = mysql_fetch_assoc($result)) {
                                                echo '<option value="'.$row['lecturer_id'].'">'.$row['last_name'].' </option>';
                                                 } 
                                            ?>
                                </select>
                            </div>   
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Departement Name</label>
                            <div class="col-sm-8">
                                <select name="departement" id="departement" placeholder="choose Status.." class="form-control">
                                    <option value="<?php echo $dept_id;?>"><?php echo $departement ?></option>
                                    <?php
                                        $result = mysql_query("SELECT * FROM  departement where action<>1");
                                            while ($row = mysql_fetch_assoc($result)) {
                                                echo '<option value="'.$row['dept_id'].'">'.$row['dept_name'].'</option>';
                                                 } 
                                            ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Level</label>
                            <div class="col-sm-8">
                                <select name="level" id="level" placeholder="choose Status.." class="form-control">
                                    <option value="<?php echo $level; ?>"><?php echo "level"; echo $level; ?></option>
                                    <option value="1">Level 1</option>
                                    <option value="2">Level 2</option>
                                    <option value="3">Level 3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
            
        </div>
        <div class="panel-footer">
            <?php if($edit_state==false): ?> 
                <button type="submit" class="btn btn-primary" name="save" id="createBrandbtn" data-loading-text="loading...">Save Changes</button>
              <?php  else:?>
                <button type="submit" class="btn btn-primary" name="update" id="createBrandbtn" data-loading-text="loading...">Update Changes</button>
              <?php endif ?>
           
        </div>
        </form>
    </div>
         <div class="panel panel-default">
                <div class="panel-heading"><span class="glyphicon glyphicon-edit">Manage Course</span></div>
                <div class="panel-body">
                    <div class="remove-messages"></div>
                    <table class="table" id="ManageCourse">
                        <thead>
                            <tr>
                                <th>Course Name</th>
                                <th>Course Code</th>
                                <th>Credit</th>
                                <th>Lecturer Name</th>
                                <th>Departement Name</th>
                                <th>Level</th>
                                <th style="width:20%;">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $sql=" SELECT * FROM `course` where action<>1";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                         while($row = $result->fetch_assoc()) {
                                            $res = mysql_query('select * from departement where dept_id = "'.$row['dept_id'].'"');
                                            $rec = mysql_fetch_assoc($res);
                                            $lect = mysql_query('select * from lecturer where lecturer_id="'.$row['lecturer_id'].'"');
                                            $lect_record = mysql_fetch_assoc($lect);
                                        echo " <tr>
                                        <td class='center'>".$row['course_name']."</td>
                                        <td class='center'>".$row['course_code']."</td>
                                         <td class'center'>".$row['credit']."</td>
                                         <td class'center'>".$lect_record['first_name']." ".$lect_record['last_name']."</td>
                                         <td class'center'>".$rec['dept_name']."</td>
                                         <td class'center'>".$row['level']."</td>
                                        <td class='center'>
                                            <a class='btn btn-danger' href='course.php?DeleteID= ".$row['course_id']."'>
                                                <i class='glyphicon glyphicon-trash icon-white'></i>
                                                Delete
                                            </a>

                                            <a class='btn btn-primary' href='course.php?EditID=".$row['course_id']."'>
                                                <i class='glyphicon glyphicon-edit icon-white'></i>
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                        ";
                                    }
                                    }
                                    else
                                    {
                                        echo "<h3 align='center'>No Record Found</h3>";
                                    }
                             ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div><!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->
<script type="text/javascript" src="custom/js/course.js"></script>