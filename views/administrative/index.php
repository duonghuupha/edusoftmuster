<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li class="active">Hành chính</li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content">
            <div class="row">
                <div class="col-xs-12 col-sm-6 half">
                    <h3 class="header smaller lighter blue">
                        Phòng ban / Lớp học
                        <small class="pull-right">
                            <button type="button" class="btn btn-primary btn-minier" onclick="charge_user()">
                                <i class="fa fa-users"></i>
                                Phân  công giáo viên
                            </button>
                            <button type="button" class="btn btn-primary btn-minier" onclick="copy_class()">
                                <i class="fa fa-copy"></i>
                                Copy phòng ban/lớp học
                            </button>
                        </small>
                    </h3>
                    <div class="col-xs-12 col-sm-12">
                        <form id="fm-department" method="post">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="form-field-username">Lựa chọn năm học</label>
                                        <div>
                                            <select class="select2" data-placeholder="Lựa chọn năm học"
                                            style="width:100%" required="" id="year_id" name="year_id">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="form-field-username">Lựa chọn phòng "vật lý"</label>
                                        <div>
                                            <select class="select2" data-placeholder="Lựa chọn phòng 'vật lý'"
                                            style="width:100%" required="" id="physical_id" name="physical_id">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="form-field-username">Lựa chọn hệ đào tạo</label>
                                        <div>
                                            <select class="select2" data-placeholder="Lựa chọn hệ đào tạo"
                                            style="width:100%" required="" id="training_system_id" name="training_system_id">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="form-field-username">Tên phòng ban / lớp học</label>
                                        <div>
                                            <input type="text" id="title_department" name="title" required=""
                                            placeholder="Tên phòng, ví dụ: Phòng Hiệu trưởng" style="width:100%" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                        <label for="form-field-username">Là lớp học</label>
                                        <div>
                                            <label>
                                                <input name="is_class" id="is_class" class="ace ace-switch ace-switch-7" type="checkbox">
                                                <span class="lbl"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="space-4"></div>
                                </div>
                                <div class="col-xs-12 text-center">
                                    <button class="btn btn-sm btn-danger" type="button" onclick="javascript:location.reload()">
                                        <i class="ace-icon fa fa-times"></i>
                                        Hủy bỏ
                                    </button>
                                    <button class="btn btn-sm btn-primary" type="button" onclick="save_department()">
                                        <i class="ace-icon fa fa-save"></i>
                                        Ghi dữ liệu
                                    </button>
                                </div>
                            </div>
                        </form>
                        <hr/>
                        <table id="list_department"></table>
                        <div id="department_pager"></div>
                    </div>
                </div><!-- /.col -->
                <div class="col-xs-12 col-sm-6 half">
                    <h3 class="header smaller lighter blue">
                        Năm học
                        <small style="font-size:12px;font-style:italic">(Chỉ một năm học được kích hoạt)</small>
                    </h3>
                    <div class="col-xs-12 col-sm-12">
                        <form id="fm-years" method="post">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="form-field-username">Tên năm học</label>
                                        <div>
                                            <input type="text" id="title_years" name="title" required=""
                                            placeholder="Tên năm học, ví dụ: Năm học 2023 - 2024" style="width:100%" />
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-sm-12">
                                    <div class="space-4"></div>
                                </div>
                                <div class="col-xs-12 text-center">
                                    <button class="btn btn-sm btn-danger" type="button" onclick="javascript:location.reload()">
                                        <i class="ace-icon fa fa-times"></i>
                                        Hủy bỏ
                                    </button>
                                    <button class="btn btn-sm btn-primary" type="button" onclick="save_years()">
                                        <i class="ace-icon fa fa-save"></i>
                                        Ghi dữ liệu
                                    </button>
                                </div>
                            </div>
                        </form>
                        <hr/>
                        <table id="list_years"></table>
                        <div id="years_pager"></div>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<!--Form don vi tinh-->
<div id="modal-form" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width:50%">
        <div class="modal-content" id="form">
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End formm don vi tinh-->

<!--Form don vi tinh-->
<div id="modal-copy" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width:20%">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    Copy dữ liệu phòng ban / lớp học
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="fm-copy" method="POST" enctype="multipart/form-data">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="form-field-username">Lựa chọn năm học muốn copy đến</label>
                                <div>
                                    <select class="select2" data-placeholder="Lựa chọn năm học..."
                                    style="width:100%" required="" id="year_id_copy" name="year_id_copy"
                                    data-minimum-results-for-search="Infinity" onchange="set_year_copy(this.value)">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="form-field-username">Copy giáo viên theo lớp</label>
                                <div>
                                    <label>
                                        <input name="is_copy" id="is_copy" class="ace ace-switch ace-switch-7" type="checkbox">
                                        <span class="lbl"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group text-center" id="notify"></div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    Đóng
                </button>
                <button class="btn btn-sm btn-primary pull-right" onclick="save_copy()">
                    <i class="ace-icon fa fa-save"></i>
                    Ghi dữ liệu
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End formm don vi tinh-->

<script src="<?php echo URL.'/public/' ?>scripts/administrative/years.js"></script>
<script src="<?php echo URL.'/public/' ?>scripts/administrative/department.js"></script>