<?php
require_once 'libs/database.php';
global $dbconn;
// Hàm lấy tất cả nhân viên
function get_all_employees()
{
	 global $dbconn;
   // Hàm kết nối
    connect_db();
  
    try{
    	//khai báo exception
    	$dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // Sử dụng Prepare 
    $stmt = $dbconn->prepare("SELECT departments.department_id,
      employeeroles.role_id, employees.employee_id, employees.first_name, employees.last_name, 
      departments.department_name, employeeroles.role_name 
      FROM employees 
      JOIN departments ON employees.department_id = departments.department_id 
      JOIN employeeroles ON employees.role_id = employeeroles.role_id"); 
     
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

 
// Hàm lấy nhân viên theo ID
  function get_employees($employee_id)
  {
      // Gọi tới biến toàn cục $dbconn
      global $dbconn;
      
      // Hàm kết nối
      connect_db();
      // Câu truy vấn lấy tất cả nhân viên
      $stmt = $dbconn->prepare("select * from employees where employee_id = {$employee_id}");
      // Thực thi câu truy vấn
      $stmt->execute();
      // Khai báo fetch kiểu mảng kết hợp
      $stmt->setFetchMode(PDO::FETCH_ASSOC); 
      // Lấy danh sách kết quả
      $result = $stmt->fetchAll();
      return $result;
      // var_dump($result);
      
  }
 
// Hàm thêm nhân viên
function add_employee($employee_firstname, $employee_lastname,$employee_dep, $employee_role)
{
    // Gọi tới biến toàn cục $dbconn
   global $dbconn;
     
    // Hàm kết nối
    connect_db();
     
    // Chống SQL Injection
   // $employee_firstname= addslashes($employee_firstname);
    //$employee_lastname=nameaddslashes($employee_lastname);
    //$employee_role=addslashes($employee_role);
    //$employee_dep=addslashes($employee_dep);
     try{
     	//khai báo exception
     $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
    // Câu truy vấn thêm
    $sql = " INSERT INTO employees (first_name,last_name,department_id,role_id) VALUES
            ('$employee_firstname', '$employee_lastname',$employee_dep,$employee_role)";
     
    // Thực hiện câu truy vấn
     $dbconn->exec($sql);
     echo "Thêm dữ liệu thành công";
}
catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}
}
 
// Hàm sửa nhân viên
function edit_employee($employee_id,$employee_firstname, $employee_lastname, $employee_dep,$employee_role)
{
    // Gọi tới biến toàn cục $dbconn
    global $dbconn;
     
    // Hàm kết nối
    connect_db();
     
    // Chống SQL Injection
    // $employee_firstname= addslashes($employee_firstname);
    //$employee_lastname=nameaddslashes($employee_lastname);
    //$employee_role=addslashes($employee_role);
    //$employee_dep=addslashes($employee_dep);
     try{
     	 $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Câu truy vấn sửa
    $sql = "
            UPDATE employees SET
            first_name = '$employee_firstname',
            last_name= '$employee_lastname',
            department_id = $employee_dep,
            role_id=$employee_role
            WHERE employee_id = $employee_id";
     
    // Prepare statement
  $stmt = $dbconn->prepare($sql);

  // execute the query
  $stmt->execute();
  // echo a message to say the UPDATE succeeded
  echo $stmt->rowCount() . " records UPDATED successfully";

}
  catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}
}
 
// Hàm xóa nhân viên
function delete_employee($employee_id)
{
    // Gọi tới biến toàn cục $dbconn
    global $dbconn;
     
    // Hàm kết nối
    connect_db();
    try{
     	 $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Câu SQL xóa
    $sql = " DELETE FROM employees WHERE employee_id = $employee_id ";
     
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