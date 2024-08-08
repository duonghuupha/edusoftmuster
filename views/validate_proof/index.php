<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li>Kiểm định</li>
                <li class="active">Quản lý minh chứng</li>
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
                    Quản lý minh chứng
                    <small class="pull-right">
                        <button type="button" class="btn btn-primary btn-sm" onclick="add()">
                            <i class="fa fa-plus"></i>
                            Thêm mới
                        </button>
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-7 col-sm-7">
                    <table id="list_proof" 
                        class="table" 
                        role="grid"
                        aria-describedby="dynamic-table_info"></table>
                    <div id="proof_pager"></div>
                </div><!-- /.col -->
                <div class="col-xs-5 col-sm-5">
                    <table id="list_proof_dt" 
                        class="table" 
                        role="grid"
                        aria-describedby="dynamic-table_info"></table>
                    <div id="proof_dt_pager"></div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<!--Form don vi tinh-->
<div id="modal-info" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    Thêm mới - Cập nhật thông tin minh chứng
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="fm-info" method="POST" enctype="multipart/form-data">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="form-field-username">
                                    Mã hóa minh chứng
                                </label>
                                <div>
                                    <input type="text" id="encode" name="encode" required=""
                                    placeholder="Mã hóa minh chứng" style="width:100%;text-transform:uppercase" />
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="form-field-username">Lựa chọn tiêu chuẩn</label>
                                <div>
                                    <select class="select2" data-placeholder="Lựa chọn tiêu chuẩn..."
                                    style="width:100%" required="" id="stand_id" name="stand_id"
                                    data-minimum-results-for-search="Infinity" onchange="set_criteria(this.value)">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="form-field-username">Lựa chọn tiêu chí</label>
                                <div>
                                    <select class="select2" data-placeholder="Lựa chọn tiêu chí..."
                                    style="width:100%" required="" id="criteria_id" name="criteria_id"
                                    data-minimum-results-for-search="Infinity">
                                    </select>
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
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End formm don vi tinh-->

<!--Form don vi tinh-->
<div id="modal-dt" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width: 60%">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    Thêm mới - Cập nhật dữ liệu minh chứng
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="fm-dt" method="POST" enctype="multipart/form-data">
                        <input id="file_old" name="file_old" type="hidden"/> 
                        <input id="file_link" name="file_link" type="hidden"/> 
                        <input id="type_dc_dc" name="type_dc_dc" type="hidden"/>
                        <div class="col-xs-4" style="border-right: 1px solid #307ECC">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="form-field-username">
                                        Mã hóa minh chứng
                                    </label>
                                    <div id="encode_dt"></div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="form-field-username">Tiêu chuẩn</label>
                                    <div id="stand_dt"></div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="form-field-username">Tiêu chí</label>
                                    <div id="criteria_dt"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-8">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="form-field-username">Lựa chọn năm học</label>
                                    <div>
                                        <select class="select2" data-placeholder="Lựa chọn năm học..."
                                        style="width:100%" required="" id="year_proof" name="year_proof"
                                        data-minimum-results-for-search="Infinity">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-8">
                                <div class="form-group">
                                    <label for="form-field-username">
                                        Tiêu đề minh chứng
                                    </label>
                                    <div>
                                        <input type="text" id="title" name="title" required=""
                                        placeholder="Tiêu đề minh chứng" style="width:100%;" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="form-field-username">Lựa chọn kiểu dữ liệu</label>
                                    <div>
                                        <select class="select2" data-placeholder="Lựa chọn kiểu dữ liệu..."
                                        style="width:100%" required="" id="type_data" name="type_data"
                                        data-minimum-results-for-search="Infinity" onchange="set_type_data(this.value)">
                                            <option value="">Lựa chọn kiểu dữ liệu</option>
                                            <option value="1">Tệp dữ liệu</option>
                                            <option value="2">Tệp dữ liệu văn thư</option>
                                            <option value="3">Đường dẫn dữ liệu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-8">
                                <div class="form-group" id="type_1">
                                    <label for="form-field-username">Tệp dữ liệu</label>
                                    <div>
                                        <input type="file" id="file" name="file" class="file_attach" style="width:100%"/>
                                    </div>
                                </div>
                                <div class="form-group" id="type_2">
                                    <label for="form-field-username">Tệp dữ liệu văn thư</label>
                                    <div class="input-group">
                                        <input type="text" id="file_link_title" name="file_link_title"
                                        placeholder="Click Go! để lựa chọn" style="width:100%;" readonly=""/>
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm btn-primary" type="button" onclick="select_dc()"
                                            id="select_users">
                                                <i class="ace-icon fa fa-users bigger-110"></i>
                                                Go!
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group" id="type_3">
                                    <label for="form-field-username">Đường dẫn dữ liệu</label>
                                    <div>
                                        <input type="text" id="link" name="link"
                                        placeholder="Đường dẫn dữ liệu" style="width:100%;" />
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
                <button class="btn btn-sm btn-primary pull-right" onclick="save_dt()">
                    <i class="ace-icon fa fa-save"></i>
                    Ghi dữ liệu
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End formm don vi tinh-->

<!--Form don vi tinh-->
<div id="modal-dc" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width:60%">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <span class="white">×</span>
                    </button>
                    Danh sách văn bản
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-4 col-sm-4">
                        <select class="select2" data-placeholder="Lựa chọn kiểu dữ liệu..."
                        style="width:100%" required="" id="type_dc" name="type_dc"
                        data-minimum-results-for-search="Infinity" onchange="reload_dc(this.value)">
                            <option value="1">Văn bản đến</option>
                            <option value="2">Văn bản đi</option>
                        </select>
                    </div>
                    <div class="col-xs-8 col-sm-8">
                        <input class="form-control" id="nav-search-input-dc" type="text" style="width:100%"
                        placeholder="Tìm kiếm" onkeyup="search_dc()"/>
                    </div>
                    <div class="col-xs-12">
                        <div class="space-6"></div>
                    </div>
                    <div class="col-xs-12 col-sm-12">
                        <table id="list_dc" 
                            class="table" 
                            role="grid"
                            aria-describedby="dynamic-table_info"></table>
                        <div id="dc_pager"></div>
                    </div><!-- /.col -->
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End formm don vi tinh-->

<script src="<?php echo URL.'/public/' ?>scripts/validate/proof/index.js"></script>