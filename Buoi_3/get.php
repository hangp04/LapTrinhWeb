<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiển thị Form GET</title>
</head>
<body>
    Sách <?php echo $_GET["tensach"]; ?>
    của tác giả <?php echo $_GET["tacgia"]; ?> 
    được nhà xuất bản <?php echo $_GET["nxb"]; ?> 
    sản xuất vào năm <?php echo $_GET["namxb"]; ?>
</body>
</html>
