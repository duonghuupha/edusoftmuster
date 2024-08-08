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
                    Phân quyền tiêu chuẩn / tiêu chí
                    <small class="pull-right">
                        <button class="btn btn-sm btn-danger" type="button" onclick="window.location.href='<?php echo URL.'/validate_role?token='.$_SESSION['data'][0]['token'] ?>'">
                            <i class="ace-icon fa fa-times"></i>
                            Hủy bỏ
                        </button>
                        <button class="btn btn-sm btn-primary" type="button" onclick="save()">
                            <i class="ace-icon fa fa-save"></i>
                            Ghi dữ liệu
                        </button>
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-3 col-sm-3">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="ace-icon fa fa-users"></i>
                        </span>
                        <input type="text" class="form-control search-query" placeholder="Nhập tên người dùng" onkeyup="search()"
                        id="key_user">
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
                    <table id="list_user" 
                        class="table" 
                        role="grid"
                        aria-describedby="dynamic-table_info"></table>
                    <div id="user_pager"></div>
                </div>
                <div class="col-xs-9 col-sm-9">
                    <form id="fm" method="post">
                        <input id="data_user" name="data_user" type="hidden"/>
                        <input id="data_stand" name="data_stand" type="hidden"/>
                        <input id="data_cri" name="data_cri" type="hidden"/>
                    </form>
                    <div class="row" id="h_left">
                    <?php
                    foreach($this->jsonObj as $row){
                    ?>
                    <div class="col-xs-4">
                        <div class="widget-box">
                            <div class="widget-header widget-header-flat">
                                <h4 class="widget-title" style="width:100%;float:left;">
                                    <input id="stand_id_<?php echo $row['id'] ?>" name="stand_id_<?php echo $row['id'] ?>" type="checkbox" onclick="check_main(<?php echo $row['id'] ?>)" value="<?php echo $row['id'] ?>"/>
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
                                                    echo '<li>';
                                                    echo '<input id="cri_id_'.$row['id'].'_'.$item['id'].'" name="cri_id_'.$row['id'].'_'.$item['id'].'" type="checkbox" data_role="stand_'.$row['id'].'_" onclick="check_sub('.$row['id'].', '.$item['id'].')" value="'.$item['id'].'"/> ';
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

<script src="<?php echo URL.'/public/' ?>scripts/validate/role/add.js"></script>