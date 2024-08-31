<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>form get</title>
</head>
<body>
    <form action="get.php" method="get">
        Tên sách: <input type="text" name="tensach"><br>
        Tác giả: <input type="text" name="tacgia"><br>
        Nhà xuất bản: <input type="text" name="nxb"><br>
        Năm xuất bản: <input type="number" name="namxb"><br>
        <button type="submit">Hiện thị</button>
    </form>
    <div class="return-home">
        <a href="../index/index.html" class="return"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
    </div>
</body>
</html>