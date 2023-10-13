<!DOCTYPE html> <link rel="stylesheet" href="../style.css">

<?php 

  session_start();

  if (!(isset($_GET['quantity']))) {
    $name = $_GET['item_name'];
    $pet_type = $_GET['pet_type'];

    $mysqli = require __DIR__ . "/stock-items-database.php";

    $sql = sprintf("SELECT * FROM items
    WHERE name = '%s' AND pet_type = '%s'",
    $mysqli->real_escape_string($name), $mysqli->real_escape_string($pet_type));
      
    $result = $mysqli->query($sql);

    if (mysqli_num_rows($result) == 0) {
      header("Location: item-not-found.html");
    }
      
    $item_data = $result->fetch_assoc();

    $price = $item_data["Price"];
    $sale_percentage = $item_data["Discount"];
    $description = $item_data["Description"];
    $img_path = $item_data["Img_path"];
    $stock_quantity = $item_data["Stock_quantity"];
    $item_type = $item_data["Item_type"];

    $_SESSION["veiwing-item"] = $name;

  } else {

    $name = $_SESSION["veiwing-item"];
    $purchase_quantity = $_GET['quantity'];

    if (!(isset($_SESSION['cart']))) {
      $_SESSION['cart'];
    }
  
    if(!($purchase_quantity > 0 && filter_var($purchase_quantity, FILTER_VALIDATE_INT))) {
      die ("bad quantity");
    }
    
    if(isset($_SESSION['cart'][$name])) {
  
      $_SESSION['cart'][$name] += $purchase_quantity;
  
    } else {
  
      $_SESSION['cart'][$name] = $purchase_quantity;

    }
  
    header("Location: cart.php");

  }

?>

<html>
 
<head>
  
</head>

<body>
  <div class="page">
      <div id="header">        
        <img src="images/Picture2.png" style="float: right; padding: 0%; margin-top: 20px;" height="100px">
        <p  style="float: right; margin-top: 60px;">proud to<br> be partnered with</p>
        <img src="images/logo.png" style="float: right; padding: 0%;" height="130px">

        <h1 id="banner">IT'S RAINING CATS AND DOGS</h1>
        <p>est. 1953</p>

        <hr>
      </div>
      <div class="navbar">
        <hr class="navbar-line">
        <nav>
          <a class="navbar-button" href="../index.html">Home</a>
          <a <?php if ($pet_type == "Cats" || $pet_type == "Cats ") { echo 'class="navbar-button-selected navbar-button-hide-on-small-width"';} else {echo 'class="navbar-button navbar-button-hide-on-small-width" href="Cats/Cats.html"';} ?> width="10%">Cats</a>
          <a <?php if ($pet_type == "Dogs" || $pet_type == "Dogs ") { echo 'class="navbar-button-selected navbar-button-hide-on-small-width"';} else {echo 'class="navbar-button navbar-button-hide-on-small-width" href="Dogs/Dogs.html"';} ?> width="10%">Dogs</a>
          <a <?php if ($pet_type == "Rabbits" || $pet_type == "Rabbits ") { echo 'class="navbar-button-selected navbar-button-hide-on-small-width"';} else {echo 'class="navbar-button navbar-button-hide-on-small-width" href="Rabbits/Rabbits.html"';} ?> width="10%">Rabbits</a>
          <a <?php if ($pet_type == "Chickens" || $pet_type == "Chickens ") { echo 'class="navbar-button-selected navbar-button-hide-on-small-width"';} else {echo 'class="navbar-button navbar-button-hide-on-small-width" href="Chickens/Chickens.html"';} ?> width="10%">Chickens</a>
          <a <?php if ($pet_type == "Rodents" || $pet_type == "Rodents ") { echo 'class="navbar-button-selected navbar-button-hide-on-small-width"';} else {echo 'class="navbar-button navbar-button-hide-on-small-width" href="Rodents/Rodents.html"';} ?> width="10%">Rodents</a>
          <a <?php if ($pet_type == "Fish" || $pet_type == "Fish ") { echo 'class="navbar-button-selected navbar-button-hide-on-small-width"';} else {echo 'class="navbar-button navbar-button-hide-on-small-width href="Fish/Fish.html"';} ?> width="10%">Fish</a>
          <a <?php if ($pet_type == "Reptiles" || $pet_type == "Reptiles ") { echo 'class="navbar-button-selected navbar-button-hide-on-small-width"';} else {echo 'class="navbar-button navbar-button-hide-on-small-width" href="Reptiles/Reptiles.html"';} ?> width="10%">Reptiles</a>

          <a class="navbar-button navbar-float-right-button navbar-register-button" href="accountManagement/signUp.html" width="10%">Register</a>
          <a class="navbar-button navbar-float-right-button" href="accountManagement/signIn.html" width="10%">Sign In</a>
        </nav>
      </div>

    <div class="item-buy-content">
          <div>

              <div class="item-container">
                <div class="item-section item-section1">
                  <?php
                    echo '<h3 class="item-title">' , $name , '</h3>';
                  ?>
                </div>
                <div class="item-section item-section2">
                  <img class="item-image" height="100px" width="100px" src= <?php echo $img_path ?>>
                </div>
                <div class="item-section item-section3">

                  <?php
                    echo '<p class="item-text">' , $description , '</p>';
                  ?>

                </div>  
                <div class="item-section item-section4">
                  <div class="item-price-background">
                  
                  <?php 
                  if ($sale_percentage === '0') {
                    echo '<p class="item-price"><b>£' , $price , '</b></p>';
                    echo '<hr class="line">';
                  }
                  else {
                    echo '<p class="item-price"><b><s>£' , $price , '</s> | £' , round($price * ((100-$sale_percentage)/100) , 2) , '</b></p>';
                    echo '<hr class="line">';
                    echo '<p class="item-discount"><b>' , $sale_percentage , '% off</b></p>';
                  }
                  ?>

                  </div>

                  <?php
                  if ($stock_quantity === '0') {
                    echo '<p class="out-of-stock-label">Out Of Stock</p>';
                  }
                  else if ($stock_quantity <= 10 & $stock_quantity > 0) {
                    echo '<p class="in-stock-label">', $stock_quantity , ' remaining</p>';
                  }
                  else {
                    echo '<p class="in-stock-label">In Stock</p>';
                  }
                  ?>

                  <form action="<?php echo $_SERVER['PHP_SELF'] ?>">

                    <p class="quantity-label">Quantity: </p> <input class="quantity-select" name="quantity" type="number" min="1" step="1" value="1">

                    <?php 

                      if(isset($purchase_quantity)) {
                        if($purchase_quantity <= 0) {
                          echo "<p> Please enter a value greater than 0";
                        } else if(!is_int($purchase_quantity)) {
                          echo "<p> Please enter an integer";
                        }
                      }

                    ?>

                    <input type="submit" class="item-add-to-basket-button" value="Add to basket >">
                  
                  </form>

                  <a href="ourstory.html"><button class="item-buy-now-button">Buy now ></button></a>
                  <br>
                  <?php
                  echo '<a href="browse-items.php?pet_type='. $pet_type , '&item_type=' , $item_type . '"><button class="item-veiw-others-button">< Keep looking</button></a>';
                  ?>

                  <hr class="line" style="margin-top: 20px;">
                  <p>Already bought one?<br> <a href="e.html">Leave a reveiw</a></p>

                </div>
                <div class="item-section item-section5">
                  <h3><u>Reviews:</u></h3>
                  
                  <div class="item-review">
                    <h4 class="review-title"><u>Review 1:</u></h4>
                    <p class="review-comment">great product!</p>
                  </div>
                  <div class="item-review">
                    <h4 class="review-title"><u>Review 1:</u></h4>
                    <p class="review-comment">great product!</p>
                  </div>
                  <div class="item-review">
                    <h4 class="review-title"><u>Review 1:</u></h4>
                    <p class="review-comment">great product!</p>
                  </div>

                  <div class="reveiw">

                  </div>
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