<?php
require_once 'libs/departments.php';

// Lấy thông tin hiển thị lên để người dùng sửa
$id = isset($_GET['id']) ? (int)$_GET['id'] : '';
if ($id) {
    $data = get_department($id);

    if ($data) {
        foreach ($data as $row) {
            $emid = $row['department_id'];
            $emdepartment_name = $row['department_name'];
        }
    } else {
        // Nếu không có dữ liệu tức không tìm thấy phòng ban cần sửa
        header("location: department_list.php");
    }
}

// Nếu người dùng submit form
if (!empty($_POST['edit_department'])) {
    // Lấy dữ liệu từ form
    $data['department_name'] = isset($_POST['department_name']) ? $_POST['department_name'] : '';
    $data['department_id'] = isset($_POST['id']) ? $_POST['id'] : '';

    // Validate thông tin
    $errors = array();
    if (empty($data['department_name'])) {
        $errors['department_name'] = 'Tên phòng ban không được để trống';
    }

    // Nếu không có lỗi thì cập nhật
    if (!$errors) {
        edit_department($data['department_id'], $data['department_name']);

        // Trở về trang danh sách
        header("location: department_list.php");
    }
}

disconnect_db();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin phòng ban</title>
</head>
<body>
    <h1>Sửa thông tin phòng ban</h1>
    <a href="department_list.php">Trở về</a> <br/><br/>
    <form method="post" action="department_edit.php?id=<?php echo $emid; ?>">
        <table width="50%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td>Tên phòng ban</td>
                <td>
                    <input type="text" name="department_name" value="<?php echo $emdepartment_name; ?>"/>
                    <?php if (!empty($errors['department_name'])) echo $errors['department_name']; ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="hidden" name="id" value="<?php echo $emid; ?>"/>
                    <input type="submit" name="edit_department" value="Lưu"/>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
