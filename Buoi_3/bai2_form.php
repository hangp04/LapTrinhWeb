<?php
    require 'bai2.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt Upload Form</title>
    <link rel="stylesheet" href="../Buoi_3/bai2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container">
        <h1>Payment Receipt Upload Form</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label for="name">Name</label>
                <div class="con">
                    <input type="text" name="firstname" id="firstname" value="<?php echo $firstname; ?>">
                    <input type="text" name="lastname" id="lastname" value="<?php echo $lastname; ?>">
                </div>
                <div class="con">
                    <label for="firstname">First Name</label>
                    <label for="lastname">Last Name</label>
                </div>
                <div class="con">
                    <div class="error" id="firstnameerror"><?php echo $firstnameerror; ?></div>
                    <div class="error" id="lastnameerror"><?php echo $lastnameerror; ?></div><br>
                </div>
            </div>
            <div>
                <div class="con">
                    <label for="email">Email</label>
                    <label for="invoiceID">Invoice ID</label>
                </div>
                <div class="con">
                    <input type="text" name="email" id="email" value="<?php echo $email; ?>">
                    <input type="text" name="invoiceID" id="invoiceID" value="<?php echo $invoiceID; ?>">
                </div>
                <div>
                    <label for="email">example@example.com</label>
                </div>
                <div class="con">
                    <div class="error" id="emailerror"><?php echo $emailerror; ?></div>
                    <div class="error" id="invoiceIDerror"><?php echo $invoiceIDerror; ?></div><br>
                </div>
            </div>
            <div>
                <label for="payfor">Pay For</label>
                <div class="con">
                    <div>
                        <input type="checkbox" name="payfor[]" id="15kcategory" value="15K Category">
                        <label for="15kcategory">15K Category</label><br>
                        <input type="checkbox" name="payfor[]" id="55kcategory" value="55K Category">
                        <label for="55kcategory">55K Category</label><br>
                        <input type="checkbox" name="payfor[]" id="116kcategory" value="116K Category">
                        <label for="116kcategory">116K Category</label><br>
                        <input type="checkbox" name="payfor[]" id="shuttletwoways" value="Shuttle Two Ways">
                        <label for="shuttletwoways">Shuttle Two Ways</label><br>
                        <input type="checkbox" name="payfor[]" id="compressporttshirtmerchandise" value="Compressport T-Shirt Merchandise">
                        <label for="compressporttshirtmerchandise">Compressport T-Shirt Merchandise</label><br>
                        <input type="checkbox" name="payfor[]" id="other" value="Other">
                        <label for="other">Other</label><br>
                    </div>
                    <div>
                        <input type="checkbox" name="payfor[]" id="35kcategory" value="35K Category">
                        <label for="35kcategory">35K Category</label><br>
                        <input type="checkbox" name="payfor[]" id="75kcategory" value="75K Category">
                        <label for="75kcategory">75K Category</label><br>
                        <input type="checkbox" name="payfor[]" id="shuttleoneway" value="Shuttle One Way">
                        <label for="shuttleoneway">Shuttle One Way</label><br>
                        <input type="checkbox" name="payfor[]" id="trainingcapmerchandise" value="Training Cap Merchandise">
                        <label for="trainingcapmerchandise">Training Cap Merchandise</label><br>
                        <input type="checkbox" name="payfor[]" id="bufmerchandise" value="Buf Merchandise">
                        <label for="bufmerchandise">Buf Merchandise</label><br>
                    </div>
                </div>
                <div class="error" id="payforerror"><?php echo $payforerror; ?></div><br>
            </div>
            <input type="submit" value="submit">
        </form>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($firstnameerror) && empty($lastnameerror) && empty($emailerror) && empty($invoiceIDerror) && empty($payforerror)){
                echo "$lastname $firstname has the email address $email and invoice ID $invoiceID, has purchased ". implode(", ", $payfor);
            }
        ?>
    </div>
    <div class="return-home">
        <a href="../index/index.html" class="return"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
    </div>
</body>
</html>