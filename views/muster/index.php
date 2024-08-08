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
                    Điểm danh :: Ngày <?php echo date("d-m-Y") ?>
                    <small class="pull-right">
                        <!--
                        <button type="button" class="btn btn-success btn-sm" onclick="window.location.href='<?php echo URL.'/muster?token='.$_SESSION['data'][0]['token'] ?>'">
                            <i class="fa fa-check"></i>
                            Điểm danh có
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="window.location.href='<?php echo URL.'/muster/rest?token='.$_SESSION['data'][0]['token'] ?>'">
                            <i class="fa fa-check"></i>
                            Điểm danh nghỉ
                        </button>
                        -->
                        <button type="button" class="btn btn-success btn-sm" onclick="syns_food()">
                            <i class="fa fa-refresh"></i>
                            Đồng bộ dữ liệu báo ăn
                        </button>
                        <button type="button" class="btn btn-primary btn-sm" onclick="order_food()">
                            <i class="fa fa-cutlery"></i>
                            Báo ăn
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

<!--Form don vi tinh-->
<div id="modal-time-food" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width:50%">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    BÁO ĂN NGÀY <?php echo date("d-m-Y") ?>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="fm-time-food" method="POST" enctype="multipart/form-data">
                        <div class="col-xs-4" style="border-right:1px solid #307ECC">
                            <div class="col-xs-12">
                                <div class="form-group text-center">
                                    <label for="form-field-username" class="text-center" style="font-weight:700;font-size:25px;">
                                        Số lượng ăn chính
                                    </label>
                                    <div class="text-center">
                                        <input type="text" id="an_chinh" name="an_chinh" style="width:100px;height:100px;border-radius:10px !important;font-size:50px;text-align:center" 
                                        required="" onkeypress="validate(event)"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group text-center">
                                    <label for="form-field-username" class="text-center" style="font-weight:700;font-size:25px;">
                                        Số lượng ăn sáng
                                    </label>
                                    <div class="text-center">
                                        <input type="text" id="an_sang" name="an_sang" style="width:100px;height:100px;border-radius:10px !important;font-size:50px;text-align:center" 
                                        required="" onkeypress="validate(event)"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-8">
                            <div class="page-header">
                                <h1 style="font-size:14px;">Lịch sử báo ăn</h1>
                            </div>
                            <div id="history" style="height:300px;overflow:auto">

                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    Đóng
                </button>
                <button class="btn btn-sm btn-primary pull-right" onclick="save_time_food()">
                    <i class="ace-icon fa fa-save"></i>
                    Ghi dữ liệu
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End formm don vi tinh-->

<script src="<?php echo URL.'/public/' ?>scripts/students/muster.js"></script>