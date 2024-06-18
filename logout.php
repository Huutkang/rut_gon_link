<?php
session_start();
if (isset($_SESSION['id'])){
    unset($_SESSION['id']);
}

require_once 'lib/ketnoi.php';

$cookie_name = "id";
if (isset($_COOKIE[$cookie_name])){
    // Sử dụng Prepared Statement để tránh SQL Injection
    $stmt = $conn->prepare("DELETE FROM cookie WHERE cookie = ?");
    $stmt->bind_param("s", $_COOKIE[$cookie_name]);
    $stmt->execute();

    // Kiểm tra và hiển thị kết quả
    if ($stmt->affected_rows > 0) {
        echo "Xóa thành công";
    } else {
        echo "Không có bản ghi nào được xóa hoặc có lỗi xảy ra.";
    }

    // Đóng Prepared Statement
    $stmt->close();

}

$cookie_value = "0";
setcookie($cookie_name, $cookie_value, time()-3600,"/");

header("Location: login");
exit();
?>