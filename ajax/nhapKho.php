<?php
session_start();

    include_once ("../controller/cPhieuNhap.php");
    include_once ("../controller/cDonYeuCau.php");
    if (isset($_POST["action"])) {
        $action = $_POST["action"];
        if ($action == "layPhieuNhapKhoChoNhap") {
            $maKho = $_POST['maKho'];
        }
        if ($action == "layPhieuNhapKhoDaNhap") {
            $maKho = $_POST['maKho'];
        }
        if ($action == "layPhieuNhapKhoChoNhapQuanLy") {
            $maTaiKhoan = $_SESSION['maTaiKhoan'];
        }
        if ($action == "layToanBoPhieuNhapTheoKho") {
            $maKho = $_POST['maKho'];
        }
        if ($action == "layToanBoPhieuNhapTheoTaiKhoan") {
            $maTaiKhoan = $_SESSION['maTaiKhoan'];
        }
        if ($action == "layPhieuNhapKhoDaNhapQuanLy") {
            $maTaiKhoan = $_SESSION['maTaiKhoan'];
        }
        if($action == 'layChiTietPhieuNhap'){
            $maPhieu = $_POST['maPhieu'];
        }
        if($action == 'xacNhanNhapKho'){
            $maDon = $_POST['maDon'];            
            $maPhieu = $_POST['maPhieu'];
            $maSanPham = explode(',', $_POST['maSanPham']);
            $maKho = $_POST['maKho'];
            $soLuong = explode(',',$_POST['soLuong']);
            $donVi = explode(',',$_POST['donVi']);
            $ngaySanXuat = explode(',',$_POST['ngaySanXuat']);
            $ngayHetHan = explode(',',$_POST['ngayHetHan']);
        }
        switch ($action) { 
            case "layPhieuNhapKhoChoNhap":
                layPhieuNhapKhoChoNhapTheoKho($maKho);
                break;
            case "layPhieuNhapKhoDaNhap":
                layPhieuNhapKhoDaNhapTheoKho($maKho);
                break;
            case "layToanBoPhieuNhapTheoKho":
                layToanBoPhieuNhapTheoKho($maKho);
                break;
            case "layToanBoPhieuNhapTheoTaiKhoan":
                layToanBoPhieuNhapTheoTaiKhoan($maTaiKhoan);
                break;
            case "layPhieuNhapKhoChoNhapQuanLy":
                layPhieuNhapKhoChoNhapTheoTaiKhoan($maTaiKhoan);
                break;
            case "layPhieuNhapKhoDaNhapQuanLy":
                layPhieuNhapKhoDaNhapTheoTaiKhoan($maTaiKhoan);
                break;
            case "layChiTietPhieuNhap":
                layChiTietPhieuNhap($maPhieu);
                break;
            case "xacNhanNhapKho":
                themChiTietNguyenLieu($maDon,$maSanPham,$maPhieu,$maKho,$soLuong,$donVi,20000,$ngaySanXuat,$ngayHetHan);  
                break;
        }

    }
    function layPhieuNhapKhoChoNhapTheoKho($maKho){
        $p = new ControlPhieuNhap(); 
        $res = $p->layPhieuNhapKhoChoNhapTheoKho($maKho);
        if (!$res){
            echo json_encode(false);
        }else{
            echo json_encode($res);
        }
    }
    function layPhieuNhapKhoDaNhapTheoKho($maKho){
        $p = new ControlPhieuNhap(); 
        $res = $p->layPhieuNhapKhoDaNhapTheoKho($maKho);
        if (!$res){
            echo json_encode(false);
        }else{
            echo json_encode($res);
        }
    }
    function layPhieuNhapKhoDaNhapTheoTaiKhoan($maTaiKhoan){
        $p = new ControlPhieuNhap(); 
        $res = $p->layPhieuNhapKhoDaNhapTheoTaiKhoan($maTaiKhoan);
        if (!$res){
            echo json_encode(false);
        }else{
            echo json_encode($res);
        }
    
    }
    function layToanBoPhieuNhapTheoKho($maKho){
        $p = new ControlPhieuNhap(); 
        $res = $p->layToanBoPhieuNhap($maKho);
        if (!$res){
            echo json_encode(false);
        }else{
            echo json_encode($res);
        }
    }
    function layToanBoPhieuNhapTheoTaiKhoan($maTaiKhoan){
        $p = new ControlPhieuNhap(); 
        $res = $p->layToanBoPhieuNhapTheoTaiKhoan($maTaiKhoan);
        if (!$res){
            echo json_encode(false);
        }else{
            echo json_encode($res);
        }
    
    }
    function layPhieuNhapKhoChoNhapTheoTaiKhoan($maTaiKhoan){
        $p = new ControlPhieuNhap(); 
        $res = $p->layPhieuNhapKhoChoNhapTheoTaiKhoan($maTaiKhoan);
        if (!$res){
            echo json_encode(false);
        }else{
            echo json_encode($res);
        }
    
    }
    function layChiTietPhieuNhap($maPhieu){
        $p = new ControlPhieuNhap(); 
        $res = $p->layChiTietPhieuNhap($maPhieu);
        if (!$res){
            echo json_encode(false);
        }else{
            
            echo json_encode($res);
        }
    }
    function  themChiTietNguyenLieu($maDon, $maSanPham, $maPhieu, $maKho, $soLuongTon,$donVi, $gia, $ngaySanXuat, $ngayHetHan){
        $p = new ControlPhieuNhap();
        for ($i=0; $i < count($maSanPham) ; $i++) { 
            // Chuyển đổi $maSanPham[$i] thành chuỗi
            $maSanPhamStr = strval($maSanPham[$i]);

            // Lấy số đầu tiên và 3 số cuối
            $soDauTien = $maSanPhamStr[0];
            $baSoCuoi = substr($maSanPhamStr, -3);

            // Lấy ngày, tháng, và 2 số cuối của năm hiện tại
            $random = rand(1000,9999);

            // Tạo mã chi tiết
            $maChiTiet = $soDauTien . $baSoCuoi . $random;
            $res = $p->themChiTietNguyenLieu($maChiTiet, $maSanPham[$i], $maPhieu, $maKho, $soLuongTon[$i],$donVi[$i], $gia, $ngaySanXuat[$i], $ngayHetHan[$i]);
        }
        if(!$res){
            echo json_encode($res);
            return;
        }
        $res = $p-> xacNhanNhapKho($maPhieu);
        if($res){
            $res2 = layTrangThaiPhieuNhap($maDon);
            if($res2){
                $p2 = new ControlDonYeuCau();
                $p2->capNhatTrangThaiDonYeuCau($maDon, "Đã nhập kho",null);
            }
           
        }
         echo json_encode($res);
    }
    function layTrangThaiPhieuNhap($maDon){
        $p = new ControlPhieuNhap(); 
        $res = $p->layTrangThaiPhieuNhap($maDon);
        if (!$res){
            return false;
        }else{
            if(count($res) == 1  and $res[0]['TrangThai'] == 'Đã nhập kho') 
                return true;
            else return false;
        }
    }

?>