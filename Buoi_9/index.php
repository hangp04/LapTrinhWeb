<?php
session_start();

function check_admin() {
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    if ($_SESSION['role_name'] !== 'admin') {
        echo "Bạn không có quyền truy cập vào trang này.";
        exit();
    }
}
check_admin();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ Thống Quản Lý Nhân Viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin-top: 50px;
        }
        h1 {
            color: #333;
        }
        .menu {
            margin-top: 20px;
        }
        .menu a {
            display: inline-block;
            padding: 15px 25px;
            margin: 10px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
        }
        .menu a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Hệ Thống Quản Lý Nhân Viên</h1>
    <h2>Xin chào <?php echo $_SESSION['username']; ?></h2>
    <div class="menu">
        <a href="user_list.php">Quản lý người dùng</a>
        <a href="employee_list.php">Quản Lý Nhân Viên</a>
        <a href="department_list.php">Quản Lý Phòng Ban</a>
        <a href="role_list.php">Quản Lý Chức Vụ</a>
        <a href="logout.php">Đăng xuất</a>
    </div>
</body>
</html>
