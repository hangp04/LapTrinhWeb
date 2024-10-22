<?php 
// Biến kết nối cơ sở dữ liệu
global $dbconn;

// Hàm kết nối database
function connect_db()
{
    global $dbconn;
    
    // Kiểm tra nếu biến $dbconn chưa được khởi tạo hoặc là null
    if (!$dbconn) {
        try {
            $dbconn = new PDO("mysql:host=localhost:3307;dbname=employee_db", "root", "");
            $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbconn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $dbconn->exec("SET NAMES 'utf8'");
        } catch (PDOException $e) {
            die("Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage());
        }
    }
}


// Hàm ngắt kết nối
function disconnect_db()
{
    global $dbconn;
    
    // Gán null để ngắt kết nối
    if ($dbconn !== null) {
        $dbconn = null;
    }
}
?>