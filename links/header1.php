<!DOCTYPE html>
<html>
<head>
  <title>header file</title>
</head>
<body>
<header class="header">
  <div class="flex">
    <?php
      $select_rows=mysqli_query($conn,"SELECT * FROM `cart`") or die('quer failed');
      $row_count=mysqli_num_rows($select_rows);
     ?>
    <a href="cart.php" class="cart">cart<span><?php echo $row_count?></span></a>
  </div>
</header>
</body>
