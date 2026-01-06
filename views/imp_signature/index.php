<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="<?php echo URL.'/index?token='.$_SESSION['data'][0]['token'] ?>">Trang chủ</a>
                </li>
                <li class="active">Cấu hình chữ ký giáo viên</li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content">
            <div class="row">
                <form id="fm" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="single" id="single" value=""/>
                    <input type="hidden" name="id_per" id="id_per" value=""/>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="form-field-username">Lựa chọn nhân sự</label>
                            <div>
                                <select class="select2" data-placeholder="Lựa chọn nhân sự"
                                style="width:100%" required="" id="personnel_id" name="personnel_id">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 text-center" id="signature_old">

                    </div>
                    <div class="col-xs-12 text-center">
                        <canvas id="signaturePad" style="border:1px solid #ccc; touch-action:none; width:100%"></canvas>
                        <button type="button" class="btn btn-sm btn-danger" id="btn_save_import_food_class" onclick="clear_single()">
                            <i class="ace-icon fa fa-pencil bigger-110"></i>
                            Ký lại
                        </button>
                        <button type="button" class="btn btn-sm btn-success" id="btn_save_import_food_class"onclick="save()">
                            <i class="ace-icon fa fa-save bigger-110"></i>
                            Lưu thông tin
                        </button>
                </form>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<script src="<?php echo URL.'/public/' ?>scripts/imp_signature/index.js"></script>