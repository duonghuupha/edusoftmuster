<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="<?php echo URL.'/index?token='.$_SESSION['data'][0]['token'] ?>">Trang chủ</a>
                </li>
                <li class="active">Giao nhận  KPHS :: <?php echo date("d-m-Y") ?></li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content">
            <div class="row">
                <form id="fm" method="post" enctype="multipart/form-data">
                    <table class="table css_imp_food" role="grid" aria-describedby="dynamic-table_info">
                        <tr>
                            <td class="text-center"><b>Tổng số học sinh</b></td>
                            <td class="text-center"><b>33</b></td>
                            <td></td>
                        </tr>
                        <?php
                        for($i = 1; $i <= 5; $i++){
                        ?>
                        <tr>
                            <td>
                                <span>Cơm</span>
                                <span><b>Cơm gạo Bắc hương</b></span>
                            </td>
                            <td class="text-center">
                                <span><b>7</b><sub>kg</sub></span>
                            </td>
                            <td class="text-center">
                                <input name="form-field-checkbox" type="checkbox"/>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                    <div class="col-xs-12 text-center">
                        <canvas id="signaturePad" style="border:1px solid #ccc; touch-action:none; width:100%"></canvas>
                        <button type="button" class="btn btn-sm btn-danger" id="btn_save_import_food_class" onclick="clear_single()">
                            <i class="ace-icon fa fa-pencil bigger-110"></i>
                            Ký lại
                        </button>
                        <button type="button" class="btn btn-sm btn-success" id="btn_save_import_food_class">
                            <i class="ace-icon fa fa-save bigger-110"></i>
                            Lưu thông tin
                        </button>
                </form>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<script src="<?php echo URL.'/public/' ?>scripts/import_food_class/index.js"></script>