<?php
 require_once 'libs/departments.php';
//gọi hàm để lấy thông tin phòng ban, chức vụ
$department=get_all_department();
 
// Nếu người dùng submit form
if (!empty($_POST['add_department']))
{
    // Lay data
    $data['department_name']        = isset($_POST['department_name']) ? $_POST['department_name'] : '';
     
    // Validate thong tin
    $errors = array();
    if (empty($data['department_name'])){
        $errors['department_name'] = 'Chưa nhập tên phòng ban';
    }
    
    // Neu ko co loi thi insert
    if (!$errors){
        add_department($data['department_name'],$x);
        
        // Trở về trang danh sách
        header("location: department_list.php");
   }
}
 disconnect_db();
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>Thêm phòng ban</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Thêm phòng ban </h1>
        <a href="department_list.php">Trở về</a> <br/> <br/>
        <form method="post" action="department_add.php">
            <table width="50%" border="1" cellspacing="0" cellpadding="10">
                <tr>
                    <td>Department name</td>
                    <td>
                        <input type="text" name="department_name" value="<?php echo !empty($data['department_name']) ? $data['department_name'] : ''; ?>"/>
                        <?php if (!empty($errors['department_name'])) echo $errors['department_name']; ?>
                    </td>
                </tr>
                
                    <td></td>
                    <td>
                        <input type="submit" name="add_department" value="Lưu"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>