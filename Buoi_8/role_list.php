<?php

 require_once 'libs/employeeroles.php';
$role = get_all_role();
disconnect_db();
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>Danh sách chức vụ</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Danh sách chức vụ</h1>
        <a href="role_add.php">Thêm chức vụ</a> <br/> <br/>
        <table width="100%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td><b>Role name</b></td>
                <td>Chọn thao tác</td>
            </tr>
            <?php foreach ($role as $item){ ?>
            <tr>
                <td><?php echo $item['role_name']; ?></td>
                <td>
                    <form method="post" action="role_delete.php">
                        <input onclick="window.location = 'role_edit.php?id=<?php echo $item['role_id']; ?>'" type="button" value="Sửa"/>
                        <input type="hidden" name="id" value="<?php echo $item['role_id']; ?>"/>
                        <input onclick="return confirm('Bạn có chắc muốn xóa không?');" type="submit" name="delete" value="Xóa"/>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>