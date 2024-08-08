<div class="modal-header no-padding">
    <div class="table-header">
        Thêm mới - Cập nhật thông tin chức vụ
    </div>
</div>
<div class="modal-body">
    <div class="row">
        <form id="fm-regency" method="post">
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="form-field-username">Tiêu đề</label>
                    <div>
                        <input type="text" id="title" name="title" required="" 
                        placeholder="Tiêu đề chức vụ, ví dụ: Giáo viên" style="width:100%"
                        value="<?php echo (isset($_REQUEST['id'])) ? $this->jsonObj[0]['title'] : '' ?>"/>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="form-field-username">Được xếp lớp</label>
                    <div>
                        <label>
                            <input name="is_class" name="is_class" class="ace ace-switch ace-switch-7" type="checkbox"
                            <?php echo (isset($_REQUEST['id'])) ? ($this->jsonObj[0]['is_class'] == 1) ? 'checked=""' : '' : '' ?>>
                            <span class="lbl"></span>
                        </label>
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
    <button class="btn btn-sm btn-primary pull-right" onclick="save_regency()">
        <i class="ace-icon fa fa-save"></i>
        Ghi dữ liệu
    </button>
</div>