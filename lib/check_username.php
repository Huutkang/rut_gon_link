<?php
require_once "lib_user.php";

if (gioi_han_so_lan_thu()==false){
    echo "false";
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['data'])){
    $m = $data['data'];
    if (check_username($m[0])){
        echo "true";
    }else{
        echo "false";
    }
}else{
    echo "false";
}

?>