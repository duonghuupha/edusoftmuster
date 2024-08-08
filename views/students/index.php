<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li>Học sinh</li>
                <li class="active">Quản lý học sinh</li>
            </ul><!-- /.breadcrumb -->
            <div class="nav-search" id="nav-search">
                <form class="form-search">
                    <span class="input-icon">
                        <input type="text" placeholder="Tìm kiếm ..." class="nav-search-input" id="search_personnel"
                            onkeyup="search()" />
                        <i class="ace-icon fa fa-search nav-search-icon"></i>
                    </span>
                </form>
            </div><!-- /.nav-search -->
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Quản lý học sinh
                    <small class="pull-right">
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
                                <li class="divider"></li>
                                <li>
                                    <a href="javascript:void(0)" onclick="del()">
                                        <i class="ace-icon fa fa-trash"></i>
                                        Xóa
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <button type="button" class="btn btn-primary btn-sm" onclick="add()">
                            <i class="fa fa-plus"></i>
                            Thêm mới
                        </button>
                        <button type="button" class="btn btn-success btn-sm" onclick="window.location.href='<?php echo URL.'/students/import_student?token='.$_SESSION['data'][0]['token'] ?>'">
                            <i class="fa fa-file-excel-o"></i>
                            Nhập dữ liệu từ file Excel
                        </button>
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <table id="list_students" class="table" role="grid" aria-describedby="dynamic-table_info"></table>
                    <div id="students_pager"></div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<!--Form don vi tinh-->
<div id="modal-students" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width:60%">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    Thêm mới - Cập nhật thông tin học sinh
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="fm" method="POST" enctype="multipart/form-data">
                        <input id="image_old" name="image_old" type="hidden" />
                        <input id="relation_dc" name="relation_dc" type="hidden" />
                        <div class="col-xs-3">
                            <div class="form-group">
                                <div class="col-xs-12 text-center">
                                    <span class="profile-picture">
                                        <img id="avatar" class="img-responsive" src="<?php echo URL ?>/styles/assets/images/avatars/profile-pic.jpg" />
                                    </span>
                                </div>
                                <div class="col-xs-12">
                                    <input type="file" id="image" name="image" class="file_attach" style="width:100%"
                                    accept="image/png, image/gif, image/jpeg" onchange="change_import()"/>
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
                                            id="refreshcode">
                                            <i class="fa fa-refresh"></i>
                                        </a>
                                    </label>
                                    <div>
                                        <input type="text" id="code" name="code" style="width:100%" required="" readonly="" />
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
                                            placeholder="Mã định danh theo mã của CSDL" />
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
                                            placeholder="Họ và tên" />
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
                                            placeholder="Tên thường gọi, VD: Bon" />
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
                                            <option value="1">Nam</option>
                                            <option value="2">Nữ</option>
                                            <option value="3">Khác</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="form-field-username">Ngày sinh (dd-mm-yyyy)</label>
                                    <div>
                                        <input class="form-control input-mask-date" id="birthday" type="text"
                                            name="birthday" required="" onkeypress="validate(event)" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-9">
                                <div class="form-group">
                                    <label for="form-field-username">Địa chỉ</label>
                                    <div>
                                        <input class="form-control" id="address" name="address" required=""
                                            placeholder="Số nhà, tên đường, ..." />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label for="form-field-username">Lớp học</label>
                                    <div>
                                        <select class="select2" data-placeholder="Lựa chọn lớp học..." style="width:100%"
                                            required="" id="class_id" name="class_id"></select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <hr />
                        </div>
                        <div class="col-xs-6">
                            <h3 class="header smaller lighter blue" style="border:none;margin:0;">
                                Phụ huynh
                            </h3>
                        </div>
                        <div class="col-xs-6">
                            <button class="btn btn-sm btn-success pull-right" onclick="add_relation()" type="button"
                                id="select_devices">
                                <i class="ace-icon fa fa-user"></i>
                                Thêm mới (s)
                            </button>
                        </div>
                        <div class="col-xs-12 col-sm-12">
                            <table class="table_modal">
                                <colgroup style="width:100px;"></colgroup>
                                <colgroup style="width:150px;"></colgroup>
                                <colgroup style="width:120px;"></colgroup>
                                <colgroup style="width:170px;"></colgroup>
                                <colgroup style="width:120px;"></colgroup>
                                <colgroup style="width:120px;"></colgroup>
                                <colgroup style="width:100px;"></colgroup>
                                <colgroup style="width:20px;"></colgroup>
                                <thead>
                                    <tr>
                                        <th style="text-align:center">Quan hệ (*)</th>
                                        <th>Họ và tên (*)</th>
                                        <th>Điện thoại (*)</th>
                                        <th>Email</th>
                                        <th>Nghề nghiệp (*)</th>
                                        <th>Số CCCD</th>
                                        <th style="text-align:center">Năm sinh (*)</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">

                                </tbody>
                            </table>
                        </div><!-- /.col -->
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    Đóng
                </button>
                <button class="btn btn-sm btn-primary pull-right" onclick="save()">
                    <i class="ace-icon fa fa-save"></i>
                    Ghi dữ liệu
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End formm don vi tinh-->

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

<!--Form don vi tinh-->
<div id="modal-detail" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width:40%">
        <div class="modal-content" id="detail">
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End formm don vi tinh-->
 
<script src="<?php echo URL.'/public/' ?>scripts/students/index.js"></script>
<script src="<?php echo URL.'/public/' ?>scripts/students/address.js"></script>
<script src="<?php echo URL.'/public/' ?>scripts/students/relation.js"></script>