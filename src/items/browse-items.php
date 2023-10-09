<!DOCTYPE html> <link rel="stylesheet" href="../style.css">

<?php 

  session_start();

  $pet_type = $_GET['pet_type'];
  $item_type = $_GET['item_type'];

  if (!isset($pet_type) || !isset($item_type)) {
    header("Location: item-type-not-found.html");
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

    <div id="header">
        <img src="../../images/logo.png" style="float: right; padding: 0%;" height="130px">
      
        <h1 id="banner">SURBITON PET CLUB</h1>
        <p>est. 1953</p>

        <hr>
      </div>
      <div id="navbar">
        <p>
        <nav>
          <a id="button" href="../../index.html">Home</a>
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
								<a href="veiw-item.php?pet_type=' . $pet_type . ' & item_name=' . $name . '"><button class="veiw-item-button">£' . $price . '</button></a>
								</div>';
							
						} else {
							
							echo '<div class="veiw-item-grid-item">
								<img class="veiw-item-image" src="' . $img_path . '">
								<p class="veiw-discounted-item-description">' . $name . '</p>
								<p class="veiw-item-discount">' . $discount . '% off</p>
								<a href="veiw-item.php?pet_type=' . $pet_type . ' & item_name=' . $name . '"><button class="veiw-item-button">£' . $price . '</button></a>
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