<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li class="">Công việc</li>
                <li class="active">Lịch công tác</li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Lịch công tác
                    <small class="pull-right">
                        <div>
                            <select class="select2" data-placeholder="Lựa chọn tuần" id="week" name="week" 
                            style="width:100px;" data-minimum-results-for-search="Infinity" onchange="search()">
                            <?php
                            $total_week = date("W", mktime(0, 0, 0, 12, 28, date("Y")));
                            for($i_week = 1; $i_week <= $total_week; $i_week++){
                                $select_week = ($i_week == date("W")) ? 'selected=""' : '';
                                echo '<option value="'.$i_week.'" '.$select_week.'>Tuần '.$i_week.'</option>';
                            }
                            ?>
                            </select>
                            <select class="select2" data-placeholder="Lựa chọn năm" id="year" name="year" 
                            style="width:100px;" data-minimum-results-for-search="Infinity" onchange="search()">
                            <?php
                            for($i_year = 2023; $i_year <= 2050; $i_year++){
                                $select_year = ($i_year == date("Y")) ? 'selected=""' : '';
                                echo '<option value="'.$i_year.'" '.$select_year.'>Năm '.$i_year.'</option>';
                            }
                            ?>
                            </select>
                            <!--<button type="button" class="btn btn-success btn-sm" onclick="search()">
                                <i class="fa fa-search"></i>
                                Hiển thị
                            </button>-->
                            <button type="button" class="btn btn-primary btn-sm" onclick="export_pdf()">
                                <i class="fa fa-cloud-download"></i>
                                Xuất dữ liệu
                            </button>
                        </div>
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-3 col-sm-3">
                    <div class="form-group">
                        <div>
                            <select class="select2" data-placeholder="Lựa chọn người dùng" style="width:100%" required="" 
                            id="user_id" name="user_id" onchange="set_data()"></select>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="space-2"></div>
                    </div>
                    <div id="list_per_dc"></div>
                </div><!-- /.col -->
                <div class="col-xs-9 col-sm-9">
                    <div class="col-xs-12" id="calendar_week"></div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<script src="<?php echo URL.'/public/' ?>scripts/erp/calendar.js"></script>