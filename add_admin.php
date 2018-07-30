<?php 
    session_start();
    if(!isset($_SESSION['userid'])){
        header('LOCATION:login.php');
    }
    include 'includes/header.php';
   require_once 'php_action/connection.php';
   require_once 'php_action/connect.php'; 
   $msg = "";
   $text_color = "";
 ?>
    <div class="container" class="col-lg-10 col-sm-10">
            <!-- content starts -->
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>
                <a href="add_admin.php">Admin</a>
            </li>
        </ul>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><span class="glyphicon glyphicon-edit">Add Admin</span></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <?php
                        if(isset($_POST['save'])){
                                $first_name= mysql_real_escape_string($_POST['firstname']);
                                $last_name= mysql_real_escape_string($_POST['lastname']);
                                $email = mysql_real_escape_string($_POST['email']);
                                $username = mysql_real_escape_string($_POST['username']);
                                $password = mysql_real_escape_string($_POST['password']);
                                $phone = mysql_real_escape_string($_POST['phone']);
                                mysql_query('insert into users values("","'.$first_name.'","'.$last_name.'","'.$email.'","'.$username.'","'.$password.'","'.$phone.'","")')or die(mysql_error());
                                $text_color = "alert alert-success";
                                $msg = "Well done! the Admin has been added.";
                            }
                            if (isset($_GET['EditID'])) {
                                $id = $_GET['EditID'];
                                $edit_state = true; 
                                 $rec = mysql_query("SELECT * FROM course where course_id = $id") or die(mysql_error());
                                 $record = mysql_fetch_assoc($rec);
                                 $course_name = $record['course_name'];
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
                                        $credit = mysql_real_escape_string($_POST['credit']);
                                        $lecturer_id = mysql_real_escape_string($_POST['lecturername']);
                                        $dept_id = mysql_real_escape_string($_POST['departement']);
                                        $level = mysql_real_escape_string($_POST['level']);
                                        mysql_query("UPDATE course set course_name = '".$course_name."', credit='".$credit."',lecturer_id = '".$lecturer_id."',dept_id = '".$dept_id."',level='".$level."' where course_id = '".$id."'") or die(mysql_error());
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
                            <label class="col-sm-4 control-label">First Name:</label>
                            <div class="col-sm-8">
                                <input type="text" name="firstname" id="firstname" placeholder="Enter First Name.." class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Last Name:</label>
                            <div class="col-sm-8">
                                <input type="text" name="lastname" id="lastname" placeholder="Enter Last Name.." class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Email:</label>
                            <div class="col-sm-8">
                                <input type="email " name="email" id="lastname" placeholder="Enter Email.." class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">User Name:</label>
                            <div class="col-sm-8">
                                <input type="text" name="username" id="username" placeholder="Enter username.." class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Password:</label>
                            <div class="col-sm-8">
                                <input type="password" name="password" id="password" placeholder="Enter password.." class="form-control">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Phone Number:</label>
                            <div class="col-sm-8">
                                <input type="text" name="phone" id="phone" placeholder="Enter Phone Number.." class="form-control">
                            </div>
                        </div>
                    </div>    
                    
                </div>
                    
            </div>
            
        </div>
        <div class="panel-footer">
           <button type="submit" class="btn btn-primary" name="save" id="createAdminsbtn" data-loading-text="loading...">Save Changes</button>
        </div>
        </form>
    </div>
    		<div class="panel panel-default">
    			<div class="panel-heading"><span class="glyphicon glyphicon-edit">Manage Admin</span></div>
    			<div class="panel-body">
    				<div class="remove-messages"></div>
    				<table class="table" id="ManageBrand">
		    			<thead>
		    				<tr>
		    					<th>First Name</th>
		    					<th>Last Name</th>
                                <th>Email</th>
                                <th>User Name</th>
                                <th>Mobile Number</th>
		    					<th style="width:20%;">Options</th>
		    				</tr>
		    			</thead>
		    			<tbody>
    						<?php 
    						$sql=" SELECT * FROM `admin`where admin_id <> '".$_SESSION['userLog']."' ";
									$result = $conn->query($sql);
									if ($result->num_rows > 0) {
										 while($row = $result->fetch_assoc()) {
										echo " <tr>
								        <td class='center'>".$row['first_name']."</td>
								        <td class'center'>".$row['last_name']."</td>
                                        <td class='center'>".$row['email']."</td>
                                        <td class'center'>".$row['user_name']."</td>
                                        <td class'center'>".$row['phone_number']."</td>
								        <td class='center'>
								            <a class='btn btn-danger' href='php_action/removeBrand.php?delete & id = ".$row['admin_id']."'>
								                <i class='glyphicon glyphicon-trash icon-white'></i>
								                Delete
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
   
    <script type="text/javascript" src="custom/js/brand.js"></script>
	
	
