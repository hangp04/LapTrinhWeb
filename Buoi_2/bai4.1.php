<?php
    require 'bai4.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 4</title>
    <link rel="stylesheet" href="../Buoi_2/bai4.css">
</head>
<body>
    <h1>Array Functions</h1>
    <div class="container">
        <div>
            <form action="" method="GET">
                <fieldset>
                    <legend>Mảng cần xử lý (Cách nhau bởi dấu cách):</legend>
                    <input type="text" id="array" name="array" value="<?php echo isset($_GET['array']) ? $_GET['array'] : ''; ?>" required>
                </fieldset>
                <fieldset>
                    <legend>Số cần tìm trong mảng:</legend>
                    <input type="number" id="So_Can_Tim" name="So_Can_Tim" value="<?php echo $SoCanTim; ?> ">
                </fieldset>
                <button type="submit">Kết quả</button>
            </form>
        </div>
        <div>
            <?php if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($array)): ?>
                <p>Mảng ban đầu: <?php echo implode(", ", $array) ;?></p>
                <p>Giá trị lớn nhất trong mảng: <?php echo $LonNhat; ?></p>
                <p>Giá trị nhỏ nhất trong mảng: <?php echo $NhoNhat; ?></p>
                <p>Tổng các phần tử trong mảng: <?php echo $Tong; ?></p>
                <p>Mảng sau khi sắp xếp: <?php echo implode(", ", $arraySapXep); ?></p>
                <p>Số <?php echo $SoCanTim ; ?> <?php echo $Found ? " có " : " không có "; ?> trong mảng</p>
            <?php endif; ?>   
        </div>   
    </div>

</body>
</html>