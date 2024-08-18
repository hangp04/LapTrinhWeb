<?php
// Hàm cộng hai số
function add($a, $b) {
    return $a + $b;
}

// Hàm trừ hai số
function subtract($a, $b) {
    return $a - $b;
}

// Hàm nhân hai số
function multiply($a, $b) {
    return $a * $b;
}

// Hàm chia hai số
function divide($a, $b) {
    // Kiểm tra chia cho 0
    if ($b == 0) {
        return 'Không thể chia cho 0';
    } else {
        return $a / $b;
    }
}

// Hàm kiểm tra số nguyên tố
function isPrime($number) {
    if ($number < 2) {
        return false; // Số nhỏ hơn 2 không phải số nguyên tố
    }
    for ($i = 2; $i <= sqrt($number); $i++) {
        if ($number % $i == 0) {
            return false; // Nếu chia hết cho số khác ngoài 1 và chính nó thì không phải số nguyên tố
        }
    }
    return true; // Số nguyên tố
}

// Hàm kiểm tra số chẵn
function isEven($number) {
    return $number % 2 == 0; // Số chẵn nếu chia hết cho 2
}

// Lấy dữ liệu từ form gửi lên
$a = isset($_POST['a']) ? (int)$_POST['a'] : 0; // Nếu không có giá trị, mặc định là 0
$b = isset($_POST['b']) ? (int)$_POST['b'] : 0; // Nếu không có giá trị, mặc định là 0

// Tính toán các phép toán
$sum = add($a, $b); // Tổng
$difference = subtract($a, $b); // Hiệu
$product = multiply($a, $b); // Tích
$quotient = divide($a, $b); // Thương

// Kiểm tra số nguyên tố
$aIsPrime = isPrime($a); // Kiểm tra số nguyên tố cho $a
$bIsPrime = isPrime($b); // Kiểm tra số nguyên tố cho $b

// Kiểm tra số chẵn
$aIsEven = isEven($a); // Kiểm tra số chẵn cho $a
$bIsEven = isEven($b); // Kiểm tra số chẵn cho $b
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Bài 3: Xử lý các phép tính</title>
    <link rel="stylesheet" href="../Buoi_1/bai3.css">
</head>
<body>
    <div class="container">
        <h1>Bài 3: Xử lý các phép tính</h1>
        
        <!-- Form nhập liệu -->
        <form method="POST" action="">
            <label for="a">Số thứ nhất:</label>
            <input type="number" id="a" name="a" value="<?php echo $a; ?>" required>
            <label for="b">Số thứ hai:</label>
            <input type="number" id="b" name="b" value="<?php echo $b; ?>" required>
            <button type="submit">Tính toán</button>
        </form>
        
        <div class="result">
            <h2>Kết quả tính toán:</h2>
            <p>Tổng của <?php echo $a; ?> và <?php echo $b; ?> là: <?php echo $sum; ?></p>
            <p>Hiệu của <?php echo $a; ?> và <?php echo $b; ?> là: <?php echo $difference; ?></p>
            <p>Tích của <?php echo $a; ?> và <?php echo $b; ?> là: <?php echo $product; ?></p>
            <p>Thương của <?php echo $a; ?> và <?php echo $b; ?> là: <?php echo $quotient; ?></p>
        </div>
        
        <div class="result">
            <h2>Kiểm tra số nguyên tố:</h2>
            <p><?php echo $a; ?> <?php echo $aIsPrime ? "là số nguyên tố." : "không phải là số nguyên tố."; ?></p>
            <p><?php echo $b; ?> <?php echo $bIsPrime ? "là số nguyên tố." : "không phải là số nguyên tố."; ?></p>
        </div>

        <div class="result">
            <h2>Kiểm tra số chẵn lẻ:</h2>
            <p><?php echo $a; ?> <?php echo $aIsEven ? "là số chẵn." : "là số lẻ."; ?></p>
            <p><?php echo $b; ?> <?php echo $bIsEven ? "là số chẵn." : "là số lẻ."; ?></p>
        </div>
    </div>
    <div class="return-home">
        <a href="../index/index.html" class="return"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
    </div>
</body>
</html>
