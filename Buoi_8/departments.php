<?php
require_once 'libs/database.php';
global $dbconn;
// CRUD for Departments
function get_all_department()
{
	 global $dbconn;
   // Hàm kết nối
    connect_db();
  
    try{
    	//khai báo exception
    	$dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // Sử dụng Prepare 
    $stmt = $dbconn->prepare("SELECT * FROM Departments"); 
     
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

function get_department($department_id)
{
    // Gọi tới biến toàn cục $dbconn
    global $dbconn;
     
    // Hàm kết nối
    connect_db();
    // Câu truy vấn lấy tất cả sinh viên
    $stmt = $dbconn->prepare("select * from departments where department_id = {$department_id}");
    // Thực thi câu truy vấn
    $stmt->execute();
    // Khai báo fetch kiểu mảng kết hợp
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();
     return $result;
    
}
//hàm lấy departmentid khi biết department name
function get_departmentid($department_name)
{
    // Gọi tới biến toàn cục $dbconn
    global $dbconn;
     
    // Hàm kết nối
    connect_db();
    // Câu truy vấn lấy thông tin departments
    $stmt = $dbconn->prepare("select * from departments where department_name = '{$department_name}'");
    // Thực thi câu truy vấn
    $stmt->execute();
    // Khai báo fetch kiểu mảng kết hợp
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();
    //var_dump($result);
      return $result;
    
    
}
function add_department($department_name) {
    global $dbconn;
    connect_db();
    
    try {
        $stmt = $dbconn->prepare("INSERT INTO Departments (department_name) VALUES (:name)");
        $stmt->bindParam(':name', $department_name);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Hàm sửa nhân viên
function edit_department($department_id, $department_name)
{
    // Gọi tới biến toàn cục $dbconn
    global $dbconn;
     
    // Hàm kết nối
    connect_db();

    try {
        // Sử dụng PDO exception để bắt lỗi
        $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Câu truy vấn sửa, sử dụng bindParam để tránh lỗi cú pháp và bảo mật
        $sql = "UPDATE departments SET department_name = :department_name WHERE department_id = :department_id";
        
        // Prepare statement
        $stmt = $dbconn->prepare($sql);
        
        // Bind các tham số với giá trị tương ứng
        $stmt->bindParam(':department_name', $department_name);
        $stmt->bindParam(':department_id', $department_id);
        
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
function delete_department($department_id)
{
    // Gọi tới biến toàn cục $dbconn
    global $dbconn;
     
    // Hàm kết nối
    connect_db();
    try{
     	 $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Câu SQL xóa
    $sql = " DELETE FROM departments WHERE department_id = $department_id ";
     
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
