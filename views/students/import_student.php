<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li class="active">Học sinh</li>
            </ul><!-- /.breadcrumb -->
            <div class="nav-search" id="nav-search">
                <form class="form-search">
                    <span class="input-icon">
                        <input type="text" placeholder="Tìm kiếm ..." class="nav-search-input" id="search_personnel"
                        onkeyup="search()"/>
                        <i class="ace-icon fa fa-search nav-search-icon"></i>
                    </span>
                </form>
            </div><!-- /.nav-search -->
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Nhập dữ liệu từ file excel
                    <small class="pull-right">
                        <button type="button" class="btn btn-info btn-sm" onclick="window.location.href='<?php echo URL.'/students?token='.$_SESSION['data'][0]['token'] ?>'">
                            <i class="fa fa-arrow-left"></i>
                            Quay lại
                        </button>
                        <div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle" aria-expanded="false">
                                Thao tác
                                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="javascript:void(0)" onclick="edit_info()">
                                        <i class="ace-icon fa fa-pencil"></i>
                                        Cập nhật thông tin
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" onclick="edit_address()">
                                        <i class="ace-icon fa fa-pencil"></i>
                                        Cập nhật địa chỉ
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" onclick="edit_relation()">
                                    <i class="ace-icon fa fa-pencil"></i>
                                        Cập nhật thông tin phụ huynh
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <button type="button" class="btn btn-success btn-sm" onclick="save_import()">
                            <i class="fa fa-save"></i>
                            Ghi dữ liệu
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="del_all_import()">
                            <i class="fa fa-trash"></i>
                            Xóa dữ tạm
                        </button>
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-3">
                    <form id="fm-import" method="POST" enctype="multipart/form-data">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="form-field-username">Lựa chọn lớp học</label>
                                <div>
                                    <select class="select2" data-placeholder="Lựa chọn lớp học..."
                                    style="width:100%" required="" id="class_id" name="class_id"></select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="form-field-username">
                                    Lựa chọn file 
                                    <small style="font-size:11px;font-style:italic">(File phải có định dạng *.xlsx)</small>
                                </label>
                                <div>
                                    <input type="file" id="file_tmp" name="file_tmp" class="file_attach" style="width:100%"
                                    accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" 
                                    onchange="change_import()"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <p>
                                Tải file mẫu để nhập dữ liệu một cách chính xác nhất. Tải file 
                                <a href="<?php echo URL.'/public/tmp/student.xlsx' ?>" target="_blank">tại đây</a>
                            </p>
                            <p style="font-size:10px;font-style:italic;font-weight:bold">
                                (Mã nhân sự sẽ bị bôi đỏ đậm khi bị trung trong hệ thống)
                            </p>
                        </div>
                    </form>
                </div>
                <div class="col-xs-9">
                    <table id="list_student_tmp" 
                        class="table" 
                        role="grid"
                        aria-describedby="dynamic-table_info"></table>
                    <div id="student_tmp_pager"></div>
                </div>
            </div>
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<div id="modal-form" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" id="form">
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!--Form don vi tinh-->
<div id="modal-address" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width: 40%">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    Thêm mới - Cập nhật thông tin địa chỉ của học sinh
                </div>
            </div>
            <div class="modal-body">
                <input id="student_code" name="student_code" type="hidden"/>
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <button type="button" class="btn btn-primary btn-sm pull-left" onclick="add_address()" id="add_row">
                            <i class="fa fa-plus"></i>
                            Thêm mới
                        </button>
                        <button type="button" class="btn btn-success btn-sm pull-left" onclick="save_address(0, 0)" id="save_row">
                            <i class="fa fa-save"></i>
                            Ghi dữ liệu
                        </button>
                        <button type="button" class="btn btn-danger btn-sm pull-left" onclick="del_address()" id="del_row">
                            <i class="fa fa-trash"></i>
                            Xóa
                        </button>
                        <button type="button" class="btn btn-info btn-sm pull-left" onclick="cancel_address(0)" id="cancel_row">
                            <i class="fa fa-times"></i>
                            Hủy bỏ
                        </button>
                    </div>
                    <div class="col-xs-12 col-sm-12">
                        <div class="space-4"></div>
                    </div>
                    <div class="col-xs-12 col-sm-12">
                        <table id="list_address" 
                            class="table" 
                            role="grid"
                            aria-describedby="dynamic-table_info"></table>
                        <div id="address_pager"></div>
                    </div><!-- /.col -->
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger pull-right" onclick="close_address()">
                    <i class="ace-icon fa fa-times"></i>
                    Đóng
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End formm don vi tinh-->

<!--Form don vi tinh-->
<div id="modal-relation" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width: 70%">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    Thêm mới - Cập nhật thông tin phụ huynh của học sinh
                </div>
            </div>
            <div class="modal-body">
                <input id="student_code_rel" name="student_code_rel" type="hidden"/>
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <button type="button" class="btn btn-primary btn-sm pull-left" onclick="add_rel()" id="add_row_rel">
                            <i class="fa fa-plus"></i>
                            Thêm mới
                        </button>
                        <button type="button" class="btn btn-success btn-sm pull-left" onclick="save_rel(0, 0)" id="save_row_rel">
                            <i class="fa fa-save"></i>
                            Ghi dữ liệu
                        </button>
                        <button type="button" class="btn btn-danger btn-sm pull-left" onclick="del_rel()" id="del_row_rel">
                            <i class="fa fa-trash"></i>
                            Xóa
                        </button>
                        <button type="button" class="btn btn-info btn-sm pull-left" onclick="cancel_rel(0)" id="cancel_row_rel">
                            <i class="fa fa-times"></i>
                            Hủy bỏ
                        </button>
                    </div>
                    <div class="col-xs-12 col-sm-12">
                        <div class="space-4"></div>
                    </div>
                    <div class="col-xs-12 col-sm-12">
                        <table id="list_relation" 
                            class="table" 
                            role="grid"
                            aria-describedby="dynamic-table_info"></table>
                        <div id="relation_pager"></div>
                    </div><!-- /.col -->
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    Đóng
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End formm don vi tinh-->

<script src="<?php echo URL.'/public/' ?>scripts/students/import.js"></script>
<script src="<?php echo URL.'/public/' ?>scripts/students/address.js"></script>
<script src="<?php echo URL.'/public/' ?>scripts/students/relation.js"></script>