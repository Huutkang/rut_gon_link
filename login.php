<?php
require 'session_cookie.php';
?>
<?php
require_once 'lib/lib_user.php';
if ($tologin == false){
    echo '<h1>Bạn cần đăng xuất trước khi đăng nhập lại</h1>';
    exit();
}

$page = isset($_GET['page']) ? $_GET['page'] : 'false';
$ktmk=true;

if (isset($_POST['ck'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $password = md5($password);
    $user=[];
    $result = $conn->query("SELECT * FROM user");
    if ($result->num_rows > 0) {
        // Hiển thị dữ liệu
        while ($row = $result->fetch_assoc()) {
            $m=[];
            $m[]=(int)$row['id'];
            $m[]=$row['username'];
            $m[]=$row['password_hash'];
            $user[]=$m;
        }
    } else {
        echo "<p>không có người dùng</p>";
        exit();
    }
    foreach($user as $i){
        if ($i[1]==$username && $i[2]==$password){
            $cookie_name = "id";
            $cookie_value = generateRandomString(30);
            setcookie($cookie_name, $cookie_value, time()+86400*30,"/");
            if ($conn){
                if ($conn -> query("INSERT INTO cookie (cookie, id_username) VALUES (N'$cookie_value',N'$i[0]')" )){
                    echo "<h3>đã gửi thành công. cảm ơn bạn nhé</h3>";
                }else{
                    echo "<h3>không gửi được mẫu</h3>";
                }
            }
            $_SESSION['id'] = $i[0];
            header("Location: user");
            exit();
        }
    }
    $ktmk=false;
}
$conn->close();
?>

<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="vi" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Trang đăng nhập</title>
      <link rel="stylesheet" href="css/login_pass.css">
   </head>
   <body>
      <?php
        echo '<p id="page" style="display: none;">'.$page.'</p>';
      ?>
      <div class="wrapper">
         <div class="title">
            Trang đăng nhập
         </div>
         <form method="POST" action="">
            <div id="tb_lg"></div>
            <div class="field">
               <input name="username" type="text" required>
               <label>Tên Đăng Nhập</label>
            </div>
            <div class="field">
               <input name="password" type="password" required>
               <label>Mật Khẩu</label>
            </div>
            <?php
            if ($ktmk==false){
                echo '<br><p style="color: red;" class="content">Sai tên đăng nhập hoặc mật khẩu</p>';
            }
            ?>
            <div class="content">
               <div class="checkbox">
                  <input type="checkbox" id="remember-me">
                  <label for="remember-me">ghi nhớ tôi</label>
               </div>
               <div class="pass-link">
                  <a href="https://youtu.be/j2QWzvLxtR4?si=xcSJtOXZAQ5T0QvW">Quên mật khẩu?</a>
               </div>
            </div>
            <div class="field">
               <input type="submit" name="ck" value="Đăng Nhập">
            </div>
            <div class="signup-link">
                Không phải là thành viên? <a href="register">đăng ký ngay</a>
            </div>
         </form>
      </div>
   </body>
   <script src="js/main.js"></script>
   <script>
        window.onload = function() {
            tblg();
        };
    </script>
</html>