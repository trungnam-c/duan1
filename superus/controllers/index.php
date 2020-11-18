<?php 
session_start();
ob_start();
require_once "../superus/models/index.php";
require_once "../system/share.php";
require_once "../system/conn.php";
require_once "../system/PHPMailer-master/src/PHPMailer.php";
require_once "../system/PHPMailer-master/src/SMTP.php";
require_once "../system/PHPMailer-master/src/Exception.php";
require_once "../system/Classes/PHPExcel.php";
if(isset($_SESSION['iddn']) && $_SESSION['role'] == 2){
if(isset($_GET['act'])){
   $act = $_GET['act'];
}else{
   $act = "home";
}
$achome="";$acbt="";$aclop="";$actb="";$chat="";
switch ($act) {
   case 'home':
      $tb = thongbao();
      $view = "../superus/views/tongquan.php";
      require_once "../superus/views/layout.php";
   break;
   case 'lop':
   $aclop="active";
   $alllh=alllophoc();
   $view = "../superus/views/lophoc.php";
   require_once "../superus/views/layout.php";
   break;
   case 'themlh':
      $dskhoa=allkhoahoc();
      $view = "../superus/views/lophoc_them.php";
      require_once "../superus/views/layout.php";
   break;
   case "themlh_":
      if(isset($_POST['tenlop'])&&isset($_POST['tenkhoa'])){
         $tenlop = xoatag($_POST['tenlop']);
         $tenkhoa = $_POST['tenkhoa'];
     
         themlophoc($tenlop,$tenkhoa);
         header('location: index.php?act=lop');
      }else{
         header('location: index.php?act=lop');
      }
   break;
   
   case 'chude':
      $accd="active";
      $chude = getAllChuDe(); 
      $view = "../superus/views/chude.php";
      require_once "../superus/views/layout.php";
      break;

   case'xoacd':
      if(isset($_GET['idcd']) && $_GET['idcd'] > 0){
         deleteChuDe($_GET['idcd'] );
         header('location: index.php?act=chude');
      }else echo "Không xóa được!";
   break; 
   case 'formcd':
      $accd="active";
      $view = "../superus/views/chude_them_sua.php";
      require_once "../superus/views/layout.php";
      break;
    
   case 'themcd': 
      if(isset($_POST['themcd'])){ 
         $chude = $_POST['tencd']; 
         insertChuDe($chude);
         header('location: index.php?act=chude');
      }else echo "Không thêm được!";
      break;
   case 'suacd': 
      if(isset($_POST['suacd'])){ 
         $chude = $_POST['tencd']; 
         $idcd = $_POST['idcd'];  
         updateChuDe($chude,$idcd);
         header('location: index.php?act=chude');
      }else echo "Không Sửa được!";
   break;   
   case 'khoahoc':
      $ackh="active";
      $khoahoc = getAllKH();
      $view = "../superus/views/khoahoc.php";
      require_once "../superus/views/layout.php";
      break;
   case'xoakh':
         if(isset($_GET['idkh']) && $_GET['idkh'] > 0){
            deleteKhoaHoc($_GET['idkh'] );
            header('location: index.php?act=khoahoc');
         }else echo "Không xóa được!";
      break;  
   case 'formkh':
      $ackh="active";
      $chude = getAllChuDe();
      $view = "../superus/views/khoahoc_them_sua.php";
      require_once "../superus/views/layout.php";
      break;
    
   case 'themkh':
      
      if(isset($_POST['themkh'])){
          
         $mota = xoatag($_POST['mota']); 
         $chude = $_POST['chude'];
         $tenkh = xoatag($_POST['tenkh']);
         $imgkh=$_FILES['anhkh'];
         $tenhinh=$imgkh['name'];
         upfile($imgkh);
         insertKhoaHoc($tenkh,$mota,$chude,$tenhinh);
         header('location: index.php?act=khoahoc');
      }else echo "Không thêm được!";
      break;
   case 'suakh':
      
      if(isset($_POST['suakh'])){ 
         $mota = xoatag($_POST['mota']); 
         $idkh = $_POST['idkh'];         
         $chude = $_POST['chude'];
         $tenkh = xoatag($_POST['tenkh']);
         $imgkh=$_FILES['anhkh'];
         $tenhinh=$imgkh['name'];
         upfile($imgkh);
         updateKhoaHoc($tenkh,$mota,$chude,$tenhinh,$idkh,$idkh);
         header('location: index.php?act=khoahoc');
      }else echo "Không Sửa được!";
   break;   
   
   case 'thongbao':
      $thongbao_list = getThongBao();
      $view = "../superus/views/thongbao.php";
      require_once "../superus/views/layout.php";
      break;   

   case 'xoatb':
      if (isset($_GET['id'])&&$_GET['id']>0) {
         xoaThongBao($_GET['id']);
         header('location: index.php?act=thongbao');
      }
      break;
      case 'xoalh':
         if (isset($_GET['id'])&&$_GET['id']>0) {
            xoalophoc($_GET['id']);
            header('location: index.php?act=lop');
         }
         break;
   case 'suatb_':
      if(isset($_POST['tieude'])&&isset($_POST['noidung'])&&isset($_POST['idngdang'])){
         $tieude = xoatag($_POST['tieude']);
         $noidung = $_POST['noidung'];
         $idnguoidang = $_POST['idngdang'];
         $idthongbao = $_POST['idtb'];
         suathongbao($tieude, $noidung, $idnguoidang, $idthongbao);
      }
         header('location: index.php?act=thongbao');
      break;
   case 'sualh':
      if (isset($_GET['id'])&&$_GET['id']>0) {
         $lh = getMotlophoc($_GET['id']);
         $dskhoa=allkhoahoc();
         $view = "../superus/views/lophoc_sua.php";
         require_once "../superus/views/layout.php";
      }
      break;
   case 'sualh_' :
      if(isset($_POST['tenlop'])&&isset($_POST['tenkhoa'])){
         $tenlop = xoatag($_POST['tenlop']);
         $tenkhoa = $_POST['tenkhoa'];
         $idlop = $_POST['idlh'];
         sualh($tenlop, $tenkhoa, $idlop);
      }
         header('location: index.php?act=lop');
      break;
   
   case 'suatb':
      if (isset($_GET['id'])&&$_GET['id']>0) {
         $thongbao = getMotTb($_GET['id']);
         $view = "../superus/views/thongbao_sua.php";
         require_once "../superus/views/layout.php";
      }
      break;
      
   case 'themtb':
      $view = "../superus/views/thongbao_them.php";
      require_once "../superus/views/layout.php";
      break;   

   case 'themtb_':
      if(isset($_POST['tieude'])&&isset($_POST['noidung'])&&isset($_POST['idnguoidang'])){
         $tieude = xoatag($_POST['tieude']);
         $noidung = $_POST['noidung'];
         $idnguoidang = $_POST['idnguoidang'];
         themthongbao($tieude, $noidung, $idnguoidang);
         header('location: index.php?act=thongbao');
      }else
         header('location: index.php?act=thongbao');
      break;

   case 'dangxuat':
      unset($_SESSION['role']);
      unset($_SESSION['iddn']);
      unset($_SESSION['tdn']);
      unset($_SESSION['hinhdn']);
      header('location: index.php');
      break;
   case 'sinhvien':
      $acsv = "active";
      if(isset($_GET['xoa'])){
         $id = xoatag($_GET['xoa']);
         xoasv($id);
         header('Location: index.php?act=sinhvien');
      }
      $sv = getallsv();
      $view = "../superus/views/sinhvien.php";
      require_once "../superus/views/layout.php";
   break;
   case 'addsinhvien':
      $mess = "";
      if(isset($_GET['cn'])){
         $cn = $_GET['cn'];
      }else $cn = 'them';
      $td = "Thêm";$cnn = "them";$btnv="THÊM";
      $ht = "";$ngaysinh="";$email="";$sdt="";$diachi="";$img = "";$sex1="checked";$sex0="";
      switch ($cn) {
         case 'sua':
            if(isset($_GET['id'])){
               $id = $_GET['id'];
               $sv = getsvid($id);
               $img = $sv['hinh'];
               $ht = $sv['hoten'];
               $ngaysinh = $sv['ngaysinh'];
               $email=$sv['email'];
               $sdt=$sv['sdt'];
               $diachi =$sv['diachi'];
               $sex1 = chuyendoi01($sv['sex'],"1","checked","");
               $sex0 = chuyendoi01($sv['sex'],"0","checked","");
            }else{
               $cn="them";
            }
            break;
         case 'them':
            if(isset($_POST['them'])){
               $ht = xoatag($_POST['ht']);
               $img = $_FILES['imgsv'];
               upfile($img);
               $img = $_FILES['imgsv']['name'];
               $ngaysinh = $_POST['ngaysinh'];
               $sdt = "+84".$_POST['sdt'];
               $email = xoatag($_POST['email']);
               $diachi = xoatag($_POST['diachi']);
               $sex = setnum($_POST['sex']);
               $tensv = explode(" ",$ht);
               $pass = rand(100000, 999999);
               $pass = hashpass($pass);
               $lastid = addtk($ht,$img,$ngaysinh,$email,$sdt,"0",$pass,$diachi,$sex);
               $tendn = texttoslug($tensv[(count($tensv)-1)]).$lastid;
               $check = addtk2($tendn,$lastid);
               $mess = showthongbao($check,"THÊM");
            }
         break;
      }
      $view = "../superus/views/formsv.php";
      require_once "../superus/views/layout.php";
   break;
}
}else{
      header('Location: ../index.php');
}
      
?>