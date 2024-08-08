<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li class="">Kiểm định</li>
                <li class="active">Dnah mục tiêu chuẩn / tiêu chí</li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content">
            <div class="row">
                <div class="col-xs-12 col-sm-6 half">
                    <h3 class="header smaller lighter blue">
                        Tiêu chuẩn
                    </h3>
                    <div class="col-xs-12 col-sm-12">
                        <form id="fm-standard" method="post">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="form-field-username">Lựa chọn văn bản quy định</label>
                                        <div>
                                            <select class="select2" data-placeholder="Lựa chọn văn bản quy định"
                                            required="" style="width:100%;height:30px;" id="dc_id" name="dc_id"></select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="form-field-username">Tên tiêu chuẩn</label>
                                        <div>
                                            <input type="text" id="title_standard" name="title_standard" required=""
                                            placeholder="Tên tiêu chuẩn kiểm định" style="width:100%" />
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-xs-8">
                                    <div class="form-group">
                                        <label for="form-field-username">Nội dung tiêu chuẩn</label>
                                        <div>
                                            <input type="text" id="content_standard" name="content_standard" required=""
                                            placeholder="Nội dung tiêu chuẩn kiểm định" style="width:100%" />
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
                                    <button class="btn btn-sm btn-primary" type="button" onclick="save_standard()">
                                        <i class="ace-icon fa fa-save"></i>
                                        Ghi dữ liệu
                                    </button>
                                </div>
                            </div>
                        </form>
                        <hr/>
                        <table id="list_standard"></table>
                        <div id="standard_pager"></div>
                    </div>
                </div><!-- /.col -->
                <div class="col-xs-12 col-sm-6 half">
                    <h3 class="header smaller lighter blue">
                        Tiêu chí
                    </h3>
                    <div class="col-xs-12 col-sm-12">
                        <form id="fm-criteria" method="post">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="form-field-username">Lựa chọn tiêu chuẩn</label>
                                        <div>
                                            <select class="select2" data-placeholder="Lựa chọn tiêu chuẩn"
                                            required="" style="width:100%;height:30px;" id="stand_id" name="stand_id"></select>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="form-field-username">Tên tiêu chí</label>
                                        <div>
                                            <input type="text" id="title_criteria" name="title_criteria" required=""
                                            placeholder="Tên chí chuẩn kiểm định" style="width:100%" />
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="form-field-username">Nội dung tiêu chí</label>
                                        <div>
                                            <input type="text" id="content_criteria" name="content_criteria" required=""
                                            placeholder="Nội dung tiêu chí kiểm định" style="width:100%" />
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
                                    <button class="btn btn-sm btn-primary" type="button" onclick="save_criteria()">
                                        <i class="ace-icon fa fa-save"></i>
                                        Ghi dữ liệu
                                    </button>
                                </div>
                            </div>
                        </form>
                        <hr/>
                        <table id="list_criteria"></table>
                        <div id="criteria_pager"></div>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->


<script src="<?php echo URL.'/public/' ?>scripts/validate/cate.js"></script>