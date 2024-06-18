<?php
require 'session_cookie.php';
?>
<?php
require_once 'lib/lib_user.php';
if ($tologin == false){
    echo '<h1>Bạn cần đăng xuất trước khi tạo tài khoản mới</h1>';
    exit();
}

// cấp cookie cho mỗi máy truy cập. coi như là id ẩn danh. cả trên bảng khách hàng
// mỗi cookie chỉ được tạo tối đa 1 tài khoản trong 10 phút.
// mỗi địa chỉ ip chỉ được tạo 10 tài khoản trong 1 ngày



$cus=true;
$lenpass=true;
$ktrp=true;

function kiem_tra_dau_vao($username, $pass1, $pass2){
    // thêm sau
    return true;
}

if (isset($_POST['dk'])){
    require_once 'lib/ketnoi.php';
    $username=$_POST['username'];
    $pass1=$_POST['pass1'];
    $pass2=$_POST['pass2'];
    $cus=check_username($username);
    $lenpass=check_len_password($pass1);
    $ktrp=false;
    if ($pass1==$pass2){
        $ktrp=true;
    }
    if ($cus && $lenpass && $ktrp){
        if (kiem_tra_dau_vao($username, $pass1, $pass2)){
            $password=md5($pass1);
            if ($conn -> query("INSERT INTO user (username, password_hash) VALUES (N'$username',N'$password')" )){
                header("Location: login?page=" . urlencode("register"));
                exit();
            }else{
                echo "có lỗi gì đó";
                exit();
            }
        }
    }
}
$conn->close();
?>



<!DOCTYPE html>
<html lang="vi" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Đăng Ký</title>
      <link rel="stylesheet" href="css/login_pass.css">
   </head>
   <body>
      <div class="wrapper">
         <div class="title">
            Trang Đăng Ký
         </div>
         <form method="POST" action="">
            <div class="field">
               <input id="usn" name="username" type="text" required onchange="check_ip()">
               <label>Tên Đăng Nhập</label>
            </div>
            <div class="field">
               <input id="pas1" name="pass1" type="password" required onchange="cpw()">
               <label>Mật Khẩu</label>
            </div>
            <div class="field">
               <input id="pas2" name="pass2" type="password" required onchange="cpw()">
               <label>Nhập Lại Mật Khẩu</label>
            </div>
            <div id="tb1">
                <?php
                if ($cus==false){
                    echo '<p style="color: red;" class="content">Username đã tồn tại</p>';
                }
                ?>
            </div>
            <div id="tb3">
            <?php
            if ($lenpass==false){
                echo '<p style="color: red;" class="content">Độ dài mật khẩu từ 6 đến 16 kí tự</p>';
            }
            ?>
            </div>
            <div id="tb2">
            <?php
            if ($ktrp==false){
                echo '<p style="color: red;" class="content">Mật khẩu không khớp</p>';
            }
            ?>
            </div>
            <div id="divbtdk" style="display: none;" class="field">
               <input id="btdk" type="submit" name="dk" value="Đăng Ký">
            </div>
         </form>
      </div>
   </body>
   <script src="js/main.js"></script>
</html>

