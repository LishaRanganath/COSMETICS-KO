<?php
@include 'config.php';

if(isset($_POST['update_update_btn'])){
  $update_value=$_POST['update_quantity'];
  $update_id=$_POST['update_quantity_id'];
  $update_quantity_query=mysqli_query($conn,"UPDATE `cart` SET quantity='$update_value' WHERE pid='$update_id'");
  if($update_quantity_query){
    header('location:cart.php');
  };
};
if(isset($_GET['remove'])){
  $remove_id=$_GET['remove'];
  mysqli_query($conn,"DELETE FROM `cart` WHERE pid='$remove_id'");
  header('location:cart.php');
};
if(isset($_GET['delete_all'])){
  mysqli_query($conn,"DELETE FROM `cart`");
  header('location:cart.php');
};
 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <title>CART</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../css style/ssy.css">
    <link rel="stylesheet" type="text/css" href="../css style/ss5.css">
    <script src="../js/script1.js" defer></script>
  </head>
  <body>
    <?php include 'header1.php'; ?>
    <div class="container">
      <section class="shopping-cart">
        <h1 class="heading">SHOPPING CART</h1>
        <table>
          <thead>
            <th>IMAGE</th>
            <th>PRODUCT</th>
            <th>BRAND</th>
            <th>PRICE</th>
            <th>QUANTITY</th>
            <th>TOTAL PRICE</th>
            <th>ACTION</th>
          </thead>
          <tbody>
            <?php
              $select_cart=mysqli_query($conn,"SELECT * FROM `cart`");
              $grand_total =0;
              if((mysqli_num_rows($select_cart) > 0)){
                while($fetch_cart=mysqli_fetch_assoc($select_cart)){
                  $sub_total = number_format($fetch_cart['price'] * $fetch_cart['quantity']);
                  $grand_total += $sub_total ;
             ?>
             <tr>
               <td><img src="uploaded_img/<?php echo $fetch_cart['image'];?>" height="100"alt=""></td>
               <td><?php echo $fetch_cart['pname'];?></td>
               <td><?php echo $fetch_cart['brand'];?></td>
               <td>₹<?php echo number_format($fetch_cart['price']);?>/-</td>
               <td>
                 <form action="" method="post">
                   <input type="hidden" name="update_quantity_id" min="1" value="<?php echo $fetch_cart['pid'];?>">
                   <input type="number" name="update_quantity" min="1" value="<?php echo $fetch_cart['quantity'];?>">
                   <input type="submit" value="update" name="update_update_btn">
                 </form>
               </td>
                   <td>₹<?php echo $sub_total ?>/-</td>
                   <td><a href="cart.php?remove=<?php echo $fetch_cart['pid'];?>" onclick="return confirm('remove item from cart?');" class="delete-btn"><i class="fas fa-trash"></i>REMOVE</a></td>
                   </tr>
               <?php
                    };
                 };
              ?>
              <tr class="table-bottom">
                <td><a href="../index.html" class="option-btn" style="margin-top:0;">CONTINUE SHOPPING</a></td>
                <td colspan="4">GRAND TOTAL</td>
                <td>₹<?php echo $grand_total;?>/-</td>
                <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"><i class="fas fa-trash"></i>DELETE ALL</a></td>
              </tr>
            </tbody>
        </table>
        <div class="checkout-btn">
          <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout</a>
        </div>


      </section>
    </div>

  </body>
</html>
