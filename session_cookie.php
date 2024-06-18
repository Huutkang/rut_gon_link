<?php
session_start();
?>
<?php
function check_cookie($user, $cookie) {
    foreach ($user as $i) {
        if ($i[0] === $cookie) {
            return $i[1];
        }
    }
    return 0;
}

$tologin = false;

if (isset($_SESSION['id'])){
    if ($_SESSION['id'] < 1 || gettype($_SESSION['id'])!="integer"){
        echo "<h1>Ủa. bạn là ai?</h1>";
        header("Location: logout");
        exit();
    }
}else{
    require_once 'lib/ketnoi.php';
    
    $conn->set_charset("utf8mb4");
    $user = [];
    $result = $conn->query("SELECT * FROM cookie");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $m = [];
            $m[] = $row['cookie'];
            $m[] = $row['id_username'];
            $user[] = $m;
        }
        if (isset($_COOKIE['id'])){
            $s=check_cookie($user, $_COOKIE['id']);
            if ($s==0){
                $tologin=true;
            }else{
                $_SESSION['id']=$s;
            }
        }else{
            $tologin=true;
        }
    } else {
        $tologin=true;
    }
}
?>
