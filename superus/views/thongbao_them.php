<div class="header-box">
    <div class="tieude h1">Thêm thông báo</div>
</div>
<div class="thongbao">
    <form action="index.php?act=themtb_" method="post" id="thongbao">
        <div class="form-group">
            <label for="tieude">Tiêu đề</label>
            <input type="text" class="form-control" id="tieude" 
                placeholder="Tiêu đề của thông báo" name="tieude" value="">
        </div>
        <div class="form-group">
            <label for="nguoinhan">Người nhận</label>
            <select name="nguoinhan" id="nguoinhan">
                <option value="2" selected>Tất cả</option>
                <option value="0">Sinh viên</option>
                <option value="1">Giáo viên</option>
            </select>
        </div>
        <div class="form-group" id="checkloi">
            <label for="noidung">Nội dung</label>
        <textarea id="noidung" cols="120" rows="10" name="noidung"></textarea>
            <label id="nderror" style="color: red;" for="noidung"><?php if (isset($_SESSION['lndtb'])) {
               echo $_SESSION['lndtb'];
            }?></label>
        </div>
        <input type="hidden" name="idnguoidang" value="<?= $_SESSION['iddn'] ?>">
        <button type="submit" class="btn btn-primary" id="dangtb">Đăng thông báo</button>
    </form>
</div>
<script>  
        // Cấu hình lại toolbar, hiển thị một vài Button.
        noidung.config.toolbar = [  ['Font','FontSize'], ['Bold','Italic']  ];
     
        // Cấu hình lại màu nền giao diện.
        noidung.config.uiColor = '#9AB8F3';
        noidung.config.resize_enabled = false;
        noidung.config.width = '500px';
        noidung.config.height = '70px';
    </script>