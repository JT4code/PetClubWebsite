<!DOCTYPE html> <link rel="stylesheet" href="../style.css">

<?php 

  session_start();

  $pet_type = $_GET['pet_type'];
  $item_type = $_GET['item_type'];

  if (!isset($pet_type) || !isset($item_type)) {
    header("Location: item-type-not-set.html");
  }

  $mysqli = require __DIR__ . "/stock-items-database.php";

	$sql = sprintf("SELECT * FROM items
    WHERE Pet_type = '%s' AND Item_type = '%s'",
    $mysqli->real_escape_string($pet_type), $mysqli->real_escape_string($item_type));
  
     $result = $mysqli->query($sql);
    
?>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
          <a <?php if ($pet_type == "Fish" || $pet_type == "Fish ") { echo 'class="navbar-button-selected navbar-button-hide-on-small-width"';} else {echo 'class="navbar-button navbar-button-hide-on-small-width" href="Fish/Fish.html"';} ?> width="10%">Fish</a>
          <a <?php if ($pet_type == "Reptiles" || $pet_type == "Reptiles ") { echo 'class="navbar-button-selected navbar-button-hide-on-small-width"';} else {echo 'class="navbar-button navbar-button-hide-on-small-width" href="Reptiles/Reptiles.html"';} ?> width="10%">Reptiles</a>

          <a class="navbar-button navbar-float-right-button navbar-register-button" href="accountManagement/signUp.html" width="10%">Register</a>
          <a class="navbar-button navbar-float-right-button" href="accountManagement/signIn.html" width="10%">Sign In</a>
        </nav>
      </div>

    <div class="content">

          <h2 class="pagetitle"><?php echo $item_type; ?></h2>

          <div>

            <div class="grid-container">

            <?php

				if ($result->num_rows > 0) {
					while($item_data = $result->fetch_assoc()) {
						$name = $item_data["Name"];
						$price = $item_data["Price"];
						$discount = $item_data["Discount"];
						$img_path = $item_data["Img_path"];
												
						if ($discount === '0') {
							
							echo '<div class="veiw-item-grid-item">
								<img class="veiw-item-image" src="' . $img_path . '">
								<p class="veiw-item-description">' . $name . '</p>
								<a href="veiw-item.php?pet_type=' . $pet_type . '&item_name=' . $name . '"><button class="veiw-item-button">£' . $price . '</button></a>
								</div>';
							
						} else {
							
							echo '<div class="veiw-item-grid-item">
								<img class="veiw-item-image" src="' . $img_path . '">
								<p class="veiw-discounted-item-description">' . $name . '</p>
								<p class="veiw-item-discount">' . $discount . '% off</p>
								<a href="veiw-item.php?pet_type=' . $pet_type . '&item_name=' . $name . '"><button class="veiw-item-button">£' . $price . '</button></a>
                  				</div>';
							
						}
				  }
				} else {
				  echo "No results";
				}
            
            ?>

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