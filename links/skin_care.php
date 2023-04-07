<?php
@include 'config.php';
if(isset($_POST['add_to_cart'])){
  $product_name=$_POST['product_name'];
  $product_brand=$_POST['product_brand'];
  $product_price=$_POST['product_price'];
  $product_image=$_POST['product_image'];
  $product_quantity=1;
  $select_cart=mysqli_query($conn,"SELECT * FROM `cart` WHERE pname='$product_name'");
  if(mysqli_num_rows($select_cart) > 0){
    $message[]='product already added into the cart';
  }else{
    $insert_product=mysqli_query($conn,"INSERT INTO `cart`(pname,brand,price,image,quantity) VALUES('$product_name','$product_brand','$product_price','$product_image','$product_quantity')");
    $message[]='product added sucessfully to cart';
  }
}
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <title>SKIN CARE</title>
    <link rel="stylesheet" type="text/css" href="../css style/style1.css">
    <link rel="stylesheet" type="text/css" href="../css style/ss2.css">

    <script src="../js/script.js" defer></script>
</head>
<body>

  <?php
    if(isset($message)){
      foreach ($message as $message) {
        echo '<div class="message"><span>'.$message.'</span><i class="fas fa-times" onclick="this.parentElement.style.display=`none`;"></i></div>';
      };
    };
   ?>
<?php include 'header1.php'; ?>
  <div class="container">
    <h2 class="title">SKIN CARE</h2>
    <div class="products-cont">
      <?php
        $select_products = mysqli_query($conn,"SELECT * FROM `skincare` ");
        if(mysqli_num_rows($select_products) > 0){
          while($fetch_product = mysqli_fetch_assoc($select_products)){
       ?>
       <form action="" method="post" >
      <div class="product" data-name="p-n">
        <img src="uploaded_img/<?php echo $fetch_product['image'];?>" height="200" width="200" alt="">
        <h3><?php echo $fetch_product['pname']; ?></h3>
        <div class="price">₹<?php echo $fetch_product['price']; ?></div>
        <input type="hidden" name="product_name" value="<?php echo $fetch_product['pname']?>">
        <input type="hidden" name="product_brand" value="<?php echo $fetch_product['brand']?>">
        <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']?>">
        <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']?>">
        <input type="submit" class="btn" value="Add to cart" name="add_to_cart">
</div>
</form>
<?php
    };
 };
?>
</div>
</div>




<footer class="main-footer">
<p>copyright &copy;COSMETICS KO</p>


                      </body>
                      </html>
