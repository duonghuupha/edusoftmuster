<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li class="">Công việc</li>
                <li class="active">Quản lý công việc</li>
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
                    Quản lý công việc
                    <small class="pull-right">
                        <button type="button" class="btn btn-primary btn-sm" onclick="add()">
                            <i class="fa fa-plus"></i>
                            Thêm mới
                        </button>
                        <button type="button" class="btn btn-success btn-sm" onclick="task_group()">
                            <i class="fa fa-tags"></i>
                            Nhóm công việc
                        </button>
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <table id="list_erp" 
                        class="table" 
                        role="grid"
                        aria-describedby="dynamic-table_info"></table>
                    <div id="erp_pager"></div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<!--Form don vi tinh-->
<div id="modal-erp" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width: 60%">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    Thêm mới - Cập nhật thông tin công việc
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="fm" method="POST" enctype="multipart/form-data">
                        <input id="code" name="code" type="hidden"/>
                        <div class="col-xs-8" style="border-right:1px solid #307ECC">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label style="display:flex">
                                        Công việc cá nhân
                                        <input name="private" id="private" class="ace ace-switch ace-switch-7" type="checkbox" checked=""
                                        onclick="change_process()">
										<span class="lbl"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label style="display:flex">
                                        Hiển thị trong lịch tuần
                                        <input name="display_week" id="display_week" class="ace ace-switch ace-switch-7" type="checkbox">
										<span class="lbl"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <hr style="margin:0px 0px 10px 0px; border-top:1px dashed #307ECC"/>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="form-field-username">Mức độ ưu tiên</label>
                                    <div>
                                        <select class="select2" data-placeholder="Lựa chọn mức độ ưu tiên"
                                        style="width:100%" required="" id="prioritize" name="prioritize"
                                        data-minimum-results-for-search="Infinity">
                                            <option value="1">Bình thường</option>
                                            <option value="2">Cao</option>
                                            <option value="3">Khẩn cấp</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="form-field-username">Lựa chọn nhóm công việc</label>
                                    <div>
                                        <select class="select2" data-placeholder="Lựa chọn nhóm công việc..."
                                        style="width:100%" required="" id="group_id" name="group_id"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="form-field-username">Tiêu đề công việc</label>
                                    <div>
                                        <input type="text" id="title" name="title" required=""
                                            placeholder="Tiêu đề công việc" style="width:100%" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="form-field-username">Mô tả công việc</label>
                                    <div>
                                        <textarea class="form-control" id="content" name="content" 
                                        placeholder="Mô tả chi tiết công việc" style="resize:none;height:100px;"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="form-field-username">Ngày kết thúc</label>
                                    <div class="input-group">
                                        <input class="form-control date-picker" id="date_end" name="date_end" type="text" data-date-format="dd-mm-yyyy"
                                        required="" readonly=""/>
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar bigger-110"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="form-field-username">Người giám sát / Theo dõi</label>
                                    <div>
                                        <select class="select2" data-placeholder="Lựa chọn người giám sát..." disabled="true"
                                        style="width:100%" required="" id="user_id_monitor" name="user_id_monitor"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="form-field-username">Người thực hiện (s)</label>
                                    <div>
                                        <select class="select2" data-placeholder="Thực hiện....." multiple="true" disabled="true"
                                        style="width:100%" id="user_id_process" name="user_id_process[]"></select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="form-field-username">Lựa chọn file đính kèm cho công việc</label>
                                    <div>
                                        <input type="file" id="file_att" name="file_att" class="file_attach" style="width:100%"
                                        onchange="change_upload()" multiple=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12" id="list_file">
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
                <button class="btn btn-sm btn-primary pull-right" onclick="save()">
                    <i class="ace-icon fa fa-save"></i>
                    Ghi dữ liệu
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End formm don vi tinh-->

<!--Form don vi tinh-->
<div id="modal-task-group" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width: 40%">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    Quản lý nhóm công việc
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <button type="button" class="btn btn-primary btn-sm pull-left" onclick="add_task_group()" id="add_row">
                            <i class="fa fa-plus"></i>
                            Thêm mới
                        </button>
                        <button type="button" class="btn btn-success btn-sm pull-left" onclick="save_task_group(0, 0)" id="save_row">
                            <i class="fa fa-save"></i>
                            Ghi dữ liệu
                        </button>
                        <button type="button" class="btn btn-danger btn-sm pull-left" onclick="del_task_group()" id="del_row">
                            <i class="fa fa-trash"></i>
                            Xóa
                        </button>
                        <button type="button" class="btn btn-info btn-sm pull-left" onclick="cancel_task_group(0)" id="cancel_row">
                            <i class="fa fa-times"></i>
                            Hủy bỏ
                        </button>
                    </div>
                    <div class="col-xs-12 col-sm-12">
                        <div class="space-4"></div>
                    </div>
                    <div class="col-xs-12 col-sm-12">
                        <table id="list_task_group" 
                            class="table" 
                            role="grid"
                            aria-describedby="dynamic-table_info"></table>
                        <div id="task_group_pager"></div>
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

<script src="<?php echo URL.'/public/' ?>scripts/erp/index.js"></script>
<script src="<?php echo URL.'/public/' ?>scripts/erp/task_group.js"></script>