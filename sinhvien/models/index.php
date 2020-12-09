<?php 
// BÀI TẬP
// Lấy id lop theo id sinh viên đang đăng nhập
function getIDSV(){
    return laymot("SELECT * FROM sv_lop WHERE idsv = ".$_SESSION['iddn']);
}
// Check bài Tập đã nộp
function getBTByIDBaiTap($idbt){
    return laydulieu("SELECT * FROM baitap WHERE idbaitap = $idbt ORDER BY idbaitap DESC");
}
// lấy bài tập từ id lớp
function getBaiTapByID(){
    $idlop = getIDSV()['idlop'];
    return laydulieu("SELECT * FROM baitap WHERE idlop = $idlop ORDER BY idbaitap DESC");
}

function nopbaitap($idbt){
 return laymot("SELECT * FROM baitap bt inner JOIN lop on bt.idlop = lop.id inner join khoahoc kh on lop.idkhoa = kh.id inner JOIN sv_lop svl ON lop.id like svl.idlop inner join taikhoan tk ON svl.idsv = tk.id WHERE idbaitap = $idbt AND tk.id = $_SESSION[iddn]"); 
}

function checknopbai($idbt){
    return laymot("SELECT * FROM `upfile` WHERE idsv = $_SESSION[iddn] and idbaitap = $idbt");
}
function checkdiem($idbt){
    return laymot("SELECT * FROM `upfile` WHERE idbaitap = $idbt");
}
function nopbai($file,$idbt){
    return postdulieu("INSERT INTO `upfile` (`idfile`, `file`, `idbaitap`, `idsv`, `ngaynop`, `diem`) VALUES (NULL, '$file', '$idbt', $_SESSION[iddn], NOW(),null)");
}

function noplaibt($file,$idbt){
    return postdulieu("UPDATE `upfile` SET `file` = '$file', `ngaynop` = NOW() WHERE idbaitap = $idbt AND idsv = $_SESSION[iddn]");
}

function btdanop($idlop){
    return laydulieu("SELECT *,baitap.hinh AS 'hinhbt' FROM taikhoan INNER JOIN sv_lop ON sv_lop.idsv=taikhoan.id INNER JOIN lop ON lop.id=sv_lop.idlop INNER JOIN khoahoc ON khoahoc.id=lop.idkhoa INNER JOIN chude ON chude.id=khoahoc.chude INNER JOIN baitap ON lop.id=baitap.idlop WHERE lop.id =$idlop AND taikhoan.id= $_SESSION[iddn] AND baitap.idbaitap in (SELECT idbaitap FROM upfile WHERE idsv = $_SESSION[iddn]) ORDER BY ngaygiao DESC");
}
function btchuanop($idlop){
    return laydulieu("SELECT *,baitap.hinh AS 'hinhbt' FROM taikhoan INNER JOIN sv_lop ON sv_lop.idsv=taikhoan.id INNER JOIN lop ON lop.id=sv_lop.idlop INNER JOIN khoahoc ON khoahoc.id=lop.idkhoa INNER JOIN chude ON chude.id=khoahoc.chude INNER JOIN baitap ON lop.id=baitap.idlop WHERE lop.id =$idlop AND taikhoan.id= $_SESSION[iddn] AND baitap.idbaitap not in (SELECT idbaitap FROM upfile WHERE idsv = $_SESSION[iddn]) ORDER BY ngaygiao DESC");
}
// function laybaitapbyidsv(){
//    return laydulieu("SELECT idbaitap FROM upfile WHERE idsv = $_SESSION[iddn]");
// }
// lấy bài tập By id sinh viên và id  khóa học
function layBaiTapByKH($idkh){
    return laydulieu("SELECT * FROM baitap WHERE idlop IN (SELECT idlop FROM sv_lop WHERE idsv = $_SESSION[iddn]) AND idlop IN (SELECT id FROM lop WHERE idkhoa = $idkh)");
}

function tenlop($idlop){
    return laymot("SELECT * FROM lop WHERE id = $idlop");
}
//end BÀI TẬP

function thongbao($nguoinhan){
   return laydulieu("SELECT * FROM thongbao INNER JOIN taikhoan ON taikhoan.id=thongbao.idngdang where nguoinhan = $nguoinhan or nguoinhan = 2 ORDER BY ngaydang"); 
}
function thongbaoct($id){
    return laymot("SELECT * FROM thongbao INNER JOIN taikhoan ON taikhoan.id=thongbao.idngdang WHERE idtb=$id");
}
function thongtinsv($id,$idlop){
    return laydulieu("SELECT *,baitap.hinh AS 'hinhbt' FROM taikhoan INNER JOIN sv_lop ON sv_lop.idsv=taikhoan.id INNER JOIN lop ON lop.id=sv_lop.idlop INNER JOIN khoahoc ON khoahoc.id=lop.idkhoa INNER JOIN chude ON chude.id=khoahoc.chude INNER JOIN baitap ON lop.id=baitap.idlop  WHERE taikhoan.id= $id AND lop.id = $idlop ORDER BY ngaygiao DESC");
}   
function thongtinsv1($id){
    return laydulieu("SELECT *,baitap.hinh AS 'hinhbt' FROM taikhoan INNER JOIN sv_lop ON sv_lop.idsv=taikhoan.id INNER JOIN lop ON lop.id=sv_lop.idlop INNER JOIN khoahoc ON khoahoc.id=lop.idkhoa INNER JOIN chude ON chude.id=khoahoc.chude INNER JOIN baitap ON lop.id=baitap.idlop  WHERE taikhoan.id= $id  ORDER BY ngaygiao DESC");
}  
function thongtinsvtomtat($id)
{
    return laymot("SELECT * FROM taikhoan WHERE taikhoan.id= $id ");
}
function thongtingv($idgv){
    return laymot("SELECT * FROM gvlop INNER JOIN taikhoan ON taikhoan.id=gvlop.idgv WHERE idlop like '%$idgv%' ");
}

function khoahoc(){
    return laydulieu("SELECT * FROM khoahoc");
}
function khoahocdadk(){
    return laydulieu("SELECT * FROM khoahoc WHERE id in (SELECT idkhoa FROM lop WHERE id IN (SELECT idlop FROM sv_lop WHERE idsv = $_SESSION[iddn]))");
}
function khoahocchuadk(){
    return laydulieu("SELECT * FROM khoahoc WHERE id not in (SELECT idkhoa FROM lop WHERE id IN (SELECT idlop FROM sv_lop WHERE idsv = $_SESSION[iddn]))");
}
function khoaHocChiTiet($idkh){
    return laymot("SELECT * FROM khoahoc WHERE id = $idkh");
}
function lophoc($idkhoa){
    return laydulieu("SELECT * FROM lop WHERE idkhoa=$idkhoa");
}
function demlophoc($idkhoa){
    return laymot("SELECT count(*) as 'tong' FROM lop WHERE idkhoa=$idkhoa");
}
function gvkhoahoc($idlop){
    return laymot("SELECT * FROM taikhoan INNER JOIN gvlop ON gvlop.idgv=taikhoan.id  INNER JOIN lop ON lop.id=gvlop.idlop WHERE gvlop.idlop LIKE '%$idlop%'");
}
function dkkh($idsv,$idlop){
    return postdulieu("INSERT INTO `sv_lop` (`idsv`, `idlop`) VALUES ('$idsv', '$idlop')");}
function ttgvlop($idlop){
    return laymot("SELECT tk.* FROM taikhoan tk WHERE id = (SELECT idgv FROM gvlop WHERE idlop like '%$idlop%')");
}

function xetkhoahoc($id,$idsv){
    return laymot("SELECT * FROM khoahoc INNER JOIN lop ON khoahoc.id=lop.idkhoa INNER JOIN sv_lop ON sv_lop.idlop=lop.id WHERE lop.idkhoa=$id AND sv_lop.idsv=$idsv GROUP BY sv_lop.idsv");
}

function getlopsvdanghoc(){
    return laydulieu("SELECT lop.* , kh.tenkhoa ,kh.hinh as hinhkh FROM lop inner join khoahoc kh on kh.id = lop.idkhoa WHERE lop.id in (SELECT idlop FROM sv_lop WHERE idsv = $_SESSION[iddn])");
}
function demsvlop($idlop){
    return laymot("SELECT COUNT(*) as 'sl' FROM sv_lop WHERE idlop = $idlop");
}
function gethinhlopchat($idlop){
    return laymot("SELECT hinh FROM taikhoan WHERE id = (SELECT idgv FROM gvlop WHERE idlop like '%$idlop%' limit 1)")['hinh'];
}
function gettenchude($cd){
    return laymot("SELECT * FROM chude WHERE id = $cd");
}
function addnaptien($idtt,$idtk,$tien,$noidung,$time){
   return postdulieu("INSERT INTO `thanhtoan` (`id`, `mathanhtoan`, `idtk`, `sotien`, `noidung`, `time`) VALUES (NULL, '$idtt', '$idtk', '$tien', '$noidung', '$time')");
}
function capnhattien($tien,$id){
    postdulieu("UPDATE `taikhoan` SET `tien` = `tien` + '$tien' WHERE `taikhoan`.`id` = $id");
}
function capnhattrutien($tien,$id){
    return  postdulieu("UPDATE `taikhoan` SET `tien` = `tien` - '$tien' WHERE `taikhoan`.`id` = $id");
}
function getkhoahocbylopid($id){
    return laymot("SELECT * FROM khoahoc WHERE id = (SELECT idkhoa FROM lop WHERE id = $id)");
}
function demdanop($idlop)
{

}
function dembtlop($id){
    return laymot("SELECT COUNT(*) as 'tong' FROM baitap WHERE idlop = '$id'");
}

function demallbt(){
    $idlop = getIDSV()['idlop'];
    $tong = laymot("SELECT count(*) as 'tong' FROM baitap WHERE idlop = $idlop");
    return $tong['tong'];
}
?>
