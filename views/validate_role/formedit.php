<?php $item = $this->info; $stand = explode(",", $item[0]['stand_id']); $stand = array_filter($stand); $criteria = explode(",", $item[0]['criteria_id']); $criteria = array_filter($criteria); ?>
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li>Kiểm định</li>
                <li class="active">Phân quyền tiêu chuẩn / tiêu chí</li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Phân quyền tiêu chuẩn / tiêu chí :: <?php echo $item[0]['fullname'] ?>
                    <small class="pull-right">
                        <button class="btn btn-sm btn-danger" type="button" onclick="window.location.href='<?php echo URL.'/validate_role?token='.$_SESSION['data'][0]['token'] ?>'">
                            <i class="ace-icon fa fa-times"></i>
                            Hủy bỏ
                        </button>
                        <button class="btn btn-sm btn-primary" type="button" onclick="save(<?php echo $item[0]['id'] ?>)">
                            <i class="ace-icon fa fa-save"></i>
                            Ghi dữ liệu
                        </button>
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <form id="fm" method="post">
                        <input id="data_user" name="data_user" type="hidden" value="<?php echo base64_encode($item[0]['user_id']) ?>"/>
                        <input id="data_stand" name="data_stand" type="hidden" value="<?php echo base64_encode($item[0]['stand_id']) ?>"/>
                        <input id="data_cri" name="data_cri" type="hidden" value="<?php echo base64_encode($item[0]['criteria_id']) ?>"/>
                    </form>
                    <div class="row" id="h_left">
                    <?php
                    foreach($this->jsonObj as $row){
                    ?>
                    <div class="col-xs-4">
                        <div class="widget-box">
                            <div class="widget-header widget-header-flat">
                                <h4 class="widget-title" style="width:100%;float:left;">
                                    <input id="stand_id_<?php echo $row['id'] ?>" name="stand_id_<?php echo $row['id'] ?>" type="checkbox" onclick="check_main(<?php echo $row['id'] ?>)" value="<?php echo $row['id'] ?>"
                                    <?php echo (in_array($row['id'], $stand)) ? 'checked=""' : '' ?>/>
                                    <?php echo $row['title'] ?> 
                                </h4>
                                <small style="font-size:11px;width:100%;color:gray">
                                    <?php echo $row['content'] ?>
                                    <input id="stand_temp_<?php echo $row['id'] ?>" name="stand_temp_<?php echo $row['id'] ?>" type="hidden"/>
                                </small>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row">
                                        <div class="col-xs-12" id="name_user_class_<?php echo $row['id'] ?>">
                                            <ul class="list-unstyled spaced">
                                                <?php
                                                foreach($this->_Data->get_list_criteria($row['id']) as $item){
                                                    $checked = (in_array($item['id'], $criteria)) ? 'checked=""' : '';
                                                    echo '<li>';
                                                    echo '<input id="cri_id_'.$row['id'].'_'.$item['id'].'" name="cri_id_'.$row['id'].'_'.$item['id'].'" type="checkbox" data_role="stand_'.$row['id'].'_" onclick="check_sub('.$row['id'].', '.$item['id'].')" value="'.$item['id'].'" '.$checked.'/> ';
                                                        echo '<span data-rel="popover" data-trigger="hover" data-placement="right" data-content="'.$item['content'].'" title="" data-original-title="Nội dung">'.$item['title'].'</span>';
                                                    echo '</li>';
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<script src="<?php echo URL.'/public/' ?>scripts/validate/role/edit.js"></script>