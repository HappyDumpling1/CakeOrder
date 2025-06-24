<?php
session_start();

// Connect to MySQL
$host = "localhost";
$user = "root";
$pass = ""; // replace with your password
$db = "cake";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get all values
  $Customer_Name = $conn->real_escape_string($_POST["name"]);
  $Customer_Address = $conn->real_escape_string($_POST["address"]);
  $Cake_Flavor = $conn->real_escape_string($_POST["flavor"]);
  $Delivery_Date = $conn->real_escape_string($_POST["delivery"]);
  $Toppings = isset($_POST["toppings"]) ? $_POST["toppings"] : [];

  // Insert to DB
  $sql = "INSERT INTO customer (Customer_Name, Customer_Address) VALUES ('$Customer_Name', '$Customer_Address')";
  if ($conn->query($sql) === TRUE) {
    // Save to session for confirmation page
    $_SESSION["name"] = $Customer_Name;
    $_SESSION["address"] = $Customer_Address;
    $_SESSION["flavor"] = $Cake_Flavor;
    $_SESSION["delivery"] = $Delivery_Date;
    $_SESSION["toppings"] = $Toppings;

    // Redirect to confirmation page
    header("Location: confirmation.php");
    exit();
  } else {
    echo "Error: " . $conn->error;
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Order a Cake</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .ingredient-box,
    .topping-box {
      display: none;
      margin-top: 10px;
      padding: 10px;
      background: #f4f4f4;
      border-radius: 5px;
    }
  </style>
</head>

<body>
  <div class="container">
    <h2>Place Your Cake Order</h2>
    <form method="POST">
      <label for="name">Customer Name:</label>
      <input type="text" id="name" name="name" required>

      <label for="address">Customer Address:</label>
      <input type="text" id="address" name="address" required>

      <label for="flavor">Cake Flavor:</label>
      <select id="flavor" name="flavor" required onchange="showOptions()">
        <option value="">-- Select Flavor --</option>
        <option value="chocolate">Chocolate</option>
        <option value="vanilla">Vanilla</option>
        <option value="strawberry">Strawberry</option>
      </select>

      <div id="toppings-section">
        <label>Toppings:</label>

        <div id="chocolate-toppings" class="topping-box">
          <label><input type="checkbox" name="toppings[]" value="Choco Sprinkles"> Choco Sprinkles</label><br>
          <label><input type="checkbox" name="toppings[]" value="Candy Sprinkles"> Candy Sprinkles</label>
        </div>

        <div id="vanilla-toppings" class="topping-box">
          <label><input type="checkbox" name="toppings[]" value="Choco Drizzle"> Choco Drizzle</label><br>
          <label><input type="checkbox" name="toppings[]" value="Candy Sprinkles"> Candy Sprinkles</label>
        </div>

        <div id="strawberry-toppings" class="topping-box">
          <label><input type="checkbox" name="toppings[]" value="Strawberry Toppings"> Strawberry Toppings</label><br>
          <label><input type="checkbox" name="toppings[]" value="Strawberry Sprinkles"> Strawberry Sprinkles</label>
        </div>
      </div>

      <div id="ingredients-section">
        <label>Ingredients:</label>

        <div id="chocolate-ingredients" class="ingredient-box">
          <strong>Chocolate Cake Ingredients:</strong>
          <ul>
            <li>Cocoa</li>
            <li>Eggs</li>
            <li>Milk</li>
            <li>Sugar</li>
            <li>Flour</li>
          </ul>
        </div>

        <div id="vanilla-ingredients" class="ingredient-box">
          <strong>Vanilla Cake Ingredients:</strong>
          <ul>
            <li>Vanilla Extract</li>
            <li>Eggs</li>
            <li>Butter</li>
            <li>Milk</li>
            <li>Flour</li>
          </ul>
        </div>

        <div id="strawberry-ingredients" class="ingredient-box">
          <strong>Strawberry Cake Ingredients:</strong>
          <ul>
            <li>Strawberry Extract</li>
            <li>Cream</li>
            <li>Sugar</li>
            <li>Eggs</li>
            <li>Flour</li>
          </ul>
        </div>
      </div>

      <label for="delivery">Delivery Date:</label>
      <input type="date" id="delivery" name="delivery" required>

      <button type="submit" class="button">Place Order</button>
    </form>

  </div>

  <script>
    function showOptions() {
      const flavors = ['chocolate', 'vanilla', 'strawberry'];
      const selected = document.getElementById("flavor").value;

      // Show relevant ingredients
      flavors.forEach(flavor => {
        document.getElementById(`${flavor}-ingredients`).style.display = (flavor === selected) ? 'block' : 'none';
        document.getElementById(`${flavor}-toppings`).style.display = (flavor === selected) ? 'block' : 'none';
      });
    }

    window.onload = () => {
      showOptions();
    };
  </script>
</body>

</html>