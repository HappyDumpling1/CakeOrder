<?php
session_start();

$name = $_SESSION["name"] ?? 'N/A';
$address = $_SESSION["address"] ?? 'N/A';
$flavor = $_SESSION["flavor"] ?? 'N/A';
$delivery = $_SESSION["delivery"] ?? 'N/A';
$toppings = $_SESSION["toppings"] ?? [];
$toppingsList = implode(", ", $toppings);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Confirmed</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h2>Thank you for your order, <?php echo htmlspecialchars($name); ?>!</h2>
    <p><strong>Address:</strong> <?php echo htmlspecialchars($address); ?></p>
    <p><strong>Flavor:</strong> <?php echo htmlspecialchars($flavor); ?></p>
    <p><strong>Toppings:</strong> <?php echo htmlspecialchars($toppingsList); ?></p>
    <p><strong>Delivery Date:</strong> <?php echo htmlspecialchars($delivery); ?></p>
    
    <p>We received your cake order and will deliver it on your selected date.</p>
    <a href="index.html" class="button">Back to Home</a>
  </div>
</body>
</html>
