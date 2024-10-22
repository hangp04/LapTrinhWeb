<?php 
 require_once 'libs/departments.php';
// Thực hiện xóa
$id = isset($_POST['id']) ? (int)$_POST['id'] : '';
if ($id){
    delete_department($id);
}
 
// Trở về trang danh sách
header("location: department_list.php");
?>
