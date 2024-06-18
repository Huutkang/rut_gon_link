var X; // Biến lưu trữ mảng dữ liệu hiện tại


function ipl_tr1(){
    var ip1 = document.getElementById('input_link_b1');
    var vb = ip1.value;
    var m = vb.trim().split('\n');
    var n=[['input link (link bất kì)','output link (phần sau của link. vd: https://www.google.com/...)']];
    var max_id = document.getElementById('max_id').innerHTML;
    max_id = parseInt(max_id)+1;
    m.forEach(element => {
        let x = element.trim();
        let p=[];
        if (x!==""){
            p.push(x);
            p.push(generateRandomString()+max_id);
            n.push(p);
            max_id+=1;
        }
    });
    let div = tao_bang2(n, "2");
    let ctn = document.getElementById('ctn');
    ctn.appendChild(div);
    let div1 = document.getElementById('div1');
    div1.style.display = "none";
}


// Hàm gửi và nhận mảng dữ liệu
function send_receive_array(myArray, url) {
    // Sử dụng AJAX để gửi mảng lên máy chủ
    var xhr = new XMLHttpRequest();
    xhr.open("POST", url, false);
    xhr.setRequestHeader("Content-Type", "application/json");
    // Chuyển đổi mảng thành chuỗi JSON và gửi đi
    xhr.send(JSON.stringify({
        data: myArray
    }));
    return xhr.responseText;
}

function tao_bang2(mang, id) {
    // Tạo thẻ div để chứa bảng
    var div = document.createElement('div');
    div.id = "div" + id;

    // Tạo bảng và thêm tiêu đề
    var table = document.createElement('table');
    table.id = "table" + id;
    var newRow = table.insertRow(0);
    for (var i = 0; i < mang[0].length; i++) {
        xy = document.createElement("th");
        xy.innerHTML = mang[0][i];
        xy.classList.add("c"+(1+i));
        newRow.appendChild(xy);
    }
    // Thêm dòng dữ liệu và nút cập nhật
    for (var i = 1; i < mang.length; i++) {
        th(table, mang[i], i);
    }
    var bt = document.createElement("button");
    bt.innerHTML = "OK";
    bt.onclick = function() {
        send_data(table);
        div.remove();
        let div1 = document.getElementById('div1');
        div1.remove();
    };
    div.appendChild(table);
    div.appendChild(bt);
    return div;
}

// Hàm thêm dòng vào bảng
function th(table, selectedRow, row) {
    var newRow = table.insertRow(row);
    for (let i = 0; i < selectedRow.length; i++) {
        xy = document.createElement("td");
        xy.classList.add("c"+(1+i));
        var input = document.createElement('input');
        input.type = 'text';
        input.value = selectedRow[i];
        xy.appendChild(input);
        newRow.appendChild(xy);
    }
    newRow.appendChild(xy);
}

function generateRandomString() {
    let result = '';
    const characters = 'abcdefghijklmnopqrstuvwxyz0123455789';
    const charactersLength = characters.length;
    for (let i = 0; i < 4; i++) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}


// Hàm đọc dữ liệu từ bảng và trả về mảng
function read_input(table, t=0) {
    var m = [];
    var n = [];
    for (var i = 0; i < table.rows.length; i++) {
        n = [];
        if (i < 1) {
            for (var j = 0; j < table.rows[i].cells.length-t; j++) {
                var cell = table.rows[i].cells[j];
                n.push(cell.innerHTML);
            }
        } else {
            for (var j = 0; j < table.rows[i].cells.length-t; j++) {
                var cell = table.rows[i].cells[j];
                cell = cell.querySelector('input');
                n.push(cell.value);
            }
        }
        m.push(n);
    }
    return m;
}

function send_data(table){
    var m = read_input(table);
    var ctn = document.getElementById('ctn');
    var vb = send_receive_array(m, "link_handling");
    var div = document.createElement("div");
    div.id="div3";
    div.innerHTML=vb;
    ctn.appendChild(div);
}

function ipl_tr2(){
    var table = document.getElementById("ipl_b3");
    var m = read_input(table);
    var vb = send_receive_array(m, "link_handling");
    var ctn = document.getElementById('ctn');
    var div3 = document.getElementById('div3');
    div3.remove();
    var div = document.createElement("div");
    div.id="div3";
    div.innerHTML=vb;
    ctn.appendChild(div);
}

function ipl_tr3(){
    window.location.href = "user";
}

function check_user(){
    var username = document.getElementById('usn').value;
    var tb = document.getElementById("tb1");
    if (username.length > 50){
        tb.innerHTML='<p style="color: red;" class="content">Username quá dài</p>';
        return false;
    }
    var kq = send_receive_array([username], "lib/check_username").trim();
    if (kq=="false"){
        tb.innerHTML='<p style="color: red;" class="content">Username đã tồn tại</p>';
        return false;
    }
    else{
        tb.innerHTML="";
        if (username!=""){
            return true;
        }
        else{
            return false;
        }
    }
}

function check_password(){
    var pas1 = document.getElementById("pas1").value;
    var pas2 = document.getElementById("pas2").value;
    var tb = document.getElementById("tb2");
    if (pas1==pas2 || pas2==""){
        tb.innerHTML="";
        if (pas1!="" && pas2!=""){
            return true;
        }else{
            return false;
        }
    }
    else{
        tb.innerHTML='<p style="color: red;" class="content">Mật khẩu không khớp</p>';
        return false;
    }
    
}

function cpw(){
    var pas1 = document.getElementById("pas1").value;
    var tb = document.getElementById("tb3");
    if (pas1.length<6 || pas1.length>16){
        tb.innerHTML='<p style="color: red;" class="content">Độ dài mật khẩu từ 6 đến 16 kí tự</p>';
        check_ip(c=false);
    }else{
        tb.innerHTML="";
        check_ip();
    }
}

function check_ip(c=true){
    let a = check_password();
    let b = check_user();
    var div = document.getElementById("divbtdk");
    if (a && b && c){
        div.style = "";
    }else{
        div.style.display = "none";
    }

}

function tblg(){
    var page = document.getElementById("page").innerHTML;
    var tb = document.getElementById("tb_lg");
    if (page == "register"){
        tb.innerHTML='<p style="color: blue;" class="content">Bạn đã đăng ký thành công</p>';
        setTimeout(() => {
            tb.innerHTML='<p style="color: blue;" class="content">Vui lòng đăng nhập lại để sử dụng</p>';
        }, 2500);
        setTimeout(() => {
            tb.innerHTML='';
        }, 6000);
        
    }
}

function read_table(table) {
    var m = [];
    var n = [];
    for (var i = 0; i < table.rows.length; i++) {
        n = [];
        for (var j = 0; j < table.rows[i].cells.length; j++) {
            var cell = table.rows[i].cells[j];
            n.push(cell.textContent);
        }
        m.push(n);
    }
    return m;
}

function thsl(table, selectedRow, row) {
    var newRow = table.insertRow(row);
    for (let i = 0; i < selectedRow.length; i++) {
        xy = document.createElement("td");
        if (i == 0) {
            xy.style.display = "none";
        }
        var input = document.createElement('input');
        input.type = 'text';
        input.name = 'data' + i;
        input.value = selectedRow[i];
        xy.appendChild(input);
        newRow.appendChild(xy);
    }
    xy = document.createElement("td");
    bt = document.createElement("button");
    bt.innerHTML = "Xóa";
    bt.onclick = function() {
        newRow.style.display = "none";
        newRow.cells[0].querySelector("input").value = "-" + newRow.cells[0].querySelector("input").value;
    };
    xy.appendChild(bt);
    newRow.appendChild(xy);
    xy.colSpan = 7;
}

function compareArrays(array1, array2) {
    if (array1.length !== array2.length) {
        return false;
    }
    for (var i = 0; i < array1.length; i++) {
        if (array1[i] !== array2[i]) {
            return false;
        }
    }
    return true;
}

function array_change(a, b) {
    var c = [];
    lb = b.length;
    for (var i = 0; i < a.length; i++) {
      // Nếu phần tử tại vị trí i khác nhau, thêm phần tử từ mảng a vào mảng c
        if (i < lb){
            if (compareArrays(a[i], b[i]) == false) {
                c.push(a[i]);
            }
        }
        else{
            c.push(a[i]);
        }
    }
    return c;
}


function update_sl(table){
    var m = read_input(table, 1);
    var send_arr = array_change(m, X);
    var output = send_receive_array(send_arr, "linkchange");
    var div = document.getElementById("us_tb");
    var b = document.getElementById("bang");
    var c = document.getElementById("divblink2");
    b.remove();
    c.remove();
    div.innerHTML = output;
    
}

function tao_bang3(mang, id) {
    // Tạo thẻ div để chứa bảng
    var div = document.createElement('div');
    div.id = "div" + id;

    // Tạo bảng và thêm tiêu đề
    var table = document.createElement('table');
    table.id = "table" + id;
    var newRow = table.insertRow(0);
    for (var i = 0; i < mang[0].length; i++) {
        xy = document.createElement("th");
        if (i == 0) {
            xy.style.display = "none";
        }
        xy.innerHTML = mang[0][i];
        newRow.appendChild(xy);
    }
    xy = document.createElement("th");
    xy.innerHTML = "Xóa";
    newRow.appendChild(xy);

    // Thêm dòng dữ liệu và nút cập nhật
    for (var i = 1; i < mang.length; i++) {
        thsl(table, mang[i], i);
    }
    bt1 = document.createElement("button");
    bt1.innerHTML = "Cập Nhật";
    bt1.className = "cn";
    bt1.onclick = function() {
        update_sl(table);
    };
    div.appendChild(table);
    div.appendChild(bt1);
    return div;
}

function xoaCotThuTu(maTran) {
    for (let i = 0; i < maTran.length; i++) {
        maTran[i].splice(3, 1);
    }
    return maTran;
}


function sua_link(){
    var ctn = document.getElementById("ctn");
    var divb = document.getElementById("bang");
    var table = document.getElementById("blink1");
    divb.style.display='none';

    var m = read_table(table);
    m = xoaCotThuTu(m);
    X=m;
    var div = tao_bang3(m,"blink2");
    ctn.appendChild(div);
}

function sl_tr2(){
    var table = document.getElementById("ipl_b3");
    var us_tb = document.getElementById("us_tb");
    us_tb.remove();
    console.log(table);
    var m = read_input(table);
    m.shift();
    console.log(m);
    var vb = send_receive_array(m, "linkchange");
    var ctn = document.getElementById('ctn');
    var div = document.createElement("div");
    div.id="us_tb";
    div.innerHTML=vb;
    ctn.appendChild(div);

}

function sl_tr3(){
    window.location.href = "user";
}

// ----------------------------------------------------------------

function getlink(){
    m=['getlink'];
    var vb="";
    vb = send_receive_array(m, "su_ly");
    if (vb=="-1"){
        window.location.reload(true);
    }else if (vb=="1"){
        window.location.reload(true);
    }else if(vb==""){
        var div = document.getElementById("rgl_div");
        div.innerHTML="<h1>link bạn cần không tồn tại</h1><br><h3>có thể đã bị xóa bởi chủ sở hữu. </h3>";
    }
    else{
        var div = document.getElementById("rgl_div");
        var bt1 = document.getElementById("rgl_bt1");
        bt1.remove();
        window.open(vb, "_blank");
        var t = document.createElement('textarea');
        t.value=vb;
        div.appendChild(t);
        
    }
}

var DN=true;

function dem_nguoc(time){
    if (he!=document.scrollingElement.scrollTop){
        DN=true;
        he = document.scrollingElement.scrollTop;
    }
    if (DN && time>0){
        var time=time-1;
        var div = document.getElementById("dem_s");
        div.innerHTML="Đếm ngược lấy link: "+time;
    }
    DN=false;
    if (time<=0){
        clearInterval(interval);
        var div1 = document.getElementById("dem_s");
        div1.remove();
        var div = document.getElementById("rgl_div");
        var bt = document.createElement("button");
        bt.innerHTML="Lấy link";
        bt.id="rgl_bt1";
        bt.onclick = function() {
            getlink();
        };
        div.appendChild(bt);
    }
    return time;
}

function bdd(){
    var init = document.getElementById("init");
    vb=init.innerHTML;
    if (isNaN(Number(vb))){
        var rgl_div = document.getElementById("rgl_div");
        rgl_div.remove();
        init.style="";
    }else{
        he = document.scrollingElement.scrollTop;
        var time=Number(vb);
        interval = setInterval(function() {
            time=dem_nguoc(time);
        }, 1000);
    }
}

function dnbt(){
    DN=true;
}

