<!DOCTYPE html> <link rel="stylesheet" href="../style.css">

<?php 

  session_start();

echo '1';

    $mysqli = require __DIR__ . "/stock-items-database.php";

echo '2';

	$result = $mysqli->query("SELECT * FROM items");

echo '3';
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	#print_r($row);
    echo "id: " . $row["Name"] . " - Name: " . $row["Price"] . " " . $row["Discount"] . "<br>";
  }
} else {
  echo "0 results";
}

echo '4';

    
?>