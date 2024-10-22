<?php
// libs/user.php
require_once 'database.php';

// Hàm lấy tất cả người dùng
function get_all_users() {
    connect_db();
    global $dbconn;
    try {
        $stmt = $dbconn->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        die("Lỗi lấy danh sách người dùng: " . $e->getMessage());
    }
}

// Hàm thêm người dùng mới
function add_user($username, $password, $role_name) {
    connect_db();
    global $dbconn;
    try {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $dbconn->prepare("INSERT INTO users (username, password, role_name) VALUES (:username, :password, :role_name)");
        $stmt->execute([
            'username' => $username,
            'password' => $hashed_password,
            'role_name' => $role_name
        ]);
    } catch (PDOException $e) {
        die("Lỗi thêm người dùng: " . $e->getMessage());
    }
}

// Hàm lấy thông tin người dùng theo ID
function get_user_by_id($id) {
    connect_db();
    global $dbconn;
    try {
        $stmt = $dbconn->prepare("SELECT user_id, username, role_name FROM users WHERE user_id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    } catch (PDOException $e) {
        die("Lỗi lấy thông tin người dùng: " . $e->getMessage());
    }
}

// Hàm cập nhật người dùng
function update_user($id, $username, $password, $role_name) {
    connect_db();
    global $dbconn;
    try {
        if ($password !== '') {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $dbconn->prepare("UPDATE users SET username = :username, password = :password, role_name = :role_name WHERE user_id = :id");
            $stmt->execute([
                'username' => $username,
                'password' => $hashed_password,
                'role_name' => $role_name,
                'id' => $id
            ]);
        } else {
            $stmt = $dbconn->prepare("UPDATE users SET username = :username, role_name = :role_name WHERE user_id = :id");
            $stmt->execute([
                'username' => $username,
                'role_name' => $role_name,
                'id' => $id
            ]);
        }
    } catch (PDOException $e) {
        die("Lỗi cập nhật người dùng: " . $e->getMessage());
    }
}

// Hàm xóa người dùng
function delete_user($id) {
    connect_db();
    global $dbconn;
    try {
        $stmt = $dbconn->prepare("DELETE FROM users WHERE user_id = :id");
        $stmt->execute(['id' => $id]);
    } catch (PDOException $e) {
        die("Lỗi xóa người dùng: " . $e->getMessage());
    }
}
?>
