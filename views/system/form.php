<div class="modal-header no-padding">
    <div class="table-header">
        Thêm mới - Cập nhật thông tin hệ đào tạo
    </div>
</div>
<div class="modal-body">
    <div class="row">
        <form id="fm-system" method="post">
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="form-field-username">Tiêu đề</label>
                    <div>
                        <input type="text" id="title" name="title" required="" 
                        placeholder="Tiêu đề hệ đào tạo, ví dụ: Mầm non" style="width:100%"
                        value="<?php echo (isset($_REQUEST['id'])) ? $this->jsonObj[0]['title'] : '' ?>"/>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="form-field-username">Mô tả</label>
                    <div>
                        <textarea id="content" name="content" placeholder="Mô tả" style="width:100%;resize:none"><?php echo (isset($_REQUEST['id'])) ? $this->jsonObj[0]['content'] : '' ?></textarea>
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
    <button class="btn btn-sm btn-primary pull-right" onclick="save_system()">
        <i class="ace-icon fa fa-save"></i>
        Ghi dữ liệu
    </button>
</div>