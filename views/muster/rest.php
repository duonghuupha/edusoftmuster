<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li>Học sinh</li>
                <li class="active">Điểm danh - Báo ăn</li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Điểm danh học sinh nghỉ :: Ngày <?php echo date("d-m-Y") ?>
                    <small class="pull-right">
                        <button type="button" class="btn btn-success btn-sm" onclick="window.location.href='<?php echo URL.'/muster?token='.$_SESSION['data'][0]['token'] ?>'">
                            <i class="fa fa-check"></i>
                            Điểm danh có
                        </button>
                        <button type="button" class="btn btn-primary btn-sm" onclick="save()">
                            <i class="fa fa-save"></i>
                            Ghi dữ liệu
                        </button>
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-6 col-sm-6">
                    <table id="list_students" class="table" role="grid" aria-describedby="dynamic-table_info"></table>
                    <div id="students_pager"></div>
                </div><!-- /.col -->
                <div class="col-xs-6 col-sm-6">
                    <table id="list_students_dc" class="table" role="grid" aria-describedby="dynamic-table_info"></table>
                    <div id="students_dc_pager"></div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<script src="<?php echo URL.'/public/' ?>scripts/students/rest.js"></script>