<?php
    if (isset($_COOKIE["firstname"]) && isset($_COOKIE["lastname"]) && isset($_COOKIE["email"]) && isset($_COOKIE["invoiceID"])
    && isset($_COOKIE["payfor"]) && isset($_COOKIE["fileToUpLoad"])) {
        $userData = [
            "firstname" => isset($_COOKIE["firstname"]) ? $_COOKIE["firstname"] : "",
            "lastname" => isset($_COOKIE["lastname"]) ? $_COOKIE["lastname"] : "",
            "email" => isset($_COOKIE["email"]) ? $_COOKIE["email"] : "",
            "invoiceID" => isset($_COOKIE["invoiceID"]) ? $_COOKIE["invoiceID"] : "",
            "payfor" => isset($_COOKIE["payfor"]) ? json_decode($_COOKIE["payfor"], true) : [],
            "fileToUpLoad" => isset($_COOKIE["fileToUpLoad"]) ? $_COOKIE["fileToUpLoad"] : "",
            "add_in4" => isset($_COOKIE["add_in4"]) ? $_COOKIE["add_in4"] : ""
        ];    
    } else {
        echo "No data available.";
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
    <p><strong>Name:</strong> <?php echo htmlspecialchars($userData["lastname"] . ' '. $userData["firstname"]); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($userData["email"]); ?></p>
    <p><strong>Invoice ID:</strong> <?php echo htmlspecialchars($userData["invoiceID"]); ?></p>
    <p><strong>Pay For:</strong> <?php echo implode(", ", $userData["payfor"]); ?></p>
    <p><strong>Additional Information:</strong> <?php echo htmlspecialchars($userData["add_in4"]); ?></p>

    <?php if (!empty($userData["fileToUpLoad"])) : ?>
        <p>Uploaded Image:</p>
        <img src="<?php echo htmlspecialchars($userData["fileToUpLoad"]); ?>" alt="Uploaded Image" style="max-width:100%; height:auto;" /><br>
    <?php endif; ?>
    
    <a href="../Buoi_4/bai2_form.php">Go back to form</a>
</body>
</html>
