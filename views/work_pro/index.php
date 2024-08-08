<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li>Hố sơ công việc</li>
                <li class="active">Quản lý hồ sơ</li>
            </ul><!-- /.breadcrumb -->
            <div class="nav-search" id="nav-search">
                <form class="form-search">
                    <span class="input-icon">
                        <input type="text" placeholder="Tìm kiếm ..." class="nav-search-input" id="search_work_pro"
                        onkeyup="search()"/>
                        <i class="ace-icon fa fa-search nav-search-icon"></i>
                    </span>
                </form>
            </div><!-- /.nav-search -->
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Quản lý hờ sơ công việc
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
                    <table id="list_work_pro" 
                        class="table" 
                        role="grid"
                        aria-describedby="dynamic-table_info"></table>
                    <div id="work_pro_pager"></div>
                </div><!-- /.col -->
                <div class="col-xs-5 col-sm-5">
                    <table id="list_work_dt" 
                        class="table" 
                        role="grid"
                        aria-describedby="dynamic-table_info"></table>
                    <div id="work_dt_pager"></div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<!--Form don vi tinh-->
<div id="modal-work" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    Thêm mới - Cập nhật thông tin hồ sơ công việc
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="fm" method="POST" enctype="multipart/form-data">
                        <input id="data_user_share" name="data_user_share" type="hidden"/>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="form-field-username">
                                    Mã hồ sơ &nbsp;
                                    <a href="javascript:void(0)"  onclick="refresh_code()"><i class="ace-icon fa fa-refresh"></i></a>
                                </label>
                                <div>
                                    <input type="text" id="code" name="code" required=""readonly=""
                                        placeholder="Mã hồ sơ" style="width:100%"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="form-field-username">Lựa chọn danh mục</label>
                                <div>
                                    <select class="select2" data-placeholder="Lựa chọn danh mục"
                                    style="width:100%" required="" id="cate_id" name="cate_id">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="form-field-username">Tên hồ sơ</label>
                                <div>
                                    <input class="form-control" id="title" type="text" 
                                    name="title" required="" placeholder="Tên hồ sơ"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="form-field-username">Mô tả hồ sơ</label>
                                <div>
                                    <textarea class="form-control" id="content" type="text" style="width:100%;height: 150px;resize:none"
                                    name="content" required="" placeholder="Mô tả nội dung hồ sơ"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="form-field-username">
                                    Chia sẻ
                                    &nbsp;
                                    <a class="red" href="javascript:void(0)" onclick="del_user_share()" title="Xóa người chia sẻ">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="total_user_share" name="total_user_share"
                                    placeholder="Click Go! để lựa chọn" style="width:100%;" readonly=""/>
                                    <span class="input-group-btn">
                                        <button class="btn btn-sm btn-primary" type="button" onclick="select_user()"
                                        id="select_users">
                                            <i class="ace-icon fa fa-users bigger-110"></i>
                                            Go!
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label style="display:flex">
                                    Công khai
                                    <input name="is_publish" id="is_publish" class="ace ace-switch ace-switch-7" type="checkbox">
                                    <span class="lbl" style="margin: -2px 4px"></span>
                                </label>
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
<div id="modal-users" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width:55%">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <span class="white">×</span>
                    </button>
                    Danh sách người dùng
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <input class="form-control" id="nav-search-input-user" type="text" style="width:100%"
                        placeholder="Tìm kiếm" onkeyup="search_user()"/>
                    </div>
                    <div class="col-xs-12">
                        <div class="space-6"></div>
                    </div>
                    <div class="col-xs-12 col-sm-12">
                        <table id="list_user" 
                            class="table" 
                            role="grid"
                            aria-describedby="dynamic-table_info"></table>
                        <div id="user_pager"></div>
                    </div><!-- /.col -->
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End formm don vi tinh-->

<!--Form don vi tinh-->
<div id="modal-dt" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    Thêm mới - Cập nhật dữ liệu hồ sở công việc
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="fm-dt" method="POST" enctype="multipart/form-data">
                        <input id="file_old" name="file_old" type="hidden"/>
                        <div class="col-xs-4">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="form-field-username">
                                        Danh mục hồ sơ
                                    </label>
                                    <div id="title_cate">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="form-field-username">
                                        Tên hồ sơ
                                    </label>
                                    <div id="title_work">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-8" style="border-left: 1px solid #307ECC">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="form-field-username">
                                        Tên file dữ liệu
                                    </label>
                                    <div>
                                        <input type="text" id="title_dt" name="title" required=""
                                        placeholder="Tên file dữ liệu" style="width:100%;" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="form-field-username">Tệp dữ liệu</label>
                                    <div>
                                        <input type="file" id="file" name="file" class="file_attach" style="width:100%"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12" id="tep_du_lieu_cu">
                                <div class="form-group">
                                    <label for="form-field-username">Tệp dữ liệu cũ</label>
                                    <div id="tep_cu">
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

<script src="<?php echo URL.'/public/' ?>scripts/work_pro/work_pro.js"></script>