<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li>Kiểm định</li>
                <li class="active">Quản lý kỳ kiểm định</li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Quản lý kỳ kiểm định
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-6 col-sm-6">
                    <table id="list_period" 
                        class="table" 
                        role="grid"
                        aria-describedby="dynamic-table_info"></table>
                    <div id="period_pager"></div>
                </div><!-- /.col -->
                <div class="col-xs-6 col-sm-6">
                    <form id="fm" method="post">
                        <input id="datadc" name="datadc" type="hidden"/>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="form-field-username">Tiêu đề kỳ kiểm định</label>
                                    <div>
                                        <input type="text" id="title" name="title" required=""
                                        placeholder="Tiêu đề kỳ kiểm định" style="width:100%" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="col-xs-12 col-sm-12">
                                    <button type="button" class="btn btn-white btn-purple btn-sm pull-right" onclick="add_row()">
                                        <i class="fa fa-plus"></i>
                                        Thêm mới
                                    </button>
                                </div>
                                <div class="col-xs-12 col-sm-12">
                                    <div class="space-4"></div>
                                </div>
                                <div class="col-xs-12">
                                    <table class="table_modal">
                                        <colgroup style="width:90%;"></colgroup>
                                        <colgroup style="width:10%;"></colgroup>
                                        <thead>
                                            <tr>
                                                <th>Năm học</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12">
                                    <div class="space-4"></div>
                                </div>
                            <div class="col-xs-12 text-center">
                                <button class="btn btn-sm btn-danger" type="button" onclick="javascript:location.reload(true)">
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
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<script src="<?php echo URL.'/public/' ?>scripts/validate/period.js"></script>