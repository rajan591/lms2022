<?php
$title='login page';
  include "connection.php";
function validateUserData($value) {


  //remove space
  $value = trim($value);
  //remove back slash from string
  $value = stripslashes($value);
  //encode special character
  $value = htmlspecialchars($value);
  //escape special character before inserting into database table

  //return value
  return $value;
}
    if(isset($_POST['submit']))
    {
           $err = [];
    if (isset($_POST['username']) && !empty($_POST['username'])) {
      $username =   validateUserData($_POST['username']);

    } else {
      $err['username']  = "Enter Username";
    }

    if (isset($_POST['password']) && !empty($_POST['password'])) {
      $password =   validateUserData($_POST['password']);
    } else {
      $err['password'] =  "Enter password";
    }

    
    if (count($err) == 0) {
    
      require_once "connection.php";

      //query to select data form database with user provided username and password
      $sql = "select * from admin where name='$username' and password='$password'";
      //execute
      $result =$db->query($sql);
    //   print_r($result);

      if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        //print_r($user);
        session_start();
        //store username into session
      $_SESSION['RollNo'] = $_POST['username']; 
        $_SESSION['pic']= $user['pic'];
        //check remember me button
      
        header("location:profile.php");
      } else {
        $msg =  "Login failed";
      }
    }
}
 ?>



<!DOCTYPE html>
<html>
<head>

  <title>admin Login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  
  <style type="text/css">
  .xyz{
           
            position: fixed;
            left: 50%;
            margin-left: -100px;
            border: 1px solid;
  padding: 10px;
  box-shadow: 5px 10px black;
  background-color: #888888;
        }
  </style>   
</head>
<body>

<section>
  <div class="log_img">

   <br>
    <div class="box1">
        <h1 style="text-align: center; font-size: 35px;font-family: Lucida Console;">Library Management System</h1>
        <h1 style="text-align: center; font-size: 25px;">Admin Login Form</h1><br>

       

          <?php if(isset($_GET['msg']) && $_GET['msg'] == 1){ ?>
      <p class="err_message"><i>please login to access dashboard<i></p>
    <?php }  ?>

    <?php if(isset($msg)){ ?>
      <p class="alert alert-danger"><?php echo $msg ?></p>
    <?php }  ?>
     <div class="xyz">

      <form  name="login" action="" method="post" >
        
        <div class="login">
          <input class="form-control-lg" type="text" name="username" placeholder="Username" > <br>
           <?php if (isset($err['username'])) { ?>
             <span class="text-danger"><?php echo $err['username']; ?></span>
           <?php } ?>
           </br>
          <input class="form-control-lg" type="password" name="password" placeholder="Password" > <br>
           <?php if (isset($err['password'])) { ?>
             <span class="text-danger"><?php echo $err['password']; ?></span>
           <?php } ?><br>
          <input class="btn btn-primary" type="submit" name="submit" value="Login"> 
            <p style="color: white; padding-left: 15px;">
        <br><br>
        <a style="color:white; float: center; padding-left: 130px;"  href="update_password.php">Forgot password?</a> 
       
      </p>
        </div>
           </div>
      
    
        <small class="text-muted">
         <?php if(isset($err['msssage'])) echo $err['message']; ?>
       </small>
    </form>
    </div>
  </div>
</section>



</body>
</html>