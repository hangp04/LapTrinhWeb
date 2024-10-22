<?php

require_once 'libs/user.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role_name = $_POST['role_name'];

    if ($username === '' || $password === '' || $role_name === '') {
        $error = "Vui lòng nhập đầy đủ thông tin.";
    } else {
        // Kiểm tra xem tên đăng nhập đã tồn tại chưa
        connect_db();
        global $dbconn;
        try {
            $stmt = $dbconn->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
            $stmt->execute(['username' => $username]);
            if ($stmt->fetchColumn() > 0) {
                $error = "Tên đăng nhập đã tồn tại.";
            } else {
                add_user($username, $password, $role_name);
                $success = "Thêm người dùng thành công.";
            }
        } catch (PDOException $e) {
            die("Lỗi kiểm tra người dùng: " . $e->getMessage());
        }
        disconnect_db();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm người dùng</title>
</head>
<body>
<div class="form-container">
    <h2>Thêm người dùng</h2>
    <a href="user_list.php">Quay lại</a><br></br>
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div><br>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="success"><?php echo htmlspecialchars($success); ?></div><br>
        <?php endif; ?>
        <form method="post" action="user_add.php">
            <table width="50%" border="1" cellspacing="0" cellpadding="10">
                <tr>
                    <th>Tên đăng nhập:</th>
                    <td>
                        <input type="text" name="username" value="<?php echo htmlspecialchars(isset($data['username']) ? $data['username'] : ''); ?>" required/>
                        <?php if (!empty($errors['username'])): ?>
                            <div class="error"><?php echo htmlspecialchars($errors['username']); ?></div>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Mật khẩu:</th>
                    <td>
                        <input type="password" name="password" required/>
                        <?php if (!empty($errors['password'])): ?>
                            <div class="error"><?php echo htmlspecialchars($errors['password']); ?></div>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Vai trò:</th>
                    <td>
                        <select name="role_name" required>
                            <option value="">-- Chọn vai trò --</option>
                            <option value="admin" <?php echo (isset($data['role_name']) && $data['role_name'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
                            <option value="user" <?php echo (isset($data['role_name']) && $data['role_name'] === 'user') ? 'selected' : ''; ?>>User</option>
                        </select>
                        <?php if (!empty($errors['role_name'])): ?>
                            <div class="error"><?php echo htmlspecialchars($errors['role_name']); ?></div>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="submit" value="Thêm" class="submit-button"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
