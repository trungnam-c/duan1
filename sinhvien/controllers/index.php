<?php 
// if(isset($_SESSION['iddn']) && $_SESSION['role'] == 0){
if(isset($_GET['act'])){
   $act = $_GET['act'];
}else{
   $act = "home";
}

switch ($act) {
   case 'home':
      $view = "../sinhvien/views/home.php";
      require_once "../sinhvien/views/layout.php";
   break;
   case 'baitap':
      $view = "../sinhvien/views/baitap.php";
      require_once "../sinhvien/views/layout.php";
   break;
   case 'dkkh':
      $view = "../sinhvien/views/dkkh.php";
      require_once "../sinhvien/views/layout.php";
   break;
   case 'thongbao':
      $view = "../sinhvien/views/thongbao.php";
      require_once "../sinhvien/views/layout.php";
   break;
   case 'bangdiem':
      $view = "../sinhvien/views/bangdiem.php";
      require_once "../sinhvien/views/layout.php";
   break;
   case 'thongtincn':
      $view = "../sinhvien/views/ttcn.php";
      require_once "../sinhvien/views/layout.php";
   break;
}
// }else{
//       header('Location: ../index.php');
// }
?>