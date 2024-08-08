<?php
$item = $this->jsonObj;
?>
<div class="modal-header no-padding">
    <div class="table-header">
        Thêm mới - Cập nhật thông tin học sinh
    </div>
</div>
<div class="modal-body">
    <div class="row">
        <form id="fm-info" method="POST" enctype="multipart/form-data">
            <input id="image_old" name="image_old" type="hidden" value="<?php echo $item[0]['image'] ?>"/>
            <div class="col-xs-3">
                <div class="form-group">
                    <div class="col-xs-12 text-center">
                        <span class="profile-picture">
                            <?php
                            if($item[0]['image'] != ''){
                            ?>
                            <img id="avatar_info" class="img-responsive" src="<?php echo URL.'/public/students/'.$item[0]['image'] ?>" />
                            <?php
                            }else{
                            ?>
                            <img id="avatar" class="img-responsive" src="<?php echo URL ?>/styles/assets/images/avatars/profile-pic.jpg" />
                            <?php
                            }
                            ?>
                        </span>
                    </div>
                    <div class="col-xs-12">
                        <input type="file" id="image_info" name="image" class="file_attach" style="width:100%"
                        accept="image/png, image/gif, image/jpeg" onchange="change_import_info()"/>
                        <small style="text-align:center">Hình ảnh sử dụng so sánh khi điểm danh</small>
                    </div>
                </div>
            </div>
            <div class="col-xs-9">
                <div class="col-xs-6">
                    <div class="form-group">
                        <label for="form-field-username">
                            Mã học sinh &nbsp;
                            <a href="javascript:void(0)" onclick="refresh_code()" title="Tạo mã code"
                                id="refreshcode_edit">
                                <i class="fa fa-refresh"></i>
                            </a>
                        </label>
                        <div>
                            <input type="text" id="code" name="code" style="width:100%" required=""
                                readonly="" value="<?php echo $item[0]['code'] ?>"/>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label for="form-field-username">
                            Mã định danh
                        </label>
                        <div>
                            <input type="text" id="identifier" name="identifier" style="width:100%"
                                placeholder="Mã định danh theo mã của CSDL"  value="<?php echo $item[0]['identifier'] ?>"/>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label for="form-field-username">
                            Họ và tên
                        </label>
                        <div>
                            <input type="text" id="fullname" name="fullname" style="width:100%" required=""
                                placeholder="Họ và tên" value="<?php echo $item[0]['fullname'] ?>"/>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label for="form-field-username">
                            Tên thường gọi
                        </label>
                        <div>
                            <input type="text" id="nickname" name="nickname" style="width:100%" 
                                placeholder="Tên thường gọi, VD: Bon" value="<?php echo $item[0]['nickname'] ?>"/>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label for="form-field-username">Ngày sinh (dd-mm-yyyy)</label>
                        <div>
                            <input class="form-control input-mask-date" id="birthday" type="text"
                                name="birthday" required="" onkeypress="validate(event)" value="<?php echo date('d-m-Y', strtotime($item[0]['birthday'])) ?>"/>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label for="form-field-username">Giới tính</label>
                        <div>
                            <select class="select2" data-placeholder="Lựa chọn giới tính..." style="width:100%"
                                required="" id="gender" name="gender"
                                data-minimum-results-for-search="Infinity">
                                <option value="1" <?php echo ($item[0]['gender'] == 1) ? "selected=''" : '' ?>>Nam</option>
                                <option value="2" <?php echo ($item[0]['gender'] == 2) ? "selected=''" : '' ?>>Nữ</option>
                                <option value="3" <?php echo ($item[0]['gender'] == 3) ? "selected=''" : '' ?>>Khác</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
        <i class="ace-icon fa fa-times"></i>
        Đóng
    </button>
    <button class="btn btn-sm btn-primary pull-right" onclick="save_info()">
        <i class="ace-icon fa fa-save"></i>
        Ghi dữ liệu
    </button>
</div>
<script>
$(function(){
    $('.select2').select2(); $('.input-mask-date').mask('99-99-9999');
    //Filebox
    $('.file_attach').ace_file_input({
        no_file:'Không có file ...',btn_choose:'Lựa chọn',
        btn_change:'Thay đổi',droppable:false,
        onchange:null,thumbnail:true
    });
});
</script>