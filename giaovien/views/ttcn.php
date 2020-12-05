<div class="header-box">
    <div class="tieude h1">Thông tin cá nhân</div>
</div>
<div class="d-ttcn">
    <div class="d-tt-left p-3">
        <div class="d-tt-img">
            <img src="<?= showfile($thongtin['hinh'])?>" align="bottom" onerror="erroimg(this)">
            <div class="d-tt-img-text">
                <p><?= $thongtin['hoten'] ?> <i class="fas fa-user-graduate" style="color:pink"></i></p>
                <span><?php 
                $cv ='';
                $btn = '';
                    if ($thongtin['chucvu']==0){
                        $cv = "Sinh viên";
                        $btn = '<div class="d-info2 d-nb mt-2 w-100">
                                    <a href="index.php?act=diemsvct&idsv='.$thongtin['id'].'" class="btn btn-outline-success w-100">Bảng điểm</a>
                                </div>';
                    }
                    else if($thongtin['chucvu']==1) $cv = "Giáo viên";
                    else $cv = "SU";
                    echo $cv;
                ?></span>
            </div>
        </div>
        <div class="d-tt-80">
            <div class="d-tt-100 mt-30">
                <div class="d-tt-text-100 ">
                    <span class="d-tt-text-theme">Email</span>
                    <span class="d-tt-text-title"><?= $thongtin['email'] ?></span>
                </div>
                <div class="d-tt-text-100">
                    <span class="d-tt-text-theme">Số điện thoại</span>
                    <span class="d-tt-text-title"><?= $thongtin['sdt'] ?></span>
                </div>
                <?php 
                    if($thongtin['id']==$_SESSION['iddn']) {
                ?>
                <div class="d-tt-text-100">
                    <a href="index.php?act=changepass">Đổi mật khẩu</a>
                </div>
                    <?php }?>
                <?=$btn?>
            </div>
        </div>
    </div>
    <div class="d-tt-right">
        
        <div class="d-tt-95">
            <div class="d-tt-form">
                <div class="d-tt-100">


                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Họ và tên</label>
                        <div class="col-sm-9">
                            <input disabled type="text" class="form-control" id="inputPassword" value="<?= $thongtin['hoten'] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Mã sinh viên</label>
                        <div class="col-sm-9">
                            <input disabled type="text" class="form-control" id="inputPassword" value="<?= $thongtin['id'] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Giới tính</label>
                        <div class="col-sm-9">
                            <input disabled type="text" class="form-control" id="inputPassword" value="<?= ($thongtin['sex']==1) ? "Nam" : "Nữ" ; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Ngày sinh</label>
                        <div class="col-sm-9">
                            <input disabled type="date" class="form-control" id="inputPassword" value="<?= $thongtin['ngaysinh'] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Địa chỉ</label>
                        <div class="col-sm-9">
                            <input disabled type="text" class="form-control" id="inputPassword"
                                value="<?= $thongtin['diachi'] ?>">
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>