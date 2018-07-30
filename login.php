<?php
  require_once 'php_action/connection.php';
  require_once 'php_action/connect.php';
session_start();
if(isset($_GET['LogOut'])){
    session_destroy();
    header('LOCATION:login.php');
  }else{
    if(isset($_SESSION['userid'])){
      header('LOCATION:index.php');
    }
  }

?>

 <!DOCTYPE html>
 <html>
  <head>
    <title>Evaluation Management System</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="custom/css/style.css">
    <script type="text/javascript" src="assets/jquery/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/jquery-ui/jquery-ui.min.css">
    <script type="text/javascript" src="assets/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
    <style type="text/css">
      body{
        background-image: url("images/bg-image.jpg");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }
    </style>
  </head>
  <body style="background-color:#35475e;">
    <div class="container">
      <div class="row vertical">
        <div class="col-md-5 col-md-offset-4">
          <div class="panel panel-info">
            <div class="panel-heading" style="background-color:#35475e;">
              <h3 class="panel-title" >Please Sign In</h3>
            </div>
            <div class="panel-body">
              <?php
                if(isset($_POST['login'])){
                  $u_type = mysql_real_escape_string($_POST['u_type']);
                  $username = mysql_real_escape_string($_POST['username']);
                  $password = mysql_real_escape_string($_POST['password']);
                  if($u_type == 1  or $u_type == 4){
                    $tb_hod = mysql_query('select * from admin where user_name="'.$username.'" AND password="'.$password.'" AND action=0');
                    $row_ad = mysql_fetch_assoc($tb_hod);
                    if(mysql_num_rows($tb_hod) != 0){
                      $_SESSION['userid'] = true;
                      $_SESSION['userLog'] = $row_ad['admin_id'];
                      $_SESSION['user_type'] = 1;
                      header('LOCATION:index.php');
                    }else{
                      echo'<div class="alert alert-danger">Inccorrect username or password !</div>';
                    }
                  }else if($u_type == 2){
                    $tb_le = mysql_query('select * from lecturer where user_name="'.$username.'" AND password="'.$password.'" AND action=0');
                    $row_le = mysql_fetch_assoc($tb_le);
                    if(mysql_num_rows($tb_le) != 0){
                      $_SESSION['userid'] = true;
                      $_SESSION['userLog'] = $row_le['lecturer_id'];
                      $_SESSION['user_type'] = 2;
                      header('LOCATION:index.php');
                    }else{
                      echo'<div class="alert alert-danger">Inccorrect username or password !</div>';
                    }
                  }else if($u_type == 3){
                    $tb_std = mysql_query('select * from student where user_name="'.$username.'" AND password="'.$password.'" AND action=0');
                    $row_std = mysql_fetch_assoc($tb_std);
                    if(mysql_num_rows($tb_std) != 0){
                      $_SESSION['userid'] = true;
                      $_SESSION['userLog'] = $row_std['student_id'];
                      $_SESSION['user_type'] = 3;
                      header('LOCATION:Evaluation.php');
                    }else{
                      echo'<div class="alert alert-danger">Inccorrect username or password !</div>';
                    }
                  }else{
                      echo'<div class="alert alert-warning">Plz, specify your User Type !</div>';
                  }
                }
              ?>
              <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" id="loginForn">
                  <div class="form-group">
                    <label class="col-sm-3 control-label">User type</label>
                    <div class="col-sm-9">
                        <select name="u_type" id="level" placeholder="choose Status.." class="form-control">
                            <option value="0">Choose Type</option>
                            <option value="1">ADMIN</option>
                            <option value="2">Trainer</option>
                            <option value="3">Student</option>
                            <option value="4">HOD</option>
                        </select>
                    </div>
                 </div>
                <div class="form-group">
                  <label for="username" class="col-sm-3 control-label">Username</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Please Enter username" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="password" class="col-sm-3 control-label">Password</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Please Enter Password" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="login" class="btn btn-default"><i class="glyphicon glyphicon-log-in"></i> Login </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="footer" style="color:#fff; padding-top:6%; background-color:;">
        <p>Tom & aime</p>
      </div>
    </div>
  </body>
</html>
