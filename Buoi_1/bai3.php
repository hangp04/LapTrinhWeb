<?php
function cong ($a, $b){
    return $a + $b;
}

function tru ($a, $b){
    return $a - $b;
}

function nhan ($a, $b){
    return $a * $b;
}

function chia($a, $b){
    return ($b == 0) ? "Không thể chia cho 0" : ($a / $b);
}

function ktraSoNTo ($a) {
    if ($a < 2) {
        return false;
    } else {
        for ($i = 2; $i <= sqrt($a); $i++) {
            if ($a % $i == 0) return false;
        }
    }
    return true;
}

function ktraChanLe ($a){
    if ($a % 2 == 0) return true;
}

// Khởi tạo biến
$tong = $hieu = $tich = $thuong = '';
$aSoNTo = $bSoNTo = $aSoChan = $bSoChan = false;
$checkType = $numberToCheck = '';

// Xử lý phần tính toán
if (isset($_POST['operation'])) {
    $a = isset($_POST['a']) ? (int)$_POST['a'] : 0;
    $b = isset($_POST['b']) ? (int)$_POST['b'] : 0;
    $operation = isset($_POST['operation']) ? $_POST['operation'] : '';

    if ($operation == 'cong') {
        $tong = cong($a, $b);
    } elseif ($operation == 'tru') {
        $hieu = tru($a, $b);
    } elseif ($operation == 'nhan') {
        $tich = nhan($a, $b);
    } elseif ($operation == 'chia') {
        $thuong = chia($a, $b);
    }
}

// Xử lý phần kiểm tra số
if (isset($_POST['check'])) {
    $numberToCheck = isset($_POST['number_to_check']) ? (int)$_POST['number_to_check'] : 0;
    $checkType = isset($_POST['check_type']) ? $_POST['check_type'] : '';

    if ($checkType == 'Chan_Le') {
        $aSoChan = ktraChanLe($numberToCheck);
    } elseif ($checkType == 'soNTo') {
        $aSoNTo = ktraSoNTo($numberToCheck);
    }
}
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
        <!-- Phần tính toán -->
        <form method="POST" action="">
            <h2>Phép toán</h2>
            <label for="a">Số thứ nhất:</label>
            <input type="number" id="a" name="a" value="<?php echo isset($a) ? $a : ''; ?>" required>
            <label for="b">Số thứ hai:</label>
            <input type="number" id="b" name="b" value="<?php echo isset($b) ? $b : ''; ?>" required>
            
            <fieldset>
                <legend>Chọn phép toán:</legend>
                <input type="radio" id="cong" name="operation" value="cong" <?php echo isset($_POST['operation']) && $_POST['operation'] == 'cong' ? 'checked' : ''; ?>>
                <label for="cong">Cộng</label><br>
                <input type="radio" id="tru" name="operation" value="tru" <?php echo isset($_POST['operation']) && $_POST['operation'] == 'tru' ? 'checked' : ''; ?>>
                <label for="tru">Trừ</label><br>
                <input type="radio" id="nhan" name="operation" value="nhan" <?php echo isset($_POST['operation']) && $_POST['operation'] == 'nhan' ? 'checked' : ''; ?>>
                <label for="nhan">Nhân</label><br>
                <input type="radio" id="chia" name="operation" value="chia" <?php echo isset($_POST['operation']) && $_POST['operation'] == 'chia' ? 'checked' : ''; ?>>
                <label for="chia">Chia</label>
            </fieldset>
            
            <button type="submit">Tính toán</button>
        </form>
        
        <div class="result">
            <p>Kết quả tính toán:</p>
            <?php if ($tong !== ''): ?>
                <p>Tổng của <?php echo $a; ?> và <?php echo $b; ?> là: <?php echo $tong; ?></p>
            <?php endif; ?>
            <?php if ($hieu !== ''): ?>
                <p>Hiệu của <?php echo $a; ?> và <?php echo $b; ?> là: <?php echo $hieu; ?></p>
            <?php endif; ?>
            <?php if ($tich !== ''): ?>
                <p>Tích của <?php echo $a; ?> và <?php echo $b; ?> là: <?php echo $tich; ?></p>
            <?php endif; ?>
            <?php if ($thuong !== ''): ?>
                <p>Thương của <?php echo $a; ?> và <?php echo $b; ?> là: <?php echo $thuong; ?></p>
            <?php endif; ?>
        </div>
        
        <!-- Phần kiểm tra số -->
        <form method="POST" action="">
            <h2>Kiểm tra số</h2>
            <label for="number_to_check">Nhập số để kiểm tra:</label>
            <input type="number" id="number_to_check" name="number_to_check" value="<?php echo isset($numberToCheck) ? $numberToCheck : ''; ?>" required>
            
            <fieldset>
                <legend>Chọn loại kiểm tra:</legend>
                <input type="radio" id="check_Chan_Le" name="check_type" value="Chan_Le" <?php echo isset($_POST['check_type']) && $_POST['check_type'] == 'Chan_Le' ? 'checked' : ''; ?>>
                <label for="check_Chan_Le">Kiểm tra số chẵn lẻ</label><br>
                <input type="radio" id="check_NTo" name="check_type" value="NTo" <?php echo isset($_POST['check_type']) && $_POST['check_type'] == 'soNTo' ? 'checked' : ''; ?>>
                <label for="check_NTo">Kiểm tra số nguyên tố</label>
            </fieldset>

            <button type="submit" name="check">Kiểm tra</button>
        </form>

        <div class="result">
            <p>Kết quả kiểm tra số:</p>
            <?php if (isset($_POST['check'])): ?>
                <?php if ($checkType == 'Chan_Le'): ?>
                    <p><?php echo $numberToCheck; ?> <?php echo ktraChanLe($numberToCheck) ? "là số chẵn." : "là số lẻ."; ?></p>
                <?php elseif ($checkType == 'soNTo'): ?>
                    <p><?php echo $numberToCheck; ?> <?php echo ktraSoNTo($numberToCheck) ? "là số nguyên tố." : "không phải là số nguyên tố."; ?></p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="return-home">
        <a href="../index/index.html" class="return"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
    </div>
</body>
</html>
