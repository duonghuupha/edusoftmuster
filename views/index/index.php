<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li class="active">Bảng điều khiển</li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Bàn làm việc
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Tổng quan - Thống kê hệ thống
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div id="block_one"></div>
                        <div class="vspace-12-sm"></div>
                        <div id="block_two"></div>
                    </div><!-- /.row -->
                    <div class="hr hr32 hr-dotted"></div>
                    <div class="row">
                        <div id="block_three"></div>
                        <div id="block_four"></div>
                    </div><!-- /.row-->
                    <div class="hr hr32 hr-dotted"></div>
                    <div class="row">
                        <div class="col-sm-6 col-xs-4">
                            <div class="widget-box transparent">
                                <div class="widget-header widget-header-flat">
                                    <h4 class="widget-title lighter">
                                        <i class="ace-icon fa fa-tasks orange"></i>
                                        Công việc cần xử lý trong ngày
                                    </h4>
                                </div>
                                <div class="widget-body" style="min-height:200px;">
                                    <div class="widget-main no-padding" id="block_five">
                                    </div><!-- /.widget-main -->
                                </div><!-- /.widget-body -->
                            </div><!-- /.widget-box -->
                        </div><!-- /.col -->
                        <div class="col-sm-6 col-xs-4">
                            <div class="widget-box transparent">
                                <div class="widget-header widget-header-flat">
                                    <h4 class="widget-title lighter">
                                        <i class="ace-icon fa fa-briefcase orange"></i>
                                        Hồ sơ công việc
                                        <small class="pull-right">
                                            <button type="button" class="btn btn-primary btn-sm" onclick="window.location.href='<?php echo URL.'/work_pro?token='.$_SESSION['data'][0]['token'] ?>'">
                                                <i class="fa fa-plus"></i>
                                                Xem thêm
                                            </button>
                                        </small>
                                    </h4>
                                </div>
                                <div class="widget-body" style="min-height:200px;">
                                    <div class="widget-main no-padding">
                                        <table id="block_six" 
                                            class="table" 
                                            role="grid"
                                            aria-describedby="dynamic-table_info"></table>
                                        <div id="block_six_pager"></div>
                                    </div><!-- /.widget-main -->
                                </div><!-- /.widget-body -->
                            </div><!-- /.widget-box -->
                        </div><!-- /.col -->
                    </div><!-- /.row-->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<script src="<?php echo URL.'/public/' ?>scripts/index.js"></script>