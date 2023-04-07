<?php
@include 'config.php';
if(isset($_POST['order_btn'])){
  $name=$_POST['name'];
  $number=$_POST['number'];
  $email=$_POST['email'];
  $method=$_POST['method'];
  $flat=$_POST['flat'];
  $street=$_POST['street'];
  $city=$_POST['city'];
  $state=$_POST['state'];
  $country=$_POST['country'];
  $pin_code=$_POST['pin_code'];
  $cart_query=mysqli_query($conn,"SELECT * FROM `cart`");
  $price_total=0;
  if(mysqli_num_rows($cart_query) > 0){
    while($product_item=mysqli_fetch_assoc($cart_query)){
      $product_name[]=$product_item['pname'].' ('.$product_item['quantity'] .' )';
      $product_price=number_format($product_item['price'] * $product_item['quantity']);
      $price_total += $product_price;
    };
  };
  $total_product=implode(', ',$product_name);
  $detail_query=mysqli_query($conn,"INSERT INTO `placeorder`(name,number,email,method,flat,street,city,state,country,pin_code,total_products,total_price)
  VALUES('$name','$number','$email','$method','$flat','$street','$city','$state','$country','$pin_code','$total_product','$price_total') ") or die('query failed');
  if($cart_query && $detail_query){
    echo "
    <div class='order-message-container'>
      <div class='message-container'>
        <h3>THANK YOU FOR SHOPPING</h3>
        <div class='order-detail'>
          <span>".$total_product."</span>
          <span class='total'>Total : ".$price_total."/- </span>
       </div>
       <div class='customer-details'>
         <p>Your Name: <span>".$name."</span></p>
         <p>Your Number: <span>".$number."</span></p>
         <p>Your e-mail: <span>".$email."</span></p>
         <p>Your Address: <span>".$flat.",".$street.",".$city.",".$state.",".$country.",".$pin_code."</span></p>
         <p>Payment Method: <span>".$method."</span></p>
         <p>(*pay when product arrives*)</p>
          </div>
          <a href='../index.php' class='btn'>CONTINUE SHOPPING</a>
        </div>
      </div>

    ";
  }
}

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <title>CHECKOUT</title>
    <link rel="stylesheet" href="../css style/ss5.css">
    <link rel="stylesheet" href="../css style/ssy.css">
    <script src="../js/script1.js" defer></script>
  </head>
  <body>
    <?php include 'heck.php'; ?>
    <div class="container">
      <h1 class="heading">COMPLETE YOUR ORDER</h1>
        <section class="checkout-form">
        <form action="" method="post">
          <div class="display-order">
            <?php
            $select_cart=mysqli_query($conn,"SELECT * FROM `cart`");
            $total=0;
            $grand_total=0;
            if(mysqli_num_rows($select_cart) > 0){
              while($fetch_cart=mysqli_fetch_assoc($select_cart)){
                $total_price=number_format($fetch_cart['price'] * $fetch_cart['quantity']);
                $grand_total= $total += $total_price;
              ?>
              <span><?= $fetch_cart['pname']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
              <?php
                  };
                }else {

                      echo "<div class='display-order'><span>YOUR CART IS EMPTY!</span></div>";
                };

               ?>
               <span class="grand-total">GRAND TOTAL :<?= $grand_total; ?></span>
          </div>
          <div class="flex">
            <div class="inputBox">
              <span>Your Name</span>
              <input type="text" placeholder="Enter Your Name" name="name" required>
            </div>
            <div class="inputBox">
              <span>Your Number</span>
              <input type="number" placeholder="Enter Your Number" name="number" required>
            </div>
            <div class="inputBox">
              <span>Your e-mail</span>
              <input type="email" placeholder="Enter Your e-mail" name="email" required>
            </div>
            <div class="inputBox">
              <span>Payment Method</span>
              <select name="method">
                <option value="cash on delivery">CASH ON DELIVERY</option>
                <option value="credit card">CREDIT CARD</option>
                <option value="paypal">PayPal</option>
                </select>
            </div>
            <div class="inputBox">
              <span>Address Line 1</span>
              <input type="text" placeholder="e.g. flat no." name="flat" required>
            </div>
            <div class="inputBox">
              <span>Address Line 2</span>
              <input type="text" placeholder="e.g. street name" name="street" required>
            </div>
            <div class="inputBox">
              <span>City</span>
              <input type="text" placeholder="e.g. mumbai" name="city" required>
            </div>
            <div class="inputBox">
              <span>State</span>
              <input type="text" placeholder="e.g. karnataka" name="state" required>
            </div>
            <div class="inputBox">
              <span>Country</span>
              <input type="text" placeholder="e.g. india" name="country" required>
            </div>
            <div class="inputBox">
              <span>Pin Code</span>
              <input type="text" placeholder="e.g. 12345" name="pin_code" required>
            </div>
          </div>
          <input type="submit" value="order now" name="order_btn" class="btn">
        </form>
      </section>
    </div>

  </body>
</html>
