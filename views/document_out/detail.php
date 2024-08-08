<?php
$item = $this->info;
if($item[0]['type'] == 1){
    $type = "Quyết định";
}elseif($item[0]['type'] == 2){
    $type = "Kế hoạch";
}elseif($item[0]['type'] == 3){
    $type = "Công văn";
}elseif($item[0]['type'] == 4){
    $type = "Báo cáo";
}else{
    $type = "Văn bản khác";
}
?>
<div class="row">
    <div class="col-sm-12">
        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name"> Kiểu văn bản </div>
                <div class="profile-info-value">
                    <span class="editable" id="username"><?php echo $type ?></span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Danh mục văn bản </div>
                <div class="profile-info-value">
                    <span class="editable" id="username"><?php echo $item[0]['cate'] ?></span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Số văn bản </div>
                <div class="profile-info-value">
                    <span class="editable" id="age"><?php echo $item[0]['number_dc'] ?></span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Ngày văn bản </div>
                <div class="profile-info-value">
                    <span class="editable" id="signup"><?php echo date("d-m-Y", strtotime($item[0]['date_dc'])) ?></span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Nơi nhận </div>
                <div class="profile-info-value">
                    <span class="editable" id="signup"><?php echo $item[0]['location_to'] ?></span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Tên văn bản </div>
                <div class="profile-info-value">
                    <span class="editable" id="signup"><?php echo $item[0]['title'] ?></span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Trích yếu </div>
                <div class="profile-info-value">
                    <span class="editable" id="signup"><?php echo $item[0]['content'] ?></span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Tệp văn bản </div>
                <div class="profile-info-value">
                    <span class="editable" id="signup">
                        <a href="<?php echo URL.'/public/documnet_out/'.$item[0]['file'] ?>" target="_blank">
                            <?php echo $item[0]['file'] ?>
                        </a>
                    </span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Chia sẻ </div>
                <div class="profile-info-value">
                    <span class="editable" id="signup" style="color:green"><?php echo $this->share ?></span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Công khai </div>
                <div class="profile-info-value">
                    <span class="editable" id="signup"><?php echo ($item[0]['is_publish'] == 1) ? 'Công khai' : 'Không công khai' ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .profile-info-name{
        width:131px !important;
    }
</style>