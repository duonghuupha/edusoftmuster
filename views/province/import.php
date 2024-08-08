<div class="modal-header no-padding">
    <div class="table-header">
        Import danh sách tỉnh thành phố :: File excel
    </div>
</div>
<div class="modal-body">
    <div class="row">
        <form id="fm-imp-province" method="post" enctype="multipart/form-data">
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="form-field-username">Lựa chọn file</label>
                    <div>
                        <input type="file" id="file_tmp" name="file_tmp" required="" style="width:100%"
                        class="file_attach"/>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="form-field-username">File mẫu: <a href="">Tải file mẫu</a></label>
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
    <button class="btn btn-sm btn-primary pull-right" onclick="save_imp_province()">
        <i class="ace-icon fa fa-save"></i>
        Ghi dữ liệu
    </button>
</div>
<script>
$(function(){
    $('.file_attach').ace_file_input({
        no_file:'Không có file ...',btn_choose:'Lựa chọn',
        btn_change:'Thay đổi',droppable:false,
        onchange:null,thumbnail:true
    });
});
</script>