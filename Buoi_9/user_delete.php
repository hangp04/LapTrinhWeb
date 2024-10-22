<?php
require_once 'libs/user.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $user_id = intval($_POST['id']);

    // Kiểm tra xem người dùng có tồn tại và không phải chính mình
    connect_db();
    global $dbconn;
    try {
        $stmt = $dbconn->prepare("SELECT username FROM users WHERE user_id = :id");
        $stmt->execute(['id' => $user_id]);
        $user = $stmt->fetch();

        if ($user) {
            if ($user['username'] === $_SESSION['username']) {
                die("Bạn không thể xóa chính mình.");
            } else {
                delete_user($user_id);
                header("Location: user_list.php");
                exit();
            }
        } else {
            die("Người dùng không tồn tại.");
        }
    } catch (PDOException $e) {
        die("Lỗi kiểm tra người dùng: " . $e->getMessage());
    }
    disconnect_db();
} else {
    header("Location: user_list.php");
    exit();
}
?>
