<!-- <?php
require 'session_cookie.php';
?> -->
<?php
// require_once 'lib/lib_user.php';


$cus=true;
$lenpass=true;
$ktrp=true;

// function kiem_tra_dau_vao($username, $pass1, $pass2){
//     // thêm sau
//     return true;
// }

// if (isset($_POST['dk'])){
//     require_once 'lib/ketnoi.php';
//     $username=$_POST['username'];
//     $pass1=$_POST['pass1'];
//     $pass2=$_POST['pass2'];
//     $cus=check_username($username);
//     $lenpass=check_len_password($pass1);
//     $ktrp=false;
//     if ($pass1==$pass2){
//         $ktrp=true;
//     }
//     if ($cus && $lenpass && $ktrp){
//         if (kiem_tra_dau_vao($username, $pass1, $pass2)){
//             $password=md5($pass1);
//             if ($conn -> query("INSERT INTO user (username, password_hash) VALUES (N'$username',N'$password')" )){
//                 header("Location: login.php?page=" . urlencode("register"));
//                 exit();
//             }else{
//                 echo "có lỗi gì đó";
//                 exit();
//             }
//         }
//     }
// }
// $conn->close();
?>



<!DOCTYPE html>
<html lang="vi" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Thêm thông tin</title>
      <link rel="stylesheet" href="css/login_pass.css">
   </head>
   <body>
      <div class="wrapper">
         <div class="title">
            Thêm thông tin
         </div>
         <form method="POST" action="">
            <div class="field">
               <input id="hvt" name="hvt" type="text" required onchange="">
               <label>Họ và tên</label>
            </div>
            <div class="field">
               <input id="email" name="email" type="text" required onchange="">
               <label>Email</label>
            </div>
            <div class="field">
               <input id="sdt" name="sdt" type="text" required onchange="">
               <label>Số điện thoại</label>
            </div>
            <div class="field">
               <input id="nh" name="nh" type="text" required onchange="">
               <label>Ngân hàng</label>
            </div>
            <div class="field">
               <input id="stk" name="stk" type="text" required onchange="">
               <label>Số tài khoản</label>
            </div>
            
            <div id="divbtdk" class="field">
               <input id="btdk" type="submit" name="dk" value="OK">
            </div>
         </form>
      </div>
   </body>
   <script src="js/main.js"></script>
</html>

