<?php
$array_type_food = array("Cơm", "Món mặn", "Món xào", "Canh", "Tráng miệng"); $tong = 0;
$disabled = ($this->_Data->get_data_food_imp($this->class_id, 1, date('Y-m-d')) > 0) ? "disabled" : "";
$canvas = ($this->_Data->get_data_food_imp($this->class_id, 1, date('Y-m-d')) > 0) ? 'signaturePad_disabled' : "signaturePad";
?>
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
                    <input type="hidden" name="type_food" id="type_food" value=""/>
                    <input type="hidden" name="single" id="single" value=""/>
                    <input type="hidden" name="data_food" id="data_food" value=""/>
                    <table class="table css_imp_food" role="grid" aria-describedby="dynamic-table_info">
                        <tr>
                            <td class="text-center"><b>Tổng số học sinh</b></td>
                            <td class="text-center"><b><?php echo $this->total_student ?></b></td>
                            <td></td>
                        </tr>
                        <?php
                        foreach($this->json_food as $key => $value){
                            $value_share = $this->_Data->get_value_share_food($value['food_id'], $this->system_id, $value['type_food']);
                            $giatri = round($this->total_student*$value_share, 1);
                            $checked = ($this->_Data->get_data_food_imp_detail($this->class_id, 1, date('Y-m-d'), $value['food_id'])[0]['status'] == 1) ? "checked" : "";
                        ?>
                        <tr>
                            <td>
                                <span><?php echo $array_type_food[$value['type_food']-1] ?></span>
                                <span><b><?php echo $value['title_food'] ?></b></span>
                            </td>
                            <td class="text-center">
                                <span><b><?php echo $giatri ?></b><sub><?php echo $value['unit_title'] ?></sub></span>
                            </td>
                            <td class="text-center">
                                <input name="value_<?php echo $value['food_id'] ?>" type="checkbox" id="value_<?php echo $value['food_id'] ?>"
                                onclick="change_data_accept(<?php echo $value['food_id'] ?>)" value="<?php echo $giatri ?>" <?php echo $checked.' '.$disabled ?>/>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                    <div class="col-xs-12 text-center">
                        <canvas id="<?php echo $canvas ?>" style="border:1px solid #ccc; touch-action:none; width:100%"></canvas>
                        <button type="button" class="btn btn-sm btn-danger" id="btn_save_import_food_class" onclick="clear_single()" <?php echo $disabled ?>>
                            <i class="ace-icon fa fa-pencil bigger-110"></i>
                            Ký lại
                        </button>
                        <button type="button" class="btn btn-sm btn-success" id="btn_save_import_food_class"onclick="save()" <?php echo $disabled ?>>
                            <i class="ace-icon fa fa-save bigger-110"></i>
                            Lưu thông tin
                        </button>
                </form>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<script src="<?php echo URL.'/public/' ?>scripts/import_food_class/index.js"></script>