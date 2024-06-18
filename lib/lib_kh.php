<?php
function ip_kh(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //check ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR']: '';
    }
    return $ip;
}

function info_kh(){
    $if = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT']: '';
    return $if;
}

function generateRandomString($length = 15) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}

function tach_cookie($cookie_kh){
    $a=substr($cookie_kh, 0, 15);
    $b=substr($cookie_kh, 15, 30);
    return [$a, $b];
}

function cr_ck_kh(){
    $ck="";
    if(isset($_COOKIE['ck_kh'])){
        $ck=$_COOKIE['ck_kh'];
        $a=tach_cookie($ck);
        $ck=$a[0].generateRandomString(15);
    }else{
        $ck=generateRandomString(30);
    }
    return $ck;
}

function req($id_link){
    $a=[];
    $a[]=cr_ck_kh();
    $a[]=$id_link;
    $a[]=date('Y-m-d H:i:s');
    $a[]=ip_kh();
    $a[]=info_kh();
    require 'ketnoi.php';
    if ($conn -> query("INSERT INTO kh (cookie_kh, id_link, date_time_request, ip, info) VALUES (N'$a[0]',N'$a[1]',N'$a[2]',N'$a[3]',N'$a[4]')" )){
        setcookie('ck_kh', $a[0], time()+31556926,"/");
    }else{
        echo "có lỗi gì đó";
        exit();
    }
}

function get_link(){
    $dr="";
    if(isset($_COOKIE['ck_kh'])){
        $ck=$_COOKIE['ck_kh'];
        require 'ketnoi.php';
        $sql = "SELECT stt, id_link, date_time_request FROM kh WHERE cookie_kh = '$ck'";
        $result = $conn->query($sql);
        if ($row = $result->fetch_assoc()){
            $stt = $row['stt'];
            $id_link = $row['id_link'];
            $old_time = strtotime($row['date_time_request']);
            $date_time=date('Y-m-d H:i:s');
            $current_time = strtotime($date_time);
            $time_diff = $current_time - $old_time;
            $sql = "SELECT input_link, kiem_tien FROM link WHERE id_link = '$id_link'";
            $result = $conn->query($sql);
            if ($row = $result->fetch_assoc()){
                $dr = $row['input_link'];
                $kt=intval($row['kiem_tien']);
                if ($kt==0){
                    $delay=4;
                }else{
                    $delay=10*$kt;
                }
                if ($time_diff<$delay){
                    return "-1";
                }
                else if ($time_diff>300){
                    return "1";
                }
            }else{
                return "";
            }
            $conn->query("UPDATE kh SET data_time_return = '$date_time' WHERE stt = '$stt'");
        }else{
            return "";
        }
    }
    return $dr;
}

