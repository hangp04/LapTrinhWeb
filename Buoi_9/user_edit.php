<?php
require_once 'libs/user.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID người dùng không hợp lệ.");
}

$user_id = intval($_GET['id']);
$user = get_user_by_id($user_id);

if (!$user) {
    die("Người dùng không tồn tại.");
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role_name = $_POST['role_name'];

    if ($username === '' || $role_name === '') {
        $error = "Vui lòng nhập đầy đủ thông tin.";
    } else {
        // Kiểm tra tên đăng nhập đã tồn tại chưa (ngoại trừ người dùng hiện tại)
        connect_db();
        global $dbconn;
        try {
            $stmt = $dbconn->prepare("SELECT COUNT(*) FROM users WHERE username = :username AND user_id != :id");
            $stmt->execute(['username' => $username, 'id' => $user_id]);
            if ($stmt->fetchColumn() > 0) {
                $error = "Tên đăng nhập đã tồn tại.";
            } else {
                update_user($user_id, $username, $password, $role_name);
                $success = "Cập nhật người dùng thành công.";
                // Cập nhật lại thông tin người dùng sau khi cập nhật
                $user = get_user_by_id($user_id);
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
    <title>Sửa người dùng</title>
</head>
<body>
    <div class="form-container">
        <h2>Sửa người dùng</h2>
        <a href="user_list.php">Quay lại</a><br></br>
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div><br>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="success"><?php echo htmlspecialchars($success); ?></div><br>
        <?php endif; ?>
        <form method="post" action="user_edit.php?id=<?php echo $user_id; ?>">
        <table width="50%" border="1" cellspacing="0" cellpadding="10">
                <tr>
                    <th>Tên đăng nhập:</th>
                    <td>
                        <input type="text" name="username" value="<?php echo htmlspecialchars(isset($data['username']) ? $data['username'] : $user['username']); ?>" required/>
                        <?php if (!empty($errors['username'])): ?>
                            <div class="error"><?php echo htmlspecialchars($errors['username']); ?></div>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Mật khẩu (để trống nếu không thay đổi):</th>
                    <td>
                        <input type="password" name="password"/>
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
                            <option value="admin" <?php echo (isset($data['role_name']) && $data['role_name'] === 'admin') ? 'selected' : (($user['role_name'] === 'admin') ? 'selected' : ''); ?>>Admin</option>
                            <option value="user" <?php echo (isset($data['role_name']) && $data['role_name'] === 'user') ? 'selected' : (($user['role_name'] === 'user') ? 'selected' : ''); ?>>User</option>
                        </select>
                        <?php if (!empty($errors['role_name'])): ?>
                            <div class="error"><?php echo htmlspecialchars($errors['role_name']); ?></div>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="submit" value="Cập nhật" class="submit-button"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
