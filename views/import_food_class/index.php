<?php
$array_type_food = array("Cơm", "Món mặn", "Món xào", "Canh", "Tráng miệng");
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$array_food_current = $this->_Data->get_food_current_date(date("Y-m-d")); $array_food_current = explode(";", $array_food_current);
$array_food_main = $array_food_current[0]; $array_food_main = explode("$", $array_food_main); $array_food_main = $array_food_main[0];
$json_food_main = $this->_Data->get_info_food_by_array_id($array_food_main);
/*****************************************************************************************************************************************************/
$array_food_current = $this->_Data->get_food_current_date(date("Y-m-d")); $array_food_current = explode(";", $array_food_current);
$array_food_mg = $array_food_current[1]; $array_food_mg = explode("$", $array_food_mg); $array_food_mg = $array_food_mg[0];
$json_food_mg = $this->_Data->get_info_food_by_array_id($array_food_mg);
/*****************************************************************************************************************************************************/
$array_food_nt_sub = $array_food_current[2]; $array_food_nt_sub = explode("$", $array_food_nt_sub); $array_food_nt_sub = $array_food_nt_sub[0];
$json_food_nt_sub = $this->_Data->get_info_food_by_array_id($array_food_nt_sub);
/*****************************************************************************************************************************************************/
$array_food_nt_main = $array_food_current[3]; $array_food_nt_main = explode("$", $array_food_nt_main); $array_food_nt_main = $array_food_nt_main[0];
$json_food_nt_main = $this->_Data->get_info_food_by_array_id($array_food_nt_main);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(date("H") < 12){ // hien thi thuc don chinh
    $type_menu = 1;
    $json_food = $json_food_main;
}else{ // hien thi thuc don chieu
    $type_menu = 2;
    if($this->type_edu == 2){
        $json_food = $json_food_mg;
    }else{
        $json_food = array_merge($json_food_nt_sub, $json_food_nt_main);
    }
}
$disabled = ($this->_Data->get_data_food_imp($this->class_id, $type_menu, date('Y-m-d')) > 0) ? "disabled" : "";
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
                    <input type="hidden" name="type_food" id="type_food" value="<?php echo $type_menu ?>"/>
                    <input type="hidden" name="single" id="single" value=""/>
                    <input type="hidden" name="data_food" id="data_food" value=""/>
                    <input type="hidden" name="total_student" id="total_student" value="<?php echo $this->total_student ?>"/>
                    <table class="table css_imp_food" role="grid" aria-describedby="dynamic-table_info">
                        <tr>
                            <td class="text-center"><b>Tổng số học sinh</b></td>
                            <td class="text-center"><b><?php echo $this->total_student ?></b></td>
                            <td></td>
                        </tr>
                        <?php
                        foreach($json_food as $key => $value){
                            $value_share = $this->_Data->get_value_of_food($value['id'], $this->system_id, $value['type_id']);
                            $giatri = round($this->total_student*$value_share, 1);
                            $checked = ($this->_Data->get_data_food_imp_detail($this->class_id, $type_menu, date('Y-m-d'), $value['id'])[0]['status'] == 1) ? "checked" : "";
                        ?>
                        <tr>
                            <td>
                                <span><?php echo $array_type_food[$value['type_id']-1].'('.$value['type_id'].')' ?></span>
                                <span><b><?php echo $value['title'] ?></b></span>
                            </td>
                            <td class="text-center">
                                <span><b><?php echo $giatri ?></b><sub><?php echo $value['unit_title'] ?></sub></span>
                            </td>
                            <td class="text-center">
                                <input name="value_<?php echo $value['id'] ?>" type="checkbox" id="value_<?php echo $value['id'] ?>"
                                onclick="change_data_accept(<?php echo $value['id'] ?>)" value="<?php echo $giatri.'$'.$value['type_id'] ?>" <?php echo $checked.' '.$disabled ?>/>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                    <div class="col-xs-12 text-center">
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