<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li class="active">Quản lý người dùng</li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Quản lý người dùng
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-6 col-sm-6">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control search-query" placeholder="Nhập tên người dùng" onkeyup="search()"
                        id="key_users">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-purple btn-sm" onclick="search()">
                                <span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
                                Tìm kiếm
                            </button>
                        </span>
                    </div>
                    <div class="col-xs-12">
                        <div class="space-2" id="search_student"></div>
                    </div>
                    <table id="list_users" 
                        class="table" 
                        role="grid"
                        aria-describedby="dynamic-table_info"></table>
                    <div id="users_pager"></div>
                </div><!-- /.col -->
                <div class="col-xs-6 col-sm-6">
                    <form id="fm" method="post">
                        <input id="data_dc" name="data_dc" type="hidden"/>
                        <div class="row">
                            <div class="col-xs-9">
                                <div class="form-group">
                                    <label for="form-field-username">Lựa chọn nhóm quyền sử dụng</label>
                                    <div>
                                        <select class="select2" data-placeholder="Lựa chọn nhóm quyền sử dụng"
                                        style="width:100%;height:30px;" required="" id="group_role_id" name="group_role_id">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label for="form-field-username">&nbsp;</label>
                                    <div>
                                        <button class="btn btn-sm btn-primary" type="button" onclick="save()">
                                            <i class="ace-icon fa fa-save"></i>
                                            Ghi dữ liệu
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <table id="list_users_dc" 
                                    class="table" 
                                    role="grid"
                                    aria-describedby="dynamic-table_info"></table>
                                <div id="users_dc_pager"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<script src="<?php echo URL.'/public/' ?>scripts/users/decentral.js"></script>