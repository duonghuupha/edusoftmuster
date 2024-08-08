<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li class="active">Nhân sự</li>
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
                        <button type="button" class="btn btn-info btn-sm" onclick="window.location.href='<?php echo URL.'/personnel?token='.$_SESSION['data'][0]['token'] ?>'">
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
                                    <a href="javascript:void(0)" onclick="save_import()">
                                        <i class="ace-icon fa fa-save"></i>
                                        Ghi dữ liệu
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" onclick="save_import_user()">
                                        <i class="ace-icon fa fa-save"></i>
                                        Ghi dữ liệu & Tạo tài khoản
                                    </a>
                                </li>
                            </ul>
                        </div>
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
                                <a href="<?php echo URL.'/public/tmp/personnel.xlsx' ?>" target="_blank">tại đây</a>
                            </p>
                            <p style="font-size:10px;font-style:italic;font-weight:bold">
                                (Mã nhân sự sẽ bị bôi đỏ đậm khi bị trung trong hệ thống)
                            </p>
                        </div>
                    </form>
                </div>
                <div class="col-xs-9">
                    <table id="list_personnel_tmp" 
                        class="table" 
                        role="grid"
                        aria-describedby="dynamic-table_info"></table>
                    <div id="personnel_tmp_pager"></div>
                </div>
            </div>
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->


<!--Form don vi tinh-->
<div id="modal-personnel" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    Cập nhật thông tin nhân sự
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="fm" method="POST" enctype="multipart/form-data">
                        <input id="image_old" name="image_old" type="hidden"/>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="form-field-username">
                                    Mã nhân sự &nbsp;
                                    <a href="javascript:void(0)" onclick="refresh_code()" title="Tạo mã code" id="refreshcode">
                                        <i class="fa fa-refresh"></i>
                                    </a>
                                </label>
                                <div>
                                    <input type="text" id="code" name="code" style="width:100%" required="" readonly=""/>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="form-field-username">Họ và tên</label>
                                <div>
                                    <input type="text" id="fullname" name="fullname" required=""
                                        placeholder="Họ và tên" style="width:100%" />
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="form-field-username">Giới tính</label>
                                <div>
                                    <select class="select2" data-placeholder="Lựa chọn giới tính..."
                                    style="width:100%" required="" id="gender" name="gender"
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
                                    name="birthday"  required="" onkeypress="validate(event)"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="form-field-username">Địa chỉ</label>
                                <div>
                                    <input type="text" id="address" name='address' placeholder="Địa chỉ" style="width:100%"
                                    required=""/>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="form-field-username">Điện thoại</label>
                                <div>
                                    <input type="text" id="phone" name="phone" onkeypress="validate(event)"
                                    placeholder="Điện thoại" style="width:100%" maxlength="10" required=""/>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="form-field-username">Email</label>
                                <div>
                                    <input type="email" id="email" name="email" placeholder="Email" style="width:100%"
                                    required=""/>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="form-field-username">Trình độ</label>
                                <div>
                                    <select class="select2" data-placeholder="Lựa chọn trình độ"
                                    style="width:100%" required="" id="level_id" name="level_id">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="form-field-username">Chuyên môn</label>
                                <div>
                                    <select class="select2" data-placeholder="Lựa chọn chuyên môn..."
                                    style="width:100%" id="job_id" name="job_id" required="">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="form-field-username">Phân công nhiệm vụ</label>
                                <div>
                                    <select class="select2" data-placeholder="Lựa chọn nhiệm vụ..."
                                    style="width:100%" required="" id="regency_id" name="regency_id">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="form-field-username">Hình ảnh</label>
                                <div>
                                    <input type="file" id="image" name="image" class="file_attach" style="width:100%"
                                    accept="image/png, image/gif, image/jpeg" onchange="check_type()"/>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger pull-left" id="close_modal" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    Đóng
                </button>
                <button class="btn btn-sm btn-primary pull-right" id="save_modal" onclick="save()">
                    <i class="ace-icon fa fa-save"></i>
                    Ghi dữ liệu
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End formm don vi tinh-->

<script src="<?php echo URL.'/public/' ?>scripts/personnel/import.js"></script>