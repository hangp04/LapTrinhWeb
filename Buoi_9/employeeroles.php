<?php 
require_once 'libs/database.php';

function get_role($role_id)
{
    // Gọi tới biến toàn cục $dbconn
    global $dbconn;
     
    // Hàm kết nối
    connect_db();
    // Câu truy vấn lấy thông tin role
    $stmt = $dbconn->prepare("select * from employeeroles where role_id = {$role_id}");
    // Thực thi câu truy vấn
    $stmt->execute();
    // Khai báo fetch kiểu mảng kết hợp
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();
     return $result;
    
}
//hàm lấy roleid khi biết role name
function get_roleid($role_name)
{
    // Gọi tới biến toàn cục $dbconn
    global $dbconn;
     
    // Hàm kết nối
    connect_db();
    // Câu truy vấn lấy thông tin chức vụ 
    $stmt = $dbconn->prepare("select * from employeeroles where role_name = '{$role_name}'");
    // Thực thi câu truy vấn
    $stmt->execute();
    // Khai báo fetch kiểu mảng kết hợp
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();
    return $result;
 }
function get_all_role()
{
	 global $dbconn;
   // Hàm kết nối
    connect_db();
  
    try{
    	//khai báo exception
    	$dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // Sử dụng Prepare 
    $stmt = $dbconn->prepare("SELECT * FROM Employeeroles"); 
     
    // Thực thi câu truy vấn
    $stmt->execute();
    // Khai báo fetch kiểu mảng kết hợp
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();
   return $result;
 }
 catch(PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}
}

function add_role($role_name) {
    global $dbconn;
    connect_db();
    
    try {
        $stmt = $dbconn->prepare("INSERT INTO employeeroles (role_name) VALUES (:name)");
        $stmt->bindParam(':name', $role_name);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function edit_role($role_id, $role_name)
{
    // Gọi tới biến toàn cục $dbconn
    global $dbconn;
     
    // Hàm kết nối
    connect_db();

    try {
        // Sử dụng PDO exception để bắt lỗi
        $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Câu truy vấn sửa, sử dụng bindParam để tránh lỗi cú pháp và bảo mật
        $sql = "UPDATE employeeroles SET role_name = :role_name WHERE role_id = :role_id";
        
        // Prepare statement
        $stmt = $dbconn->prepare($sql);
        
        // Bind các tham số với giá trị tương ứng
        $stmt->bindParam(':role_name', $role_name);
        $stmt->bindParam(':role_id', $role_id);
        
        // Thực thi câu truy vấn
        $stmt->execute();
        
        // Kiểm tra và thông báo số bản ghi đã được cập nhật
        echo $stmt->rowCount() . " record(s) updated successfully";
    } catch (PDOException $e) {
        // Nếu có lỗi, in ra thông báo lỗi
        echo "Error: " . $e->getMessage();
    }
}

 
// Hàm xóa nhân viên
function delete_role($role_id)
{
    // Gọi tới biến toàn cục $dbconn
    global $dbconn;
     
    // Hàm kết nối
    connect_db();
    try{
     	 $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Câu SQL xóa
    $sql = " DELETE FROM employeeroles WHERE role_id = $role_id ";
     
    // Prepare statement
  $stmt = $dbconn->prepare($sql);

  // execute the query
  $stmt->execute();
}
  catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}
}
?>