<?php
require_once "lib/lib_kh.php";

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['data'])) {
    $m = $data['data'];
    if ($m[0] == 'getlink'){
        $link=get_link();
        echo $link;
    }
}
else {
    header("Location: https://youtu.be/ovmplyvYquM?si=MNfeRik4B4CMC5I2");
    exit();
}


