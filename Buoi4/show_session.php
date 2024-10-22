<?php
session_start();

if (isset($_SESSION["userData"])) {
    $userData = $_SESSION["userData"];
} else {
    echo "No data available.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt Information</title>
</head>
<body>
    <h2>User Payment Information</h2>
    <p><strong>Name:</strong> <?php echo htmlspecialchars($userData["lastname"] . ' ' . $userData["firstname"]); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($userData["email"]); ?></p>
    <p><strong>Invoice ID:</strong> <?php echo htmlspecialchars($userData["invoiceID"]); ?></p>
    <p><strong>Pay For:</strong> <?php echo implode(", ", $userData["payfor"]); ?></p>
    <p><strong>Additional Information:</strong> <?php echo htmlspecialchars($userData["add_in4"]); ?></p>

    <?php if (!empty($userData["fileToUpLoad"])) : ?>
        <p>Uploaded Image:</p>
        <img src="<?php echo htmlspecialchars($userData["fileToUpLoad"]); ?>" alt="Uploaded Image" style="max-width:100%; height:auto;" /><br>
    <?php endif; ?>
    
    <a href="../Buoi_4/bai2_formS.php">Go back to form</a>
</body>
</html>
