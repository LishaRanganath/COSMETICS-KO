<?php
@include 'config.php';
if(isset($_POST['add_product'])){
  $p_name=$_POST['pname'];
  $p_brand=$_POST['brand'];
  $p_price=$_POST['price'];
  $p_image=$_FILES['image']['name'];
  $p_image_tmp_name=$_FILES['image']['tmp_name'];
  $p_image_folder='uploaded_img/'.$p_image;

  $insert_query=mysqli_query($conn,"INSERT INTO `sanitise`(pname,brand,price,image) VALUES('$p_name','$p_brand','$p_price','$p_image')") or die('query failed');
  if($insert_query){
    move_uploaded_file($p_image_tmp_name,$p_image_folder);
    $message[]='product added successfully';
  }else{
    $message[]='could not add the product';
  }
};
if(isset($_GET['delete'])){
  $delete_id=$_GET['delete'];
  $delete_query=mysqli_query($conn,"DELETE FROM `sanitise` WHERE pid=$delete_id") or die('query failed');
  if($delete_query){
    header('location:admin3.php');
    $message[]='product deleted';
  }else{
    $message[]='product coude not be deleted';
  };
};
if(isset($_POST['update_product'])){
  $update_p_id=$_POST['update_p_id'];
  $update_p_pname=$_POST['update_p_pname'];
  $update_p_barnd=$_POST['update_p_brand'];
  $update_p_price=$_POST['update_p_price'];
  $update_p_image=$_FILES['update_p_image']['name'];
  $update_p_image_tmp_name=$_FILES['$update_p_image']['tmp_name'];
  $update_p_image_folder='uploaded_img/'.$update_p_image;

  $update_query=mysqli_query($conn,"UPDATE `sanitise` SET pname='$update_p_pname',brand='$update_p_brand', price='$update_p_price',image='$update_p_image' WHERE pid='$update_p_id'");
  if($update_query){
    move_uploaded_file($update_p_image_tmp_name,$update_p_image_folder);
    $message[]='product updated successfully';
    header('location:admin3.php');
  }else{
    $message[]='could not update the product';
    header('location:admin3.php');
  }
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ADMIN PANEL</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="../css style/ssy.css">
  <script src="../js/script1.js" defer></script>
</head>
<body>
  <?php
    if(isset($message)){
      foreach ($message as $message) {
        echo '<div class="message"><span>'.$message.'</span><i class="fas fa-times" onclick="this.parentElement.style.display=`none`;"></i></div>';
      };
    };
   ?>
<?php include 'hase.php'; ?>
  <div class="container">
    <section>
      <form action="" method="post" class="add-product-form" enctype="multipart/form-data">
        <h3>ADD A NEW PRODUCT</h3>
        <input type="text" name="pname" placeholder="enter the product name" class="box" required>
        <input type="text" name="brand" placeholder="enter the product brand" class="box" required>
        <input type="text" name="price" min="0" placeholder="enter the product price" class="box" required>
        <input type="file" name="image" accept="image/png, image/jpg, image/jpeg" class="box" required>
        <input type="submit" value="add the product" name="add_product" class="btn">
      </form>
    </section>
    <section class="display-product-table">
      <table>
        <thead>
          <th>PRODUCT IMAGE</th>
          <th>PRODUCT NAME</th>
          <th>BRAND</th>
          <th>PRODUCT PRICE</th>
          <th>ACTION</th>
        </thead>
        <tbody>
          <?php
             $select_products=mysqli_query($conn,"SELECT * FROM `sanitise`");
             if(mysqli_num_rows($select_products) > 0){
               while($row=mysqli_fetch_assoc($select_products)){
           ?>
           <tr>
             <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100"alt=""></td>
             <td><?php echo $row['pname']; ?></td>
             <td><?php echo $row['brand']; ?></td>
             <td>₹<?php echo $row['price']; ?>/-</td>
             <td>
               <a href="admin3.php?delete=<?php echo $row['pid']; ?>" class="delete-btn" onclick="return confirm('are you sure you want to delete this?');"><i class="fas fa-trash"></i>DELETE</a>
               
           </td>
           </tr>
           <?php
               };
            }else{
              echo "<div class='empty'>no product added</div>";
            };
            ?>
          </tbody>
        </table>
      </section>
      <section class="edit-form-container">
        <?php
         if(isset($_GET['edit']));
          $edit_id=$_GET['edit'];
          $edit_query=mysqli_query($conn,"SELECT * FROM `sanitise` WHERE pid=$edit_id");
          if(mysqli_num_rows($edit_query) > 0){
            while($fetch_edit = mysqli_fetch_assoc($edit_query)){
         ?>
         <form action="" method="post" enctype="multipart/form-data">
           <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
           <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['pid'];?>">
           <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['pname'];?>">
           <input type="text" class="box" required name="update_p_brand" value="<?php echo $fetch_edit['brand'];?>">
           <input type="text" min="0" class="box" required name="update_p_price" value="<?php echo $fetch_edit['price'];?>">
           <input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
           <input type="submit" value="update the product" name="update_product" class="btn">
           <input type="reset" value="cancel" id="close-edit" class="option-btn">
         </form>
         <?php
                 };
               };
             echo "<script>document.querySelector('.edit-form-container').style.display='none';</script>"

          ?>
        </section>

             </div>
</body>
</html>
