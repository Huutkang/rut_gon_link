<?php
function check_username($usn){
    require 'ketnoi.php';
    $sql = "SELECT * FROM user WHERE username = '$usn'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return false;
    } else {
        return true;
    }
}

function gioi_han_so_lan_thu(){
    // hàm này giúp kiểm tra không để hacker dò có bao nhiêu user trong hệ thống
    return true;
}


function generateRandomString($length = 30) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}

function check_len_password($password){
    $l = strlen($password);
    if ($l<6 || $l>16){
        return false;
    }else{
        return true;
    }
}

function admin($id){
    require 'ketnoi.php';
    $sql = "SELECT admin FROM user WHERE id = '$id'";
    $result = $conn->query($sql);
    $admin=0;
    if ($row = $result->fetch_assoc()){
        $admin=$row['admin'];
    }
    return $admin;
}

function user($id){
    require 'ketnoi.php';
    $sql = "SELECT * FROM user WHERE id = '$id'";
    $result = $conn->query($sql);
    $dr=[];
    if ($row = $result->fetch_assoc()){
        $dr[]=$row['username'];
        $dr[]=$row['ho_ten'];
        $dr[]=$row['admin'];
        $dr[]=$row['email'];
        $dr[]=$row['sdt'];
        $dr[]=$row['ngan_hang'];
        $dr[]=$row['so_tai_khoan'];
        
    }
    return $dr;
}

?>

