<?php
require_once 'index.php';
check_admin();
require_once 'libs/user.php';

$users = get_all_users();
disconnect_db();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách người dùng</title>
    <style>
        .add-button {
            margin: 15px 0;
            padding: 10px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h1>Danh sách người dùng</h1>
    <a href="user_add.php" class="add-button">Thêm người dùng</a><br></br>
    <table width="100%" border="1" cellspacing="0" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Tên đăng nhập</th>
            <th>Mật khẩu</th>
            <th>Vai trò</th>
            <th>Thao tác</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo htmlspecialchars($user['user_id']); ?></td>
            <td><?php echo htmlspecialchars($user['username']); ?></td>
            <td><?php echo htmlspecialchars($user['password']); ?></td>
            <td><?php echo htmlspecialchars($user['role_name']); ?></td>
            <td class="action-buttons">
                <form method="post" action="user_delete.php" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $user['user_id']; ?>"/>
                    <input onclick="window.location = 'user_edit.php?id=<?php echo $user['user_id']; ?>'" type="button" value="Sửa"/>
                    <?php if ($user['username'] !== $_SESSION['username']): // Không cho phép xóa chính mình ?>
                        <input onclick="return confirm('Bạn có chắc muốn xóa không?');" type="submit" name="delete" value="Xóa"/>
                    <?php endif; ?>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
