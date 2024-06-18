<?php
session_start();

$data = json_decode(file_get_contents("php://input"), true);

function check_data($input){
    return $input;
}


function check_link($chuoi) {
    $cac_chuoi_da_biet = array("add_user_info","admin","index","input_link","link_handling","login","logout","passchange","register","rut_gon_link","session_cookie","user","lib/check_username","lib/ketnoi","lib/lib_user");
    if (in_array($chuoi, $cac_chuoi_da_biet)) {
        return false;
    } else {
        return true;
    }
}


if (isset($data['data'])) {
    require_once 'lib/ketnoi.php';
    // Lấy mảng dữ liệu từ JSON
    $m = $data['data'];
    $m1=[];
    $m2=[];
    $id_user=$_SESSION['id'];
    $dk=true;
    foreach ($m as $i) {
        if ($dk){
            $dk=false;
            continue;
        }
        $a=check_data($i);
        $input_link=$a[0];
        $output_link=$a[1];
        $currentTime = date('Y-m-d H:i:s');
        try{
            if (check_link($output_link)){
                if ($conn -> query("INSERT INTO link (id_user, input_link, output_link, date_time) VALUES (N'$id_user',N'$input_link',N'$output_link',N'$currentTime')" )){
                    $m1[]=$a;
                }else{
                    $m2[]=$a;
                }
            }
            else{
                $m2[]=$a;
            }
            
        }catch(Exception $e){
            $m2[]=$a;
        }
    }
    
    // việc bây giờ là tạo 2 cái bảng trong thẻ div


    
    $conn->close();
}
else {
    header("Location: input_link");
    exit();
}




$domain = "nguyenhuuthang.click";

if (count($m1)>0){
    echo '<h3>Danh sách các link đã lưu thành công</h3>';
    echo '<table>
    <tr>
        <th>Input link</th>
        <th>Output link</th>
    </tr>
    ';
    foreach ($m1 as $i){
        echo '<tr>
            <td>'.$i[0].'</td>
            <td>'."https://".$domain."/".$i[1].'</td>
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
        <th>Input link</th>
        <th>Output link</th>
    </tr>';
    foreach($m2 as $i){
        echo '<tr>
        <td>
            <input type="text" value="'.$i[0].'">
        </td>
        <td>
            <input type="text" value="'.$i[1].'">
        </td>
    </tr>';
    }
    echo '</table>';
    echo '<button type="submit" onclick="ipl_tr2()">Thử lại</button>';
    
}
else{
    echo '<button type="submit" onclick="ipl_tr3()">Hoàn Thành</button>';
}
?>
    

