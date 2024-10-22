<?php 
// Biến kết nối toàn cục
global $dbconn;
 
// Hàm kết nối database
function connect_db()
{
    // Gọi tới biến toàn cục $dbconn
    global $dbconn;
     
    // Nếu chưa kết nối thì thực hiện kết nối
    if (!$dbconn){
        $dbconn = mysqli_connect("localhost:3307;dbname=qlsinhvien", "root", "", "qlsinhvien") or die ("Can't not connect to database");
        // Thiết lập font chữ kết nối
        mysqli_set_charset($dbconn, 'utf8');
    }
}
 
// Hàm ngắt kết nối
function disconnect_db()
{
    // Gọi tới biến toàn cục $dbconn
    global $dbconn;
     
    // Nếu đã kêt nối thì thực hiện ngắt kết nối
    if ($dbconn){
        mysqli_close($dbconn);
    }
}
 
// Hàm lấy tất cả sinh viên
function get_all_students()
{
    // Gọi tới biến toàn cục $dbconn
    global $dbconn;
     
    // Hàm kết nối
    connect_db();
     
    // Câu truy vấn lấy tất cả sinh viên
    $sql = "select * from sinhvien";
     
    // Thực hiện câu truy vấn
    $query = mysqli_query($dbconn, $sql);
     
    // Mảng chứa kết quả
    $result = array();
     
    // Lặp qua từng record và đưa vào biến kết quả
    if ($query){
        while ($row = mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
    }
     
    // Trả kết quả về
    return $result;
}
 
// Hàm lấy sinh viên theo ID
function get_student($student_id)
{
    // Gọi tới biến toàn cục $dbconn
    global $dbconn;
     
    // Hàm kết nối
    connect_db();
     
    // Câu truy vấn lấy tất cả sinh viên
    $sql = "select * from sinhvien where id = {$student_id}";
     
    // Thực hiện câu truy vấn
    $query = mysqli_query($dbconn, $sql);
     
    // Mảng chứa kết quả
    $result = array();
     
    // Nếu có kết quả thì đưa vào biến $result
    if (mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
        $result = $row;
    }
     
    // Trả kết quả về
    return $result;
}
 
// Hàm thêm sinh viên
function add_student($student_name, $student_sex, $student_birthday)
{
    // Gọi tới biến toàn cục $dbconn
    global $dbconn;
     
    // Hàm kết nối
    connect_db();
     
    // Chống SQL Injection
    $student_name = addslashes($student_name);
    $student_sex = addslashes($student_sex);
    $student_birthday = addslashes($student_birthday);
     
    // Câu truy vấn thêm
    $sql = "
            INSERT INTO sinhvien(hoten, gioitinh, ngaysinh) VALUES
            ('$student_name','$student_sex','$student_birthday')
    ";
     
    // Thực hiện câu truy vấn
    $query = mysqli_query($dbconn, $sql);
     
    return $query;
}
 
 
// Hàm sửa sinh viên
function edit_student($student_id, $student_name, $student_sex, $student_birthday)
{
    // Gọi tới biến toàn cục $dbconn
    global $dbconn;
     
    // Hàm kết nối
    connect_db();
     
    // Chống SQL Injection
    $student_name       = addslashes($student_name);
    $student_sex        = addslashes($student_sex);
    $student_birthday   = addslashes($student_birthday);
     
    // Câu truy sửa
    $sql = "
            UPDATE sinhvien SET
            hoten = '$student_name',
            gioitinh= '$student_sex',
            ngaysinh = '$student_birthday'
            WHERE id = $student_id
    ";
     
    // Thực hiện câu truy vấn
    $query = mysqli_query($dbconn, $sql);
     
    return $query;
}
 
 
// Hàm xóa sinh viên
function delete_student($student_id)
{
    // Gọi tới biến toàn cục $dbconn
    global $dbconn;
     
    // Hàm kết nối
    connect_db();
     
    // Câu truy sửa
    $sql = "
            DELETE FROM sinhvien
            WHERE id = $student_id
    ";
     
    // Thực hiện câu truy vấn
    $query = mysqli_query($dbconn, $sql);
     
    return $query;
}
