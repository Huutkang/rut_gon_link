<?php
require_once 'session_cookie.php';
if ($tologin){
    header("Location: login");
    exit();
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ghi chú</title>
    <link rel="stylesheet" href="css/input_link.css">
</head>
<body>
    <?php
    require_once 'lib/ketnoi.php';
    $sql = "SELECT MAX(id_link) AS max_id FROM link"; 
    $result = $conn->query($sql);
    $max=0;
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $max = (int)$row["max_id"];
        }
    }
    echo '<div style="display: none;" id="max_id">';
    echo $max;
    echo '</div>';
    $conn->close();
    ?>
    <div id="ctn" class="container">
        <div id="div1">
            <h1>Thêm link</h1>
            <textarea id="input_link_b1" placeholder="thêm các đường link của bạn vào đây. mỗi đường link trên một dòng..." class="full-width"></textarea>
            <br>
            <button type="submit" onclick="ipl_tr1()" name="saveNote">Thêm link</button>
        </div>
    </div>
    <script src="js/main.js"></script>
</body>
</html>
