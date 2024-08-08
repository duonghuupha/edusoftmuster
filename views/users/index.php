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
            <div class="nav-search" id="nav-search">
                <form class="form-search">
                    <span class="input-icon">
                        <input type="text" placeholder="Tìm kiếm ..." class="nav-search-input" id="search_users"
                        onkeyup="search()"/>
                        <i class="ace-icon fa fa-search nav-search-icon"></i>
                    </span>
                </form>
            </div><!-- /.nav-search -->
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Quản lý người dùng
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-8 col-sm-8">
                    <table id="list_users" 
                        class="table" 
                        role="grid"
                        aria-describedby="dynamic-table_info"></table>
                    <div id="users_pager"></div>
                </div><!-- /.col -->
                <div class="col-xs-4 col-sm-4">
                    <form id="fm" method="post">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="form-field-username">Lựa chọn nhân sự</label>
                                    <div>
                                        <select class="select2" data-placeholder="Lựa chọn nhân sự"
                                        style="width:100%;height:30px;" required="" id="personnel_id" name="personnel_id"
                                        onchange="set_username()">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="form-field-username">Tên đăng nhập</label>
                                    <div>
                                        <input type="text" id="username" name="username" required=""
                                        placeholder="Tên đăng nhập" style="width:100%" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="form-field-username">Mật khẩu</label>
                                    <div>
                                        <input type="password" id="password" name="password" required=""
                                        placeholder="Mật khẩu" style="width:100%" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="form-field-username">Xác nhận mật khẩu</label>
                                    <div>
                                        <input type="password" id="re_pass" name="re_pass" required=""
                                        placeholder="Xác nhận mật khẩu" style="width:100%" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="form-field-username">Lựa chọn quyền sử dụng</label>
                                    <div>
                                        <select class="select2" data-placeholder="Lựa chọn quyền sử dụng"
                                        required="" style="width:100%;height:30px;" id="group_role_id"
                                        name="group_role_id"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 text-center">
                                <button class="btn btn-sm btn-danger" type="button" onclick="location.reload()">
                                    <i class="ace-icon fa fa-times"></i>
                                    Hủy bỏ
                                </button>
                                <button class="btn btn-sm btn-primary" type="button" onclick="save()">
                                    <i class="ace-icon fa fa-save"></i>
                                    Ghi dữ liệu
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<script src="<?php echo URL.'/public/' ?>scripts/users/index.js"></script>