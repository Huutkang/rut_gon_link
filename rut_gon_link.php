<?php
require_once 'lib/ketnoi.php';
require_once 'lib/lib_kh.php';
$page = isset($_GET['page']) ? $_GET['page'] : 'false';

$sql = "SELECT id_link, kiem_tien FROM link WHERE output_link = '$page'";
$result = $conn->query($sql);
$l=true;
$delay=0;
if ($row = $result->fetch_assoc()){
    $id_link=$row['id_link'];
    $delay=10*intval($row['kiem_tien']);
    req($id_link);
}
else{
    $l=false;
}
$conn->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Rút gọn link</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            #rgl_div{
                height: 100vh;
            }
        </style>
        <link rel="stylesheet" href="css/rgl.css">
    </head>
    <body onmousemove="dnbt()" touchmove="dnbt()">
        <div id="init" style="display: none;">
            <?php
            if ($l){
                if ($delay<=0){
                    $delay=4;
                    echo $delay;
                }
                else{
                    echo $delay;
                }
            }else{
                echo "<h1>link bạn cần không tồn tại</h1><br><h3>có thể đã bị xóa bởi chủ sở hữu. </h3>";
            }
            ?>
        </div>
        <div id="rgl_div">
            <div id="dem_s"></div>
        </div>
        <script src="js/main.js" async defer></script>
        <script>
            window.onload = function() {
                bdd();
            };
        </script>
        
    </body>
</html>

