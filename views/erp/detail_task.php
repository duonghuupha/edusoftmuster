<?php
$item = $this->jsonObj; $user_process = explode(",", $item[0]['user_id_process']);
foreach($user_process as $row){
    if($row == 1){
        $user_p[] = 'Administrator';
    }else{
        $user_p[] = $this->_Data->return_fullname_pass_user_id($row);
    }
}
?>
<div class="profile-user-info profile-user-info-striped">
    <div class="profile-info-row">
        <div class="profile-info-name"> Mã công việc </div>
        <div class="profile-info-value">
            <span class="editable" id="username"><?php echo $item[0]['code'] ?></span>
        </div>
    </div>
    <div class="profile-info-row">
        <div class="profile-info-name"> Nhóm công việc </div>
        <div class="profile-info-value">
            <span class="editable" id="country"><?php echo $item[0]['group_title'] ?></span>
        </div>
    </div>
    <div class="profile-info-row">
        <div class="profile-info-name"> Tiêu đề </div>
        <div class="profile-info-value">
            <span class="editable" id="age"><?php echo $item[0]['title'] ?></span>
        </div>
    </div>
    <div class="profile-info-row">
        <div class="profile-info-name"> Mô tả công việc </div>
        <div class="profile-info-value">
            <span class="editable" id="signup"><?php echo $this->_Convert->cut($item[0]['content'], 100) ?></span>
        </div>
    </div>
    <div class="profile-info-row">
        <div class="profile-info-name"> Ngày bắt đầu </div>
        <div class="profile-info-value">
            <span class="editable" id="login"><?php echo date("d-m-Y", strtotime($item[0]['date_start'])) ?></span>
        </div>
    </div>
    <div class="profile-info-row">
        <div class="profile-info-name"> Ngày kết thúc </div>
        <div class="profile-info-value">
            <span class="editable" id="login"><?php echo date("d-m-Y", strtotime($item[0]['date_end'])) ?></span>
        </div>
    </div>
    <div class="profile-info-row">
        <div class="profile-info-name"> Người tạo/Người giao </div>
        <div class="profile-info-value">
            <span class="editable" id="about"><?php echo $item[0]['user_create'] ?></span>
        </div>
    </div>
    <div class="profile-info-row">
        <div class="profile-info-name"> Người thực hiện </div>
        <div class="profile-info-value">
            <span class="editable" id="about"><?php echo implode(", ", $user_p) ?></span>
        </div>
    </div>
    <div class="profile-info-row">
        <div class="profile-info-name"> Người giám sát </div>
        <div class="profile-info-value">
            <span class="editable" id="about"><?php echo $item[0]['user_monitor'] ?></span>
        </div>
    </div>
    <div class="profile-info-row">
        <div class="profile-info-name"> File đính kèm </div>
        <div class="profile-info-value">
            <span class="editable" id="about">
                <?php echo ($item[0]['file_att'] == 0) ? 'Không có file đính kèm' : 'Có '.$item[0]['file_att'].' đính kèm' ?>
            </span>
        </div>
    </div>
    <div class="profile-info-row">
        <div class="profile-info-name"> Ngày tạo </div>
        <div class="profile-info-value">
            <span class="editable" id="about"><?php echo date("H:i:d d-m-Y", strtotime($item[0]['create_at'])) ?></span>
        </div>
    </div>
</div>
<div class="col-xs-12">
    <div class="space-4"></div>
</div>
<div class="col-xs-12 text-center">
    <button type="button" class="btn btn-primary btn-sm" onclick="redirect_detail(<?php echo $item[0]['id'] ?>)">
        Chi tiết công việc
        <i class="fa fa-arrow-right"></i>
    </button>
</div>