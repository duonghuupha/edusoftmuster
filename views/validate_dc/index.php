<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li>Kiểm định</li>
                <li class="active">Văn bản quy định</li>
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
                    Văn bản quy định
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-3 col-sm-3">
                    <form id="fm" method="post" enctype="multipart/form-data">
                        <input id="file_old" name="file_old" type="hidden"/>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="form-field-username">Tên văn bản</label>
                                    <div>
                                        <input type="text" id="title" name="title" required=""
                                        placeholder="Tên văn bản" style="width:100%" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="form-field-username">Số văn bản</label>
                                    <div>
                                        <input type="text" id="number_dc" name="number_dc" required=""
                                        placeholder="Số văn bản" style="width:100%; text-transform:uppercase;"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="form-field-username">Ngày văn bản <small>(dd-mm-yyyy)</small></label>
                                    <div>
                                        <input type="text" id="date_dc" name="date_dc" required=""
                                        placeholder="Ngày văn bản" style="width:100%" class="input-mask-date"
                                        onkeypress="validate(event)"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="form-field-username">File văn bản</label>
                                    <div>
                                        <input type="file" id="file" name="file" class="file_attach" style="width:100%" required=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="form-field-username">Bao gồm mức độ kiểm định</label>
                                    <div>
                                        <select class="select2" data-placeholder="Lựa chọn mức độ kiểm định (s)"
                                        style="width:100%" required="" id="levels" name="levels[]" multiple=""
                                        data-minimum-results-for-search="Infinity">
                                            <option value="1">Mức độ 1</option>
                                            <option value="2">Mức độ 2</option>
                                            <option value="3">Mức độ 3</option>
                                            <option value="4">Mức độ 4</option>
                                            <option value="5">Mức độ 5</option>
                                            <option value="6">Mức độ 6</option>
                                        </select>
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
                <div class="col-xs-9 col-sm-9">
                    <table id="list_dc" 
                        class="table" 
                        role="grid"
                        aria-describedby="dynamic-table_info"></table>
                    <div id="dc_pager"></div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<script src="<?php echo URL.'/public/' ?>scripts/validate/dc.js"></script>