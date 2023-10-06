<!DOCTYPE html> <link rel="stylesheet" href="../style.css">

<?php 

  session_start();

  $item_title = $_SESSION['veiwing-item'];

  $mysqli = require __DIR__ . "/stock-items-database.php";

  $sql = sprintf("SELECT * FROM items
  WHERE title = '%s'",
  $mysqli->real_escape_string($item_title));
    
  $result = $mysqli->query($sql);
    
  $item_data = $result->fetch_assoc();

  $item_ID = $item_data["ID"];
  $item_image_path = $item_data["Img_path"];
  $price = $item_data["Price"];
  $sale_percentage = $item_data["Discount"];
  $stock_quantity = $item_data["Stock_quantity"];
  $item_description = $item_data["Description"];
  $item_type = $item_data["Item_type"];
  $pet_type = $item_data["Pet_type"];
  $sale_percentage = '0';

?>

<html>
 
<head>
  
</head>

<body>

      <div id="navbar">
        <p>
        <nav>
          <a id="button" href="../index.html">Home</a>
          <a id="button" href="../Food-and-water/foodwater.html" width="10%">Food</a>
          <a id="button" href="../Bedding/bedding.html" width="10%">Bedding</a>
          <a id="button" href="../Housing/housing.html" width="10%">Housing</a>
          <a id="button" href="../Toys/toys.html" width="10%">Toys</a>
          <a id="button" href="../Hygine/hygiene.html" width="10%">Hygiene</a>
          <a id="button" href="../Fish/fish.html" width="10%">Fish</a>
          <a id="button" class="floatrightbutton" href="../accountManagement/signUp.html" width="10%">Register</a>
          <a id="button" class="floatrightbutton" href="../accountManagement/signIn.html" width="10%">Sign In</a>
        </nav>
        </p>
      </div>

    <div class="item-buy-content">
          <div>

              <div class="item-container">
                <div class="item-section item-section1">
                  <h3 class="item-title">Your Basket:</h3>
                </div>
                <div class="item-section item-section3">


                  <div class="cart-item-container">
                    <div class="cart-item-section cart-item-section1">
                      <?php
                        echo '<h3 class="item-title">' , $item_title , '</h3>';
                      ?>
                    </div>
                    <div class="cart-item-section cart-item-section2">
                      <img class="cart-item-image" height="20px" width="20px" src= <?php echo $item_image_path ?>>
                    </div>
                    <div class="cart-item-section cart-item-section3">

                      <p>hello</p>                 

                    </div>  
                    <div class="cart-item-section cart-item-section4">







                    <div class="item-price-background">
                  
                  <?php 
                  if ($sale_percentage === '0') {
                    echo '<p class="cart-item-price"><b>£' , $price , '</b></p>';
                    echo '<hr class="line">';
                  }
                  else {
                    echo '<p class="cart-item-price"><b><s>£' , $price , '</s> | £' , round($price * ((100-$sale_percentage)/100) , 2) , '</b></p>';
                    echo '<hr class="line">';
                    echo '<p class="cart-item-discount"><b>£10 off</b></p>';
                  }
                  ?>


                  <form action="<?php echo $_SERVER['PHP_SELF'] ?>">

                    <input type="number" class="cart-item-quantity-select" value=2> 
                    <input type="submit" class="cart-item-remove-from-cart-button" value="Remove">
                  
                  </form>

                </div>







                    </div>
                  </div>

                  <br>

                  <div class="cart-item-container">
                    <div class="cart-item-section cart-item-section1">
                      <?php
                        echo '<h3 class="item-title">' , $item_title , '</h3>';
                      ?>
                    </div>
                    <div class="cart-item-section cart-item-section2">
                      <img class="cart-item-image" height="20px" width="20px" src= <?php echo $item_image_path ?>>
                    </div>
                    <div class="cart-item-section cart-item-section3">

                      <p>hello</p>                 

                    </div>  
                    <div class="item-section item-section4">
                      <div class="item-price-background"><p>eee</div>
                    </div>
                  </div>




                </div>  
                <div class="item-section item-section4">
                  <div class="item-price-background">
                  
                  <?php 
                  if ($sale_percentage === '0') {
                    echo '<p class="cart-item-price"><b>£' , $price , '</b></p>';
                    echo '<hr class="line">';
                  }
                  else {
                    echo '<p class="cart-item-price"><b>TOTAL: <br><s>£' , $price , '</s> | £' , round($price * ((100-$sale_percentage)/100) , 2) , '</b></p>';
                    echo '<hr class="line">';
                    echo '<p class="cart-item-discount"><b>£10 off</b></p>';
                  }
                  ?>

                </div>

                  <form action="<?php echo $_SERVER['PHP_SELF'] ?>">

                    <input type="submit" class="item-add-to-basket-button" value="Procede to checkout >">
                  
                  </form>

                  <hr class="line" style="margin-top: 20px;">
                  <p>Got a discount code?<br> <a href="e.html">Add it</a></p>

                </div>
                <div class="cart-item-section cart-item-section5">

                </div>
              </div>

          </div>

        </div>
        <div class="footer">
          <li>Contact us</li>
          <li>Contact us</li>
          <li>Contact us</li>
          <li>Contact us</li>
          <li>Contact us</li>
        </div>
    </div>   
    
</body>
</html>