<?php
require_once 'session_cookie.php';
require_once 'lib/lib_user.php';
require_once 'lib/ketnoi.php';

$user=user($_SESSION['id']);

if ($tologin){
    header("Location: login");
    exit();
}

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Trang cá nhân</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/input_link.css">
    </head>
    <body>
        <div id="ctn" class="container">

            <div>
                <?php

                if ($user[1]!=""){
                    echo "<h1> Chào mừng: ";
                    echo $user[1];
                    echo "</h1>";
                }
                else{
                    echo "<h1> Chào mừng: ".$user[0]."</h1>";
                }
                ?>
            

                <a href="input_link">Thêm link của bạn</a>
                <a href="add_user_info">Thêm thông tin cá nhân</a>
                <a href="logout">Đăng xuất</a>
            </div>
            <br><br><br>
            <div id="bang">
                <?php
                $id_user=$_SESSION['id'];
                $sql = "SELECT * FROM link WHERE id_user = '$id_user'";
                $result = $conn->query($sql);


                if ($result->num_rows > 0) {
                    echo '<table id="blink1">';
                    echo '<tr>';
                    echo '<th style="display: none;">id</th><th>Input link</th><th>Output link</th><th>Ngày giờ</th><th>Kiếm tiền</th>';
                    echo '</tr>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo "<td style='display: none;'>{$row['id_link']}</td><td>{$row['input_link']}</td><td>{$row['output_link']}</td><td>{$row['date_time']}</td><td>{$row['kiem_tien']}</td>";
                        echo '</tr>';
                    }

                    echo '</table>';
                } else {
                    echo "<p>Bạn chưa có link rút gọn nào</p>";
                }
                ?>
                <button type="submit" onclick="sua_link()">Sửa</button>
            </div>
            <div id="us_tb" ></div>
        </div>
        <script src="js/main.js" async defer></script>
    </body>
</html>