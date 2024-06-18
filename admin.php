<?php
require_once 'session_cookie.php';
require_once 'lib/lib_user.php';

if ($tologin){
    header("Location: login");
    exit();
}

$admin=admin($_SESSION['id']);
if ($admin!="1"){
    header("Location: user");
    exit();
}
?>

<h1>Đây là trang admin</h1>

<?php

echo "<h1> Chào mừng id: ";
echo $_SESSION['id'];
echo "</h1>";
echo "<h1>tính năng đang phát triển. bạn nên truy cập vào cPanel để chỉnh sửa trực tiếp trong bảng cơ sở dữ liệu.</h1>";
echo "<h2>tài khoản cPanel là: nguyen88</h2>";
echo "<h2>mật khẩu là: hỏi admin</h2>";
echo '<a href="https://host126.vietnix.vn/cpanel">link truy cập cPanel</a>';
echo "<h3>nếu muốn đặt lại mật khẩu cho ai đó. mật khẩu mặc định là: linkvn cột password_hash đặt thành: d8c7e51aa626a53e88a0ca302c2a4f66</h3>";
echo "<h3>đây chỉ là hình thức tạm thời. sau code lại</h3>";

?>
