<?php
    $books = array();

    for ($i = 1; $i <= 100; $i++){
        $books[] = array("TenSach$i", "NoiDung$i");
    }

    $sosachmoitrang = 10;

    $tongsach = count($books);
    $tongtrang = ceil($tongsach / $sosachmoitrang);

    $tranghientai = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
    $tranghientai = max(1, min($tranghientai, $tongtrang));

    $startindex = ($tranghientai - 1) * $sosachmoitrang;

    $sosachhienthi = array_slice($books, $startindex, $sosachmoitrang);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 2</title>
    <link rel="stylesheet" href="../Buoi_1/bai2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <h1>Danh sách sách</h1>

    <table border="1">
        <tr>
            <th>STT</th>
            <th>Tên sách</th>
            <th>Nội dung sách</th>
        </tr>
        <?php foreach ($sosachhienthi as $index => $books): ?>
        <tr>
            <td><?php echo $startindex + $index + 1;?></td>
            <td><?php echo $books[0]; ?></td>
            <td><?php echo $books[1]; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <div class = "pagination">
        <?php for ($i = 1; $i <= $tongtrang; $i++): ?>
            <a href = "?page=<?php echo $i; ?>" class = "<?php echo $i == $tranghientai ? "active" : "" ; ?>">
                <?php echo $i; ?>
        </a>
        <?php endfor; ?>
    </div>
    <div class="return-home">
        <a href="../index/index.html" class="return"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
    </div>
</body>
</html>