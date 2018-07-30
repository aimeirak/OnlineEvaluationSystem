<?php 
	session_start();
    if(!isset($_SESSION['userid'])){
        header('LOCATION:login.php');
    }
   include 'includes/header.php';
   require_once 'php_action/connection.php';
   require_once 'php_action/connect.php';
   $edit_state = false;
   $text_color = "";
   $msg = "";
$id=0;
 $first_name = "";
 $last_name = "";
 $gender = "choose Gender....";
 $email = "";
 $phone = "";
 $departement = "Choose Departement";
 $username = "";
 $password = "";
 ?>
    <div class="container" class="col-lg-10 col-sm-10">
            <!-- content starts -->
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>
                <a href="Lecturer.php">Lecturer</a>
            </li>
        </ul>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><span class="glyphicon glyphicon-edit">Enter Lecturer</span></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                	<?php
                            if(isset($_POST['save'])){
								$firstname = mysql_real_escape_string($_POST['firstname']);
								$lastname = mysql_real_escape_string($_POST['lastname']);
								$gender = mysql_real_escape_string($_POST['gender']);
								$email = mysql_real_escape_string($_POST['email']);
								$phonenumber = mysql_real_escape_string($_POST['phonenumber']);
								$dept_id = mysql_real_escape_string($_POST['departement']);
                                $username = mysql_real_escape_string($_POST['username']);
                                $password = mysql_real_escape_string($_POST['password']);
								mysql_query('insert into lecturer values("","'.$firstname.'","'.$lastname.'","'.$gender.'","'.$email.'","'.$phonenumber.'","'.$dept_id.'","'.$username.'","'.$password.'","")')or die(mysql_error());
								$text_color = "alert alert-success";
								$msg = "Well done! the Lecturer has been added.";
							}
                            if (isset($_GET['EditID'])) {
                                $id = $_GET['EditID'];
                                $edit_state = true; 
                                 $rec = mysql_query("SELECT * FROM lecturer where lecturer_id = $id") or die(mysql_error());
                                 $record = mysql_fetch_assoc($rec);
                                 $first_name = $record['first_name'];
                                 $last_name = $record['last_name'];
                                 $gender = $record['gender'];
                                 $email = $record['email'];
                                 $phone = $record['phone'];
                                 $dept_id = $record['dept_id'];
                                 $username = $record['user_name'];
                                 $password = $record['password'];
                                 $res = mysql_query('select * from departement where dept_id = "'.$dept_id.'"') or die(mysql_error());
                                 $reco = mysql_fetch_array($res);
                                 $departement = $reco['dept_name'];
                                 if(isset($_POST['update']))
                                    {
                                        $first_name = mysql_real_escape_string($_POST['firstname']);
                                        $last_name = mysql_real_escape_string($_POST['lastname']);
                                        $gender = mysql_real_escape_string($_POST['gender']);
                                        $email = mysql_real_escape_string($_POST['email']);
                                        $phone = mysql_real_escape_string($_POST['phonenumber']);
                                        $dept_id = mysql_real_escape_string($_POST['departement']);
                                        $username = mysql_real_escape_string($_POST['username']);
                                        $password = mysql_real_escape_string($_POST['password']);   
                                        mysql_query("UPDATE lecturer set first_name = '".$first_name."', last_name='".$last_name."',gender = '".$gender."', email='".$email."', phone='".$phone."', dept_id = '".$dept_id."',user_name='".$username."',password='".$password."' where lecturer_id ='".$id."'") or die(mysql_error());
                                        $text_color = "alert alert-success";
                                        $msg = "Well done! Lectuter information has been Updated.";
                                    //header('location:departement.php'); 
                                }
                             } 
                            if(isset($_GET['DeleteID'])){
                                $get_delete = (int) $_GET['DeleteID'];
                                mysql_query('update lecturer set action=1 where lecturer_id="'.$get_delete.'"')or die(mysql_error());
                                $text_color = "alert alert-success";
                                $msg = "Well done! lecturer has been deleted.";
                            }
                            if ($_SESSION['user_type']==2) {
                                $id = $_SESSION['userLog'];
                                $edit_state = true; 
                                 $rec = mysql_query("SELECT * FROM lecturer where lecturer_id = '".$id."'") or die(mysql_error());
                                 $record = mysql_fetch_assoc($rec);
                                 $first_name = $record['first_name'];
                                 $last_name = $record['last_name'];
                                 $gender = $record['gender'];
                                 $email = $record['email'];
                                 $phone = $record['phone'];
                                 $dept_id = $record['dept_id'];
                                 $username = $record['user_name'];
                                 $password = $record['password'];
                                 $res = mysql_query('select * from departement where dept_id = "'.$dept_id.'"') or die(mysql_error());
                                 $reco = mysql_fetch_array($res);
                                 $departement = $reco['dept_name'];
                                 if(isset($_POST['update']))
                                    {
                                        $first_name = mysql_real_escape_string($_POST['firstname']);
                                        $last_name = mysql_real_escape_string($_POST['lastname']);
                                        $gender = mysql_real_escape_string($_POST['gender']);
                                        $email = mysql_real_escape_string($_POST['email']);
                                        $phone = mysql_real_escape_string($_POST['phonenumber']);
                                        $dept_id = mysql_real_escape_string($_POST['departement']);
                                        $username = mysql_real_escape_string($_POST['username']);
                                        $password = mysql_real_escape_string($_POST['password']);   
                                        mysql_query("UPDATE lecturer set first_name = '".$first_name."', last_name='".$last_name."',gender = '".$gender."', email='".$email."', phone='".$phone."', dept_id = '".$dept_id."',user_name='".$username."',password='".$password."' where lecturer_id ='".$id."'") or die(mysql_error());
                                        $text_color = "alert alert-success";
                                        $msg = "Well done! Lectuter information has been Updated.";
                                    //header('location:departement.php'); 
                                }
                             } 
                        ?>

							<div class="<?php echo $text_color;?>">
							<?php echo $msg;?>
						</div>
                    <form class="form-horizontal" id="submitProductForm" method="POST" action= "">
                     <div id="add-brand-messages"></div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">First Name:</label>
                            <div class="col-sm-8">
                                <input type="text" name="firstname" id="firstname" placeholder="Enter First Name.." class="form-control" value="<?php echo $first_name;?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Enter Last name:</label>
                            <div class="col-sm-8">
                                <input type="text" name="lastname" id="lastname" placeholder="Enter Last Name.." class="form-control" value="<?php  echo $last_name;?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label"><B>Gender</B></label>
                            <div class="col-sm-8">
                                <select name="gender" id="gender" placeholder="choose Gender.." class="form-control" >
                                    <option value="<?php echo $gender ?>"><?php echo $gender ?></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Email:</label>
                            <div class="col-sm-8">
                                <input type="email" name="email" id="firstName" placeholder="Enter Email.." class="form-control" value="<?php  echo $email; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Phone Number:</label>
                            <div class="col-sm-8">
                                <input type="text" name="phonenumber" id="phonenumber" placeholder="Enter Phone Number.." class="form-control" value="<?php  echo $phone; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Departement Name</label>
                            <div class="col-sm-8">
                                <select name="departement" id="departement" placeholder="choose Departement.." class="form-control">
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
                                <input type="text" name="username" id="username" placeholder="Enter Username.." class="form-control" value="<?php  echo $username; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Password:</label>
                            <div class="col-sm-8">
                                <input type="password" name="password" id="username" placeholder="Enter Password.." class="form-control" value="<?php  echo $password; ?>">
                            </div>
                        </div>
                    </div>
                </div>      
            </div>
        </div>
        <div class="panel-footer">
            <?php if ($edit_state==false): ?>
                <button type="submit" class="btn btn-primary" name="save" id="createBrandbtn" data-loading-text="loading...">Save Changes</button>
            <?php else: ?>
                <button type="submit" class="btn btn-primary" name="update" id="createBrandbtn" data-loading-text="loading...">Update Changes</button>
            <?php endif ?>
           
        </div>
        </form>
    </div>
             <?php if($_SESSION['user_type'] == 1){?>  
    		<div class="panel panel-default">
    			<div class="panel-heading"><span class="glyphicon glyphicon-edit">Manage Lecturer</span></div>
    			<div class="panel-body">
    				<div class="remove-messages"></div>
    				<table class="table" id="ManageLecturer">
		    			<thead>
		    				<tr>
		    					<th>First Name</th>
		    					<th>Last Name</th>
		    					<th>Gender</th>
		    					<th>Email</th>
		    					<th>Phone number</th>
		    					<th>Departement</th>
		    					<th style="width:20%;">Options</th>
		    				</tr>
		    			</thead>
		    			<tbody>
    						<?php 
    						$sql=" SELECT * FROM `Lecturer` where action <> 1 ";
									$result = $conn->query($sql);
									if ($result->num_rows > 0) {
										 while($row = $result->fetch_assoc()) {
                                            $res = mysql_query('select * from departement where dept_id = "'.$row['dept_id'].'"');
                                         $rec = mysql_fetch_assoc($res);
										echo " <tr>
								        <td class='center'>".$row['first_name']."</td>
								         <td class'center'>".$row['last_name']."</td>
								         <td class'center'>".$row['gender']."</td>
								         <td class'center'>".$row['email']."</td>
								         <td class'center'>".$row['phone']."</td>
                                         
								         <td class'center'>".$rec['dept_name']."</td>
								        <td class='center'>
                                            <a class='btn btn-danger' href='lecturer.php?DeleteID=".$row['lecturer_id']."'>
                                                <i class='glyphicon glyphicon-edit icon-white'></i>
                                                Delete
                                            </a>

								            <a class='btn btn-primary' href='lecturer.php?EditID=".$row['lecturer_id']."'>
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
    <script type="text/javascript" src="custom/js/Lecturer.js"></script>
    <script type="text/javascript" src="assets/plugins/DataTables-1.10.16/dataTables.min.js"></script>
   <link type="text/css" rel="stylesheet" href="assets/plugins/DataTables-1.10.16/dataTables.min.css">
	
	
