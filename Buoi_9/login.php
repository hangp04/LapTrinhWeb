<?php
// login.php
session_start();
require_once 'libs/database.php'; // Tệp chứa hàm connect_db và disconnect_db

// Kiểm tra nếu người dùng đã đăng nhập, chuyển hướng đến index.php
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    connect_db();

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username === '' || $password === '') {
        $error = "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu.";
    } else {
        try {
            global $dbconn;
            $stmt = $dbconn->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                // Đăng nhập thành công
                $_SESSION['username'] = $user['username'];
                $_SESSION['role_name'] = $user['role_name'];
                header("Location: index.php");
                exit();
            } else {
                $error = "Tên đăng nhập hoặc mật khẩu không chính xác.";
            }
        } catch (PDOException $e) {
            die("Lỗi truy vấn: " . $e->getMessage());
        }
    }

    disconnect_db();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Nhập</title>
    <style>
        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="login-form">
        <h2>Đăng Nhập</h2>
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="post" action="login.php">
            <label for="username">Tên đăng nhập:</label><p>admin</p>
            <input type="text" id="username" name="username" required/><br/>
            <label for="password">Mật khẩu:</label><p>admin</p>
            <input type="password" id="password" name="password" required/><br/>
            <input type="submit" value="Đăng nhập"/>
        </form>
    </div>
</body>
</html>
