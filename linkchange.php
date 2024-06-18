<?php
require_once "session_cookie.php";
require_once "lib/ketnoi.php";
function check_user(){
    require "lib/ketnoi.php";
    $id_user=$_SESSION['id'];
    $sql = "SELECT * FROM link WHERE id_user = '$id_user'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $dr=[];
        while ($row = $result->fetch_assoc()) {
            $dr[]=$row['id_link'];
        }
        return $dr;
    } else {
        return [];
    }
}
function ktcc($chuoi_cha, $chuoi_con){
    if (strpos($chuoi_cha, $chuoi_con) !== false) {
        return true;
    } else {
        return false;
    }
}
// tạo một hàm kiểm tra các id link gửi về có trùng với id người dùng hiện tại không
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['data'])){
    $m = $data['data'];
    $m_idl=check_user();
    $a=[];
    $m2=[];
    foreach ($m as $i){
        $b=ltrim($i[0],"-");
        if (in_array($b,$m_idl)){
            $a[]=$i;
        }else{
            $m2[]=$b;
        }
    }
    $m1=[];
    foreach($a as $i){
        $id_l=ltrim($i[0],"-");
        if (ktcc($i[0], "-")){
            $stmt = $conn->prepare("DELETE FROM link WHERE id_link = ?");
            $stmt->bind_param("s", $id_l);
            $stmt->execute();
        }
        else if ($conn->query("UPDATE link SET input_link = '$i[1]', output_link = '$i[2]', kiem_tien = '$i[3]' WHERE id_link = '$id_l'")){
            $m1[]=$i;
        }else{
            $m2[]=$i;
        }
    }

}else{
    echo "false";
}



$domain = "nguyenhuuthang.click";

if (count($m1)>0){
    echo '<h3>Danh sách các link đã lưu thành công</h3>';
    echo '<table>
    <tr>
        <th>Input link</th>
        <th>Output link</th>
        <th>Kiếm tiền</th>
    </tr>
    ';
    foreach ($m1 as $i){
        echo '<tr>
            <td>'.$i[1].'</td>
            <td>'."https://".$domain."/".$i[2].'</td>
            <td>'.$i[3].'</td>
        </tr>';
    }
    echo '</table>';
    echo '<br>';
}

if (count($m2)>0){
    echo '<h3>danh sách các link chưa được lưu</h3>
    <p>có thể các link output này đã tồn tại. hoặc vừa có người thêm các link này ngay trước bạn</p><p>bạn cần sửa và sau đó lưu lại</p>';
    echo '<table id="ipl_b3">
    <tr>
        <th style="display: none;">id</th>
        <th>Input link</th>
        <th>Output link</th>
        <th>Kiếm tiền</th>
    </tr>';
    foreach($m2 as $i){
        print_r($i);
        echo '<tr>
        <td style="display: none;">
            <input type="text" value="'.$i[0].'">
        </td>
        <td>
            <input type="text" value="'.$i[1].'">
        </td>
        <td>
            <input type="text" value="'.$i[2].'">
        </td>
        <td>
            <input type="text" value="'.$i[3].'">
        </td>
    </tr>';
    }
    echo '</table>';
    echo '<button type="submit" onclick="sl_tr2()">Thử lại</button>';
    
}
else{
    echo '<button type="submit" onclick="sl_tr3()">Hoàn Thành</button>';
}

?>

