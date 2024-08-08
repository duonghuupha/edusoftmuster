<div class="modal-header no-padding">
    <div class="table-header">
        Thêm mới - Cập nhật thông tin xã / phường
    </div>
</div>
<div class="modal-body">
    <div class="row">
        <form id="fm-commune" method="post">
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="form-field-username">Lựa chọn tỉnh / thành phố</label>
                    <div>
                        <select class="select2" data-placeholder="Lựa chọn tỉnh / thành phố"
                        style="width:100%" required="" id="code_province" name="code_province"
                        onchange="load_combo_district()">
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="form-field-username">Lựa chọn quận / huyện</label>
                    <div>
                        <select class="select2" data-placeholder="Lựa chọn quận / huyện"
                        style="width:100%" required="" id="code_district" name="code_district">
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="form-field-username">Mã xã / phường</label>
                    <div>
                        <input type="text" id="code" name="code" required="" 
                        placeholder="Mã xã / phường - theo tổng cục thống kê" style="width:100%"
                        value="<?php echo (isset($_REQUEST['id'])) ? $this->jsonObj[0]['code'] : '' ?>"/>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="form-field-username">Tên xã/phường</label>
                    <div>
                        <input type="text" id="title" name="title" required="" 
                        placeholder="Tên xã / phường - theo tổng cục thống kê" style="width:100%"
                        value="<?php echo (isset($_REQUEST['id'])) ? $this->jsonObj[0]['title'] : '' ?>"/>
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
    <button class="btn btn-sm btn-primary pull-right" onclick="save_commune()">
        <i class="ace-icon fa fa-save"></i>
        Ghi dữ liệu
    </button>
</div>
<script>
$(function(){
    <?php
    if(isset($_REQUEST['id'])){
    ?>
    combo_select_2('#code_province', baseUrl + '/other/combo_province', '<?php echo $this->jsonObj[0]['code_province'] ?>', '<?php echo $this->jsonObj[0]['tinh_tp'] ?>');
    combo_select_2('#code_district', baseUrl + '/other/combo_district?code_province=<?php echo $this->jsonObj[0]['code_province'] ?>', '<?php echo $this->jsonObj[0]['code_district'] ?>', '<?php echo $this->jsonObj[0]['quan_huyen'] ?>');
    <?php
    }else{
    ?>
    combo_select_2('#code_province', baseUrl + '/other/combo_province', 0, '');
    <?php
    }
    ?>
});

function load_combo_district(){
    combo_select_2('#code_district', baseUrl + '/other/combo_district?code_province='+$('#code_province').val(), 0, '');
}
</script>