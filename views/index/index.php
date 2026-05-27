<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="<?php echo URL.'/index?token='.$_SESSION['data'][0]['token'] ?>">Trang chủ</a>
                </li>
                <li class="active">Điểm danh học sinh</li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content">
            <div class="row">
                <div class="col-xs-6">
                    <div class="form-group">
                        <label for="form-field-username">Từ ngày</label>
                        <div class="input-group">
                            <input class="form-control date-picker" id="date_from" type="text" data-date-format="dd-mm-yyyy"
                            name="date_from"/>
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label for="form-field-username">Lựa chọn lớp học</label>
                        <div>
                            <select class="select2" data-placeholder="Lựa chọn lớp học"
                            style="width:100%" required="" id="class_id" name="class_id">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12">
                    <div class="col-xs-12">
                        <div class="space-2" id="search_student"></div>
                    </div>
                    <table id="list_students" class="table" role="grid" aria-describedby="dynamic-table_info"></table>
                    <div id="students_pager"></div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<script src="<?php echo URL.'/public/' ?>scripts/muster/index.js"></script>