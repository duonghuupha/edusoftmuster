<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li class="">Học sinh</li>
                <li class="active">Xếp lớp</li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Xếp lớp / Chuyển lớp học sinh
                    <small class="pull-right">
                        <button type="button" class="btn btn-primary btn-sm" onclick="save()">
                            <i class="fa fa-save"></i>
                            Ghi dữ liệu
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="window.location.href='<?php echo URL.'/change_class?token='.$_SESSION['data'][0]['token'] ?>'">
                            <i class="fa fa-times"></i>
                            Hủy bỏ
                        </button>
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-6 col-sm-6">
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
                <div class="col-xs-6 col-sm-6">
                    <form id="fm" method="post">
                        <input id="student_id" name="student_id" type="hidden"/>
                        <input id="class_id_from" name="class_id_from" type="hidden"/>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="form-field-username">Họ và tên học sinh</label>
                                <div>
                                    <input type="text" id="fullname" name="fullname" placeholder="Họ tên học sinh" style="width:100%"
                                    readonly=""/>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="form-field-username">Lớp hiện tại</label>
                                <div>
                                    <select class="select2" data-placeholder="Lựa chọn lớp học" disabled=""
                                    style="width:100%" required="" id="class_from" name="class_from">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="form-field-username">Lớp muốn chuyển đến</label>
                                <div>
                                    <select class="select2" data-placeholder="Lựa chọn lớp học"
                                    style="width:100%" required="" id="class_to" name="class_to" onchange="check_dupli(this.value)">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="form-field-username">Lý do</label>
                                <div>
                                    <input type="text" id="content" name="content" placeholder="Lý do chuyển lớp" style="width:100%"
                                    required=""/>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="col-xs-12">
                        <table id="list_change_class" class="table" role="grid" aria-describedby="dynamic-table_info"></table>
                        <div id="change_class_pager"></div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<div id="modal-form" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width:50%">
        <div class="modal-content" id="form">
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script src="<?php echo URL.'/public/' ?>scripts/change_class/index.js"></script>