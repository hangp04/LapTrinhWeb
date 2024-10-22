<?php
 require_once 'libs/employeeroles.php';
//gọi hàm để lấy thông tin phòng ban, chức vụ
$role=get_all_role();
 
// Nếu người dùng submit form
if (!empty($_POST['add_role']))
{
    // Lay data
    $data['role_name']        = isset($_POST['role_name']) ? $_POST['role_name'] : '';
     
    // Validate thong tin
    $errors = array();
    if (empty($data['role_name'])){
        $errors['role_name'] = 'Chưa nhập tên bộ phận';
    }
    
    // Neu ko co loi thi insert
    if (!$errors){
        add_role($data['role_name'],$x);
        
        // Trở về trang danh sách
        header("location: role_list.php");
   }
}
 disconnect_db();
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>Thêm chức vụ</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Thêm chức vụ </h1>
        <a href="role_list.php">Trở về</a> <br/> <br/>
        <form method="post" action="role_add.php">
            <table width="50%" border="1" cellspacing="0" cellpadding="10">
                <tr>
                    <td>role name</td>
                    <td>
                        <input type="text" name="role_name" value="<?php echo !empty($data['role_name']) ? $data['role_name'] : ''; ?>"/>
                        <?php if (!empty($errors['role_name'])) echo $errors['role_name']; ?>
                    </td>
                </tr>
                
                    <td></td>
                    <td>
                        <input type="submit" name="add_role" value="Lưu"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>