
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
    $departement = "Choose The Departement";
    $level = "";
   $reg_no = "";
   $first_name = "";
   $last_name = "";
   $email = "";
   $phone = "";
   $username = "";
   $password = "";
   $comfirmpassword = "";
 ?>
    <div class="container" class="col-lg-10 col-sm-10">
            <!-- content starts -->
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>
                <a href="categories.php">Student</a>
            </li>
        </ul>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><span class="glyphicon glyphicon-edit">Enter Student</span></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                	<?php
							if(isset($_POST['save'])){
                                $reg_no = mysql_real_escape_string($_POST['regnumber']);
								$first_name = mysql_real_escape_string($_POST['firstname']);
								$last_name = mysql_real_escape_string($_POST['lastname']);
                                $email = mysql_real_escape_string($_POST['email']);
                                $phone = mysql_real_escape_string($_POST['phonenumber']);
                                $level = mysql_real_escape_string($_POST['level']);
                                $departement = mysql_real_escape_string($_POST['departement']);
                                $username = mysql_real_escape_string($_POST['username']);
                                $password = mysql_real_escape_string($_POST['password']);
                                $comfirmpassword = mysql_real_escape_string($_POST['confpassoword']);
                                if($password == $comfirmpassword){
								mysql_query('insert into student values("","'.$reg_no.'","'.$first_name.'","'.$last_name.'","'.$email.'","'.$phone.'","'.$level.'","'.$departement.'","'.$username.'","'.$password.'","")')or die(mysql_error());
								$text_color = "alert alert-success";
								$msg = "Well done! the Student has been added.";
                                }
                                else
                                {
                                    $text_color = "alert alert-danger";
                                    $msg = "First comfirm password.";
                                }
							}
                            if (isset($_GET['EditID'])) {
                                $id = $_GET['EditID'];
                                $edit_state = true; 
                                 $rec = mysql_query("SELECT * FROM student where student_id = $id") or die(mysql_error());
                                 $record = mysql_fetch_assoc($rec);
                                 $reg_no = $record['reg_no'];
                                 $first_name = $record['first_name'];
                                 $last_name = $record['last_name'];
                                 $email = $record['email'];
                                 $phone_number = $record['phone_number'];
                                 $phone = $record['phone_number'];
                                 $level = $record['level'];
                                 $dept_id = $record['dept_id'];
                                 $username = $record['user_name'];
                                 $password = $record['password'];
                                 $res = mysql_query('select * from departement where dept_id = "'.$dept_id.'"') or die(mysql_error());
                                 $reco = mysql_fetch_array($res);
                                 $departement = $reco['dept_name'];
                                 if(isset($_POST['update']))
                                    {
                                        $reg_no = mysql_real_escape_string($_POST['regnumber']);
                                        $first_name = mysql_real_escape_string($_POST['firstname']);
                                        $last_name = mysql_real_escape_string($_POST['lastname']);
                                        $email = mysql_real_escape_string($_POST['email']);
                                        $phone = mysql_real_escape_string($_POST['phonenumber']);
                                        $level = mysql_real_escape_string($_POST['level']);
                                        $dept_id = mysql_real_escape_string($_POST['departement']);
                                        $username = mysql_real_escape_string($_POST['username']);
                                        $password = mysql_real_escape_string($_POST['password']);
                                        mysql_query("UPDATE student set reg_no='".$reg_no."',first_name = '".$first_name."', last_name='".$last_name."',email = '".$email."',phone_number='".$phone."',level='".$level."',dept_id = '".$dept_id."',user_name ='".$username."',password ='".$password."' where student_id = '".$id."'") or die(mysql_error());
                                        $text_color = "alert alert-success";
                                        $msg = "Well done! Student information has been Updated.";
                                    //header('location:departement.php'); 
                                }
                             } 
                            if(isset($_GET['DeleteID'])){
                                $get_delete = (int) $_GET['DeleteID'];
                                mysql_query('update student set action=1 where student_id="'.$get_delete.'"')or die(mysql_error());
                                $text_color = "alert alert-danger";
                                $msg = "Well done! student has been deleted.";
                            }
                            if ($_SESSION['user_type'] == 3) {
                                $id = $_SESSION['userLog'];
                                $edit_state = true; 
                                 $rec = mysql_query("SELECT * FROM student where student_id='".$id."'") or die(mysql_error());
                                 $record = mysql_fetch_assoc($rec);
                                 $reg_no = $record['reg_no'];
                                 $first_name = $record['first_name'];
                                 $last_name = $record['last_name'];
                                 $email = $record['email'];
                                 $phone_number = $record['phone_number'];
                                 $phone = $record['phone_number'];
                                 $level = $record['level'];
                                 $dept_id = $record['dept_id'];
                                 $username = $record['user_name'];
                                 $password = $record['password'];
                                 $res = mysql_query('select * from departement where dept_id = "'.$dept_id.'"') or die(mysql_error());
                                 $reco = mysql_fetch_array($res);
                                 $departement = $reco['dept_name'];
                                 if(isset($_POST['update']))
                                    {
                                        $reg_no = mysql_real_escape_string($_POST['regnumber']);
                                        $first_name = mysql_real_escape_string($_POST['firstname']);
                                        $last_name = mysql_real_escape_string($_POST['lastname']);
                                        $email = mysql_real_escape_string($_POST['email']);
                                        $phone = mysql_real_escape_string($_POST['phonenumber']);
                                        $level = mysql_real_escape_string($_POST['level']);
                                        $dept_id = mysql_real_escape_string($_POST['departement']);
                                        $username = mysql_real_escape_string($_POST['username']);
                                        $password = mysql_real_escape_string($_POST['password']);
                                        mysql_query("UPDATE student set reg_no='".$reg_no."',first_name = '".$first_name."', last_name='".$last_name."',email = '".$email."',phone_number='".$phone."',level='".$level."',dept_id = '".$dept_id."',user_name ='".$username."',password ='".$password."' where student_id = '".$id."'") or die(mysql_error());
                                        $text_color = "alert alert-success";
                                        $msg = "Well done! Student information has been Updated.";
                                    //header('location:departement.php'); 
                                }
                             } 

						?>
						<div class="<?php echo $text_color;?>">
							<?php echo $msg;?>
						</div>
                    <form class="form-horizontal" id="submitStudentForm" method="POST" action= "">
                     <div id="add-brand-messages"></div>
                     <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Registration Number:</label>
                            <div class="col-sm-8">
                                <input type="text" name="regnumber" id="regnumber" placeholder="Enter Reg Number.." class="form-control" value="<?php echo $reg_no; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">First Name:</label>
                            <div class="col-sm-8">
                                <input type="text" name="firstname" id="firstName" placeholder="Enter First Name.." class="form-control"  value="<?php echo $first_name; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Last Name:</label>
                            <div class="col-sm-8">
                                <input type="text" name="lastname" id="lastName" placeholder="Enter Last Name.." class="form-control" value="<?php echo $last_name;?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Email:</label>
                            <div class="col-sm-8">
                                <input type="text" name="email" id="firstName" placeholder="Enter Email.." class="form-control" value="<?php echo $email;?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Phone Number:</label>
                            <div class="col-sm-8">
                                <input type="text" name="phonenumber" id="phonenumber" placeholder="Enter Phone Number.." class="form-control" value="<?php echo $phone;?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Level</label>
                            <div class="col-sm-8">
                                <select name="level" id="level" placeholder="choose Status.." class="form-control">
                                    <option value="<?php echo $level; ?>"><?php echo "level"; echo $level;?></option>
                                    <option value="1">Level 1</option>
                                    <option value="2">Level 2</option>
                                    <option value="3">Level 3</option>
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
                            <label class="col-sm-4 control-label">Username:</label>
                            <div class="col-sm-8">
                                <input type="text" name="username" id="username" placeholder="Enter  username.." class="form-control" value="<?php echo $username;?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Enter Passoword:</label>
                            <div class="col-sm-8">
                                <input type="password" name="password" id="passoword" placeholder="Enter password.." class="form-control" value="<?php echo $password;?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Comfirm Passoword:</label>
                            <div class="col-sm-8">
                                <input type="password" name="confpassoword" id="passoword" placeholder="Enter comfirm password.." class="form-control" value="<?php echo $password;?>">
                            </div>
                        </div>
                    </div>
                </div>       
            </div>
        </div>
        <div class="panel-footer">
            <?php if ($edit_state==false): ?>
                <button type="submit" class="btn btn-primary" id="createBrandbtn" data-loading-text="loading..." name="save">Save Changes</button>
            <?php else: ?>
                <button type="submit" class="btn btn-primary" id="createBrandbtn" data-loading-text="loading..." name="update">Update Changes</button>
            <?php endif ?>
           
        </div>
        </form>
    </div>
    <?php if($_SESSION['user_type'] == 1){?>
    		<div class="panel panel-default">
    			<div class="panel-heading"><span class="glyphicon glyphicon-edit">Manage Student</span></div>
    			<div class="panel-body">
    				<div class="remove-messages"></div>
    				<table class="table" id="ManageStudent">
		    			<thead>
		    				<tr>
		    					<th>Registration Number</th>
                                <th>First Name</th>
                                <th>Last Name</th>
		    					<th>Email</th>
                                <th>Phone Number</th>
                                <th>Level</th>
                                <th>Department Name</th>
		    					<th style="width:20%;">Options</th>
		    				</tr>
		    			</thead>
		    			<tbody>
    						<?php 
    						$sql=" SELECT  * FROM `student` where action<>1";
									$result = $conn->query($sql);
									if ($result->num_rows > 0) {
										 while($row = $result->fetch_assoc()) {
                                            $res = mysql_query('select * from departement where dept_id = "'.$row['dept_id'].'"');
                                     $rec = mysql_fetch_assoc($res);
										echo " <tr>
								        <td class='center'>".$row['reg_no']."</td>
								         <td class'center'>".$row['first_name']."</td>
                                         <td class'center'>".$row['last_name']."</td>
                                         <td class'center'>".$row['email']."</td>
                                         <td class'center'>".$row['phone_number']."</td>
                                         <td class'center'>".$row['level']."</td>
                                         <td class'center'>".$rec['dept_name']."</td>
								        <td class='center'>
								            <a class='btn btn-danger' href='student.php?DeleteID=".$row['student_id']."'>
                                                <i class='glyphicon glyphicon-edit icon-white'></i>
                                                Delete
                                            </a>

								            <a class='btn btn-primary' href='student.php?EditID=".$row['student_id']."'>
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
        <?php }?>
    	</div>
    </div>
    
    <script type="text/javascript" src="custom/js/student.js"></script>
	
	
