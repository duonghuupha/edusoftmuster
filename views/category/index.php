<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li class="active">Danh mục</li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Danh mục hệ thống
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Danh mục sử dụng chung trong hệ thống
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-12 col-sm-4 half">
                    <h3 class="header smaller lighter blue">
                        Chuyên môn
                        <a href="javascript:void(0)" class="btn-sm" title="Thêm mới" onclick="add_job()">
                            <i class="fa fa-plus"></i>
                        </a>
                    </h3>
                    <table id="list_job"></table>
                    <div id="job_pager"></div>
                </div><!-- /.col -->
                <div class="col-xs-12 col-sm-4 half">
                    <h3 class="header smaller lighter blue">
                        Trình độ
                        <a href="javascript:void(0)" class="btn-sm" title="Thêm mới" onclick="add_level()">
                            <i class="fa fa-plus"></i>
                        </a>
                    </h3>
                    <table id="list_level"></table>
                    <div id="level_pager"></div>
                </div><!-- /.col -->
                <div class="col-xs-12 col-sm-4 half">
                    <h3 class="header smaller lighter blue">
                        Phân công nhiệm vụ
                        <a href="javascript:void(0)" class="btn-sm" title="Thêm mới" onclick="add_regency()">
                            <i class="fa fa-plus"></i>
                        </a>
                    </h3>
                    <table id="list_regency"></table>
                    <div id="regency_pager"></div>
                </div><!-- /.col -->
                <div class="col-sm-12">
                    <div class="space-4"></div>
                </div>
                <div class="col-xs-12 col-sm-4 half">
                    <h3 class="header smaller lighter blue">
                        Quan hệ
                        <a href="javascript:void(0)" class="btn-sm" title="Thêm mới" onclick="add_relationship()">
                            <i class="fa fa-plus"></i>
                        </a>
                    </h3>
                    <table id="list_relationship"></table>
                    <div id="relationship_pager"></div>
                </div><!-- /.col -->
                <div class="col-xs-12 col-sm-4 half">
                    <h3 class="header smaller lighter blue">
                        Hệ đào tạo
                        <a href="javascript:void(0)" class="btn-sm" title="Thêm mới" onclick="add_system()">
                            <i class="fa fa-plus"></i>
                        </a>
                    </h3>
                    <table id="list_system"></table>
                    <div id="system_pager"></div>
                </div><!-- /.col -->
                <div class="col-xs-12 col-sm-4 half">
                    <h3 class="header smaller lighter blue">
                        Phòng "vật lý"
                        <a href="javascript:void(0)" class="btn-sm" title="Thêm mới" onclick="add_physical()">
                            <i class="fa fa-plus"></i>
                        </a>
                    </h3>
                    <table id="list_physical"></table>
                    <div id="physical_pager"></div>
                </div><!-- /.col -->
                <div class="col-sm-12">
                    <div class="space-4"></div>
                </div>
                <div class="col-xs-12 col-sm-4 half">
                    <h3 class="header smaller lighter blue">
                        Tỉnh / Thành phố
                        <a href="javascript:void(0)" class="btn-sm" title="Thêm mới" onclick="add_province()">
                            <i class="fa fa-plus"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn-sm" title="Import file" onclick="import_province()">
                            <i class="fa fa-upload"></i>
                        </a>
                    </h3>
                    <table id="list_province"></table>
                    <div id="province_pager"></div>
                </div><!-- /.col -->
                <div class="col-xs-12 col-sm-4 half">
                    <h3 class="header smaller lighter blue">
                        Quận / Huyện
                        <a href="javascript:void(0)" class="btn-sm" title="Thêm mới" onclick="add_district()">
                            <i class="fa fa-plus"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn-sm" title="Import file" onclick="import_district()">
                            <i class="fa fa-upload"></i>
                        </a>
                    </h3>
                    <table id="list_district"></table>
                    <div id="district_pager"></div>
                </div><!-- /.col -->
                <div class="col-xs-12 col-sm-4 half">
                    <h3 class="header smaller lighter blue">
                        Xã / Phường
                        <a href="javascript:void(0)" class="btn-sm" title="Thêm mới" onclick="add_commune()">
                            <i class="fa fa-plus"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn-sm" title="Import file" onclick="import_commune()">
                            <i class="fa fa-upload"></i>
                        </a>
                    </h3>
                    <table id="list_commune"></table>
                    <div id="commune_pager"></div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<div id="modal-form" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" id="form">
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End formm don vi tinh-->

<script src="<?php echo URL.'/public/' ?>scripts/category/job.js"></script>
<script src="<?php echo URL.'/public/' ?>scripts/category/level.js"></script>
<script src="<?php echo URL.'/public/' ?>scripts/category/regency.js"></script>
<script src="<?php echo URL.'/public/' ?>scripts/category/relationship.js"></script>
<script src="<?php echo URL.'/public/' ?>scripts/category/system.js"></script>
<script src="<?php echo URL.'/public/' ?>scripts/category/physical.js"></script>
<script src="<?php echo URL.'/public/' ?>scripts/category/province.js"></script>
<script src="<?php echo URL.'/public/' ?>scripts/category/district.js"></script>
<script src="<?php echo URL.'/public/' ?>scripts/category/commune.js"></script>