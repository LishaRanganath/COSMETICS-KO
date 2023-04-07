<!DOCTYPE html>
<html>
<head>
  <title>header file</title>
</head>
<body>
<header class="header">
  <div class="flex">
    <a href="#" class="logo">COSMETICS KO</a>
    <nav class="navbar">
      <a href="index.php">HOME</a>
      <a href="links/hair_care.php">HAIR-CARE</a>
      <a href="links/skin_care.php">SKIN-CARE</a>
      <a href="links/sanitizing_care.php">SANITIZING-CARE</a>
      <a href="links/makeup.php">MAKEUP</a>
    </nav>
    <?php
      $select_rows=mysqli_query($conn,"SELECT * FROM `cart`") or die('quer failed');
      $row_count=mysqli_num_rows($select_rows);
     ?>
    <a href="links/cart.php" class="cart">cart<span><?php echo $row_count?></span></a>
    <div id="menu-btn" class="fas fa-bars"></div>
  </div>
</header>
</body>
