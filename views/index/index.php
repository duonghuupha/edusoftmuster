<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li class="active">Điểm danh học sinh :: <?php echo date("d-m-Y") ?></li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content">
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="ace-icon fa fa-graduation-cap"></i>
                        </span>
                        <input type="text" class="form-control search-query" placeholder="Nhập tên học sinh" onkeyup="search()"
                        id="key_student">
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
                    <table id="list_students" class="table" role="grid" aria-describedby="dynamic-table_info"></table>
                    <div id="students_pager"></div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<script src="<?php echo URL.'/public/' ?>scripts/muster/index.js"></script>