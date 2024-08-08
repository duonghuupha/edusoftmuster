<?php
$item = $this->jsonObj;
?>
<div class="modal-header no-padding">
    <div class="table-header">
        Thông tin nhân sự
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
                                src="<?php echo URL.'/public/personnel/avatar/'.$item[0] ['image']?>" />
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
                                    <?php echo $item[0]['birthday'] ?>
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
                                <div class="profile-info-name"> Điện thoại </div>
                                <div class="profile-info-value">
                                    <span class="editable" id="username"><?php echo $item[0]['phone'] ?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> Địa chỉ </div>
                                <div class="profile-info-value">
                                    <i class="fa fa-map-marker light-orange bigger-110"></i>
                                    <span class="editable" id="country"><?php echo $item[0]['address'] ?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> Email </div>
                                <div class="profile-info-value">
                                    <span class="editable" id="username"><?php echo $item[0]['email'] ?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> Trình độ </div>
                                <div class="profile-info-value">
                                    <span class="editable" id="age"><?php echo $item[0]['level_title'] ?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> Nhiệm vụ </div>
                                <div class="profile-info-value">
                                    <span class="editable" id="signup"><?php echo $item[0]['regency_title'] ?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> Chuyên môn </div>
                                <div class="profile-info-value">
                                    <span class="editable" id="signup"><?php echo $item[0]['job_title'] ?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> Qr Code </div>
                                <div class="profile-info-value">
                                    <span class="editable" id="qrcode_per">
                                        
                                    </span>
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