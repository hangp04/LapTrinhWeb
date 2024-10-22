<?php
require_once 'libs/employeeroles.php';

// Lấy thông tin hiển thị lên để người dùng sửa
$id = isset($_GET['id']) ? (int)$_GET['id'] : '';
if ($id) {
    $data = get_role($id);

    if ($data) {
        foreach ($data as $row) {
            $emid = $row['role_id'];
            $emrole_name = $row['role_name'];
        }
    } else {
        // Nếu không có dữ liệu tức không tìm thấy chức vụ cần sửa
        header("location: role_list.php");
    }
}

// Nếu người dùng submit form
if (!empty($_POST['edit_role'])) {
    // Lấy dữ liệu từ form
    $data['role_name'] = isset($_POST['role_name']) ? $_POST['role_name'] : '';
    $data['role_id'] = isset($_POST['id']) ? $_POST['id'] : '';

    // Validate thông tin
    $errors = array();
    if (empty($data['role_name'])) {
        $errors['role_name'] = 'Tên chức vụ không được để trống';
    }

    // Nếu không có lỗi thì cập nhật
    if (!$errors) {
        edit_role($data['role_id'], $data['role_name']);

        // Trở về trang danh sách
        header("location: role_list.php");
    }
}

disconnect_db();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin chức vụ</title>
</head>
<body>
    <h1>Sửa thông tin chức vụ</h1>
    <a href="role_list.php">Trở về</a> <br/><br/>
    <form method="post" action="role_edit.php?id=<?php echo $emid; ?>">
        <table width="50%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td>Tên chức vụ</td>
                <td>
                    <input type="text" name="role_name" value="<?php echo $emrole_name; ?>"/>
                    <?php if (!empty($errors['role_name'])) echo $errors['role_name']; ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="hidden" name="id" value="<?php echo $emid; ?>"/>
                    <input type="submit" name="edit_role" value="Lưu"/>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
