<?php
require 'session_cookie.php';
?>
<?php
if ($tologin){
    header("Location: login");
    exit();
}

?>



<?php
require_once 'lib/ketnoi.php';

$ssmk=true;
$ktmk=true;

if (isset($_POST['sp'])){
    $mkc = $_POST['mkc'];
    $mkm = $_POST['mkm'];
    $lmkm = $_POST['lmkm'];
    if ($mkm==$lmkm){
        $user=[];
        $result = $conn->query("SELECT * FROM user");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $m=[];
                $m[]=(int)$row['id'];
                $m[]=$row['password_hash'];
                $user[]=$m;
            }
        } else {
            echo "<p>không có người dùng</p>";
        }
        $id=$_SESSION['id'];
        $mkc = md5($mkc);
        foreach($user as $i){
            if ($i[0]==$id && $i[1]==$mkc){
                $mkm = md5($mkm);
                if ($conn->query("UPDATE user SET password_hash = '$mkm' WHERE id = '$id'")) {
                    echo "Cập nhật dữ liệu thành công.";
                } else {
                    echo "Lỗi cập nhật dữ liệu: " . $conn->error;
                }
                header("Location: admin");
                exit();
            }
        }
        $ktmk=false;
    }
    else{
        $ssmk=false;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="vi" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Thay đổi mật khẩu</title>
      <link rel="stylesheet" href="css/login_pass.css">
   </head>
   <body>
      <div class="wrapper">
         <div class="title">
            Trang admin
         </div>
         <form method="POST" action="">
            <div class="field">
               <input name="mkc" type="password" required>
               <label>Mật khẩu cũ</label>
            </div>
            <div class="field">
                <input name="mkm" type="password" required>
                <label>Mật khẩu mới</label>
             </div>
             <div class="field">
                <input name="lmkm" type="password" required>
                <label>Nhập lại mật khẩu mới</label>
             </div>
             <?php
                if ($ssmk==false){
                    echo '<p class="content">Nhập lại mật khẩu không đúng</p>';
                }
                else if ($ktmk==false){
                    echo '<p class="content">Sai mật khẩu</p>';
                }
             ?>
            <div class="content">
               <div class="pass-link">
                  <a href="#">Quên mật khẩu?</a>
               </div>
            </div>
            <div class="field">
               <input name="sp" type="submit" value="Đổi mật khẩu">
            </div>
         </form>
      </div>
   </body>
</html>