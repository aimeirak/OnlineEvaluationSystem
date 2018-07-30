<?php 
    session_start();
    if(!isset($_SESSION['userid'])){
        header('LOCATION:login.php');
    }
    include 'includes/header.php';
   require_once 'php_action/connection.php';
   require_once 'php_action/connect.php';
   $text_color = "";
   $msg = "";
   $edit_state = false;
   $dept_name  = "";
   $level = "";
 ?>
    <div class="container" class="col-lg-10 col-sm-10">
            <!-- content starts -->
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>
                <a href="Departement.php">Departement</a>
            </li>
        </ul>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><span class="glyphicon glyphicon-edit">Enter Departement</span></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <?php
                            if(isset($_POST['save'])){
                                $dept_name = mysql_real_escape_string($_POST['departementname']);
                                $level = mysql_real_escape_string($_POST['level']);
                                mysql_query('insert into departement values("","'.$dept_name.'","'.$level.'","")')or die(mysql_error());
                                $text_color = "alert alert-success";
                                $msg = "Well done! the Departement has been added.";
                            }
                            ?>
                        <?php
                            if(isset($_POST['update']))
                            {
                                $id = $_GET['EditID'];
                                $dept_name = mysql_real_escape_string($_POST['departementname']);
                                $level = mysql_real_escape_string($_POST['level']);
                                mysql_query("UPDATE departement set dept_name = '".$dept_name."', level ='".$level."' where dept_id = '".$id."'") or die(mysql_error());
                                $text_color = "alert alert-success";
                                $msg = "Well done! the Departement has been Updated.";
                                header('location:departement.php');
                                
                            }
                            if (isset($_GET['EditID'])) {
                                $id = $_GET['EditID'];
                                $edit_state = true; 
                                 $rec = mysql_query("SELECT * FROM departement where dept_id = $id") or die(mysql_error());
                                 $record = mysql_fetch_assoc($rec);
                                 $dept_name = $record['dept_name'];
                                 $level = $record['level'];
                             } 
                             if(isset($_GET['DeleteID'])){
                                $get_delete = (int) $_GET['DeleteID'];
                                mysql_query('update departement set action=1 where dept_id="'.$get_delete.'"')or die(mysql_error());
                                $text_color = "alert alert-success";
                                $msg = "Well done! Departement has been deleted.";
                            }
                        ?>

                        <div class="<?php echo $text_color;?>">
                            <?php echo $msg;?>
                        </div>
                    <form class="form-horizontal" id="submitProductForm" method="POST" action= "">
                     <div id="add-brand-messages"></div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Departement Name:</label>
                            <div class="col-sm-8">
                                <input type="text" name="departementname" id="departementname" placeholder="Enter Departement Name..." class="form-control" value="<?php echo $dept_name;?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Level:</label>
                            <div class="col-sm-8">
                                <input type="text" name="level" id="level" placeholder="Enter Level.." class="form-control" value="<?php echo $level; ?>" required >
                            </div>
                        </div>
                    </div> 
                </div>    
            </div>
        </div>
        <div class="panel-footer">
            <div class="input-group">
                <?php if ($edit_state == false):?>
                    <button type="submit" name="save" class="btn btn-primary" id="createdeptbtn" data-loading-text="loading...">Save Changes</button>
                <?php else: ?>
                    <button type="submit" name="update" class="btn btn-primary" id="updatedeptbtn" data-loading-text="loading...">Update Changes</button>
                <?php endif ?>
                
           </div>
        </div>
        </form>
    </div>
    		<div class="panel panel-default">
    			<div class="panel-heading"><span class="glyphicon glyphicon-edit">Manage Departement</span></div>
    			<div class="panel-body">
    				<div class="remove-messages"></div>
    				<table class="table" id="ManageDepartement">
		    			<thead>
		    				<tr>
                                <th>Department Name</th>
                                <th>Level Number</th>
		    					<th style="width:20%;">Options</th>
		    				</tr>
		    			</thead>
		    			<tbody>
    						<?php 
                            $sql="SELECT * FROM `departement` where action<>1";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                         while($row = $result->fetch_assoc()) {
                                        echo " <tr>
                                        <td class='center'>".$row['dept_name']."</td>
                                         <td class'center'>".$row['level']."</td>
                                         
                                        <td class='center'>
                                            <a class='btn btn-danger' style='background:red;' href='departement.php?DeleteID=".$row['dept_id']."'>
                                                <i class='glyphicon glyphicon-trash icon-white'></i>
                                                Delete
                                            </a>

                                            <a class='btn btn-primary' style='background:blue;' href='departement.php?EditID=".$row['dept_id']."'>
                                                <i class='glyphicon glyphicon-edit icon-white'></i>
                                                Edit
                                            </a>
                                        </td>
                                    </tr>";
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
    <script type="text/javascript" src="custom/js/Departement.js"></script>