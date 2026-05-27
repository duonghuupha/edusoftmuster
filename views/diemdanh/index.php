<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="<?php echo URL.'/index?token='.$_SESSION['data'][0]['token'] ?>">Trang chủ</a>
                </li>
                <li class="active">Điểm danh học sinh :: module dành riêng cho Admin</li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content">
            <div class="row">
                <div class="col-xs-5">
                     <div class="form-group">
                        <label for="class_id">Chọn lớp:</label>
                        <select id="class_id" name="class_id" class="form-control">
                            <option value="">-- Chọn lớp --</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-5">
                    <div class="form-group">
                        <label for="form-field-username">Lựa chọn ngày điểm danh</label>
                        <div class="input-group">
                            <input class="form-control date-picker" id="ngaydiemdanh" type="text" data-date-format="dd-mm-yyyy"
                            name="ngaydiemdanh"/>
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="form-group">
                        <label for="form-field-username">&nbsp;</label>
                        <button class="btn btn-sm btn-primary btn-block" id="search" type="button" onclick="search()">
                            <i class="ace-icon fa fa-search bigger-110"></i>
                            Tìm kiếm
                        </button>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12">
                    <table id="list_students" class="table" role="grid" aria-describedby="dynamic-table_info"></table>
                    <div id="students_pager"></div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<script src="<?php echo URL.'/public/' ?>scripts/diemdanh/index.js"></script>