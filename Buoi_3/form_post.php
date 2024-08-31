<?php 
    require 'post.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Post</title>
    <script src="bai1_client.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .error{
            color: red;
        }
    </style>
</head>
<body>
    <h2>Nhập thông tin:</h2>
    <p class="error">* Bắt buộc</p>
    <form name="bookForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()">
        Tên sách: <input type="text" name="tensach" value="<?php echo $tensach; ?>"> *<br>
        <div class="error" id="tensacherror"><?php echo $tensacherror; ?></div><br>

        Tác giả: <input type="text" name="tacgia" value="<?php echo $tacgia; ?>"> *<br>
        <div class="error" id="tacgiaerror"><?php echo $tacgiaerror; ?></div><br>

        Nhà xuất bản: <input type="text" name="nxb" value="<?php echo $nxb; ?>"> *<br>
        <div class="error" id="nxberror"><?php echo $nxberror; ?></div><br>

        Năm xuất bản: <input type="text" name="namxb" value="<?php echo $namxb; ?>"> *<br>
        <div class="error" id="namxberror"><?php echo $namxberror; ?></div><br>

        <input type="submit" value="Gửi thông tin">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($tensacherror) && empty($tacgiaerror) && empty($nxberror) && empty($namxberror)) {
        echo "<h3>Hiện thông tin</h3>";
        echo "Sách <strong>$tensach</strong> 
            của tác giả <strong>$tacgia</strong> 
            được nhà xuất bản <strong>$nxb</strong> 
            xuất bản vào năm <strong>$namxb</strong>";
    }
    ?>
    <div class="return-home">
        <a href="../index/index.html" class="return"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
    </div>
</body>
</html>
