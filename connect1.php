<?php
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $pno = $_POST['pno'];
  if(!empty($fname)||!empty($lname)||!empty($email)||!empty($pno)){
  $host="localhost";
  $username="root";
  $password="";
  $dbname="cosmetics";
  $conn = new mysqli($host,$username,$password,$dbname);
  if(mysqli_connect_error())
  {
    die('connect error'.mysqli_connect_error());
  }else{
    $SELECT="SELECT email From  register  WHERE email=? Limit 1";
    $INSERT="INSERT INTO  register (fname,lname,email,pno) values(?,?,?,?)";
    $stmt= $conn->prepare($SELECT);
    $stmt->bind_param('s',$email);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->store_result();
    $rnum=$stmt->num_rows;
    if($rnum==0){
       $stmt->close();
       $stmt= $conn->prepare($INSERT);
       $stmt->bind_param("sssi",$fname,$lname,$email,$pno);
       $stmt->execute();
       echo "new record inserted sucessfully";
    }else{
      echo " someone already registered using this email";
    }
    $stmt->close();
    $conn->close();
  }
}
else{
  echo "all fields are required";
  die();
}

?>
