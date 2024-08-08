<?php
$item = $this->jsonObj;
?>
<div class="modal-header no-padding">
    <div class="table-header">
        Thông tin học sinh
    </div>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-xs-12">
            <div>
                <div id="user-profile-1" class="user-profile row">
                    <div class="col-xs-12 col-sm-3 center">
                        <div>
                            <span class="profile-picture">
                                <?php
                                if($item[0]['image'] != ''){ 
                                ?>
                                <img id="avatar" class="editable img-responsive" alt="<?php echo $item[0]['fullname'] ?>" 
                                src="<?php echo URL.'/public/students/images/'.$item[0] ['image']?>" />
                                <?php 
                                }else{
                                ?>
                                <img id="avatar" class="editable img-responsive" alt="<?php echo $item[0]['fullname'] ?>" 
                                src="<?php echo URL ?>/public/images/no_img_per.png" />
                                <?php
                                }
                                ?>
                            </span>
                            <div class="space-4"></div>
                            <div class="width-100 label label-info label-xlg">
                                <div class="inline position-relative">
                                    <a href="javascript:void(0)" class="user-title-label">
                                        <span class="white"><?php echo $item[0]['fullname'] ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="space-6"></div>

                        <div class="profile-contact-info">
                            <div class="profile-contact-links align-left">
                                <a href="javscript:void(0)" class="btn btn-link">
                                    <i class="ace-icon fa fa-globe bigger-125 blue"></i>
                                    <?php echo $item[0]['code'] ?>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-link">
                                    <i class="ace-icon fa fa-calendar bigger-120 green"></i>
                                    <?php echo date("d-m-Y", strtotime($item[0]['birthday'])) ?>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-link">
                                    <i class="ace-icon fa fa-envelope bigger-120 pink"></i>
                                    <?php echo ($item[0]['gender'] == 1) ? "Nam" : "Nữ" ?>
                                </a>
                            </div>
                        </div>
                        <div class="hr hr16 dotted"></div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                        <div class="profile-user-info profile-user-info-striped">
                            <div class="profile-info-row">
                                <div class="profile-info-name"> Mã định danh </div>
                                <div class="profile-info-value">
                                    <span class="editable" id="username"><?php echo $item[0]['identifier'] ?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> Tên thường gọi </div>
                                <div class="profile-info-value">
                                    <span class="editable" id="country"><?php echo $item[0]['nickname'] ?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> Qr Code </div>
                                <div class="profile-info-value">
                                    <span class="editable" id="qrcode_stu">
                                        
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="space-10"></div>
                        <div class="widget-box transparent">
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="active">
                                    <a data-toggle="tab" href="#add">
                                        <i class="green ace-icon fa fa-map-marker bigger-120"></i>
                                        Địa chỉ
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#relation">
                                        <i class="blue ace-icon fa fa-group bigger-120"></i>
                                        Quan hệ
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#class_room">
                                        <i class="orange ace-icon fa fa-graduation-cap bigger-120"></i>
                                        Lớp học
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div id="add" class="tab-pane fade in active" style="padding:8px;height: 200px; overflow:auto">
                                    <ul class="list-unstyled spaced2">
                                        <?php
                                        foreach($this->add as $row_add){
                                            echo '
                                            <li>
                                                <i class="ace-icon fa fa-circle green"></i>
                                                '.$row_add['address'].'
                                            </li>
                                            ';
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div id="relation" class="tab-pane fade" style="padding:8px;height: 200px; overflow:auto">
                                    <ul class="list-unstyled spaced2">
                                        <?php
                                        foreach($this->relation as $row_relation){
                                            echo '
                                            <li>
                                                <i class="ace-icon fa fa-circle green"></i>
                                                '.$row_relation['relation'].' - '.$row_relation['fullname'].' - '.$row_relation['phone'].' - '.$row_relation['job'].'
                                            </li>
                                            ';
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div id="class_room" class="tab-pane fade" style="padding:8px;height: 200px; overflow:auto">
                                    <div class="col-xs-6" style="height:100%; border-right: 1px solid #307ECC">
                                        <h6 style="font-weight:700;color:#3A87AD">Lên lớp</h6>
                                        <ul class="list-unstyled spaced2">
                                            <?php
                                            foreach($this->class_stu as $row_class_stu){
                                                echo '
                                                <li>
                                                    <i class="ace-icon fa fa-circle green"></i>
                                                    '.$row_class_stu['nam_hoc'].' - '.$row_class_stu['lop_hoc'].'
                                                </li>
                                                ';
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                    <div class="col-xs-6">
                                        <h6 style="font-weight:700;color:#3A87AD">Chuyển lớp</h6>
                                        <ul class="list-unstyled spaced2">
                                            <?php
                                            foreach($this->class_change as $row_class_change){
                                                echo '
                                                <li>
                                                    <i class="ace-icon fa fa-circle green"></i>
                                                    Ngày '.date("d-m-Y",  strtotime($row_class_change['date_approve'])).' của '.$row_class_change['tu_nam'].' chuyển từ '.$row_class_change['lop_di'].'
                                                    đến '.$row_class_change['lop_den'].' của '.$row_class_change['den_nam'].' với lý do "'.$row_class_change['content'].'"
                                                </li>
                                                ';
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
        <i class="ace-icon fa fa-times"></i>
        Đóng
    </button>
</div>