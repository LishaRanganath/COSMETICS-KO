<?php
@include 'config.php';
if(isset($_POST['submit'])){
  $name=mysqli_real_escape_string($conn,$_POST['name']);
  $email=mysqli_real_escape_string($conn,$_POST['email']);
  $pass=md5($_POST['password']);
  $cpass=md5($_POST['cpassword']);
  $user_type=$_POST['user'];
  $select="SELECT * FROM admin WHERE email='$email' && password='$pass'";
  $result=mysqli_query($conn,$select);
  if(mysqli_num_rows($result) > 0){
    $error[]='user already exists';
  }else{
    if($pass != $cpass){
      $error[]='password not matched';
    }else{
      $insert="INSERT INTO admin(name,email,password,user) VALUES('$name','$email','$pass','$user_type')";
      mysqli_query($conn,$insert);
      header('location:login1.php');
    }
  }
};
 ?>




<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADMIN LOGIN</title>
    <link rel="stylesheet" href="../css style/sty.css">
  </head>
  <body>
    <div class="form-container">
        <form action="" method="post">
          <h3>Register Now</h3>
          <?php
          if(isset($error)){
            foreach ($error as $error){
              echo '<span class="error-msg">'.$error.'</span>';
            };
          };
           ?>
        <input type="text" name="name" required placeholder="Enter Your Name">
        <input type="email" name="email" required placeholder="Enter Your e-mail">
        <input type="password" name="password" required placeholder="Enter Your password">
        <input type="password" name="cpassword" required placeholder="Confirm the password">
        <select name="user">
          <option value="admin">Admin</option>
        </select>
        <input type="submit" value="Register Now" class="form-btn" name="submit">
        <p>Already have an account?<a href="login1.php">Login</a></p>
      </form>
    </div>


  </body>
</html>
