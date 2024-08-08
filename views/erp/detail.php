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
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li class="active">Công việc</li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Chi tiết công việc
                    <small class="pull-right">
                        <button type="button" class="btn btn-danger btn-sm" onclick="window.location.href='<?php echo URL.'/erp?token='.$_SESSION['data'][0]['token'] ?>'">
                            <i class="fa fa-arrow-left"></i>
                            Quay lại
                        </button>
                        <?php
                        if($item[0]['status'] <= 1){
                        ?>
                        <button type="button" class="btn btn-primary btn-sm" onclick="add_comment(<?php echo $item[0]['id'] ?>)">
                            <i class="fa fa-comment"></i>
                            Gửi ý kiến
                        </button>
                        <?php
                        }
                        if(in_array($this->_Info[0]['id'], explode(",", $item[0]['user_id_process'])) && $item[0]['status'] <= 1){
                        ?>
                        <button type="button" class="btn btn-sm btn-success" onclick="done_task(<?php echo $item[0]['id'] ?>)">
                            <i class="ace-icon fa fa-check"></i>
                            Hoàn thành công việc
                        </button>
                        <?php
                        }
                        ?>
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-4" id="col-detail-erp">
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
                                <span class="editable" id="signup"><?php echo $item[0]['content'] ?></span>
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
                                    <?php
                                    if($item[0]['file_att'] == 0){
                                        echo '<i>Không có file đính kèm</i>';
                                    }else{
                                        echo '<ul class="list-unstyled spaced2">';
                                        foreach($this->file_att as $row){
                                            echo '
                                            <li>
                                                <i class="ace-icon fa fa-circle green"></i>
                                                <a href="'.URL.'/public/task/'.$item[0]['code'].'/'.$row['file'].'" target="_blank">'.$row['file'].' ('.$this->_Convert->convert_size_file(filesize(DIR_UPLOAD.'/task/'.$item[0]['code'].'/'.$row['file'])).')</a>
                                            </li>';
                                        } 
                                        echo '</ul>';
                                    }
                                    ?>
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
                </div>
                <div class="col-xs-8" id="col-comment-erp">
                    <div class="timeline-container timeline-style2">
                        <?php
                        foreach($this->date_result as $row){
                            echo '
                            <span class="timeline-label">
                                <b>'.$row['create_at'].'</b>
                            </span>
                            <div class="timeline-items">';
                            foreach($this->_Data->return_list_result_task_pass_date_create($item[0]['id'], $row['create_at']) as $post){
                                echo '
                                <div class="timeline-item clearfix">
                                    <div class="timeline-info">
                                        <span class="timeline-date">'.date('g:i a', strtotime($post['create_at'])).'</span>
                                        <i class="timeline-indicator btn btn-info no-hover"></i>
                                    </div>
                                    <div class="widget-box transparent">
                                        <div class="widget-body">
                                            <div class="widget-main no-padding">
                                                <span class="bigger-110">
                                                    <a href="javascript:void(0)" class="purple bolder">'.$post['user_create'].'</a>
                                                    '.$post['content'].'
                                                </span>
                                            </div>
                                            <div class="file_attach_result">';
                                            $x = 0;
                                            foreach($this->_Data->return_list_file_result($post['code']) as $row_file){
                                                $x++;
                                                echo '
                                                <a href="'.URL_FILE.'/task_result/'.$post['code'].'/'.$row_file['file'].'" target="_blank">
                                                    <i class="ace-icon fa fa-file"></i> 
                                                    File '.$x.'
                                                </a>';
                                            
                                            }
                                        echo '
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ';
                            }
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<!--Form don vi tinh-->
<div id="modal-comment" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width: 50%">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    Trao đổi thông tin quá trình xử lý công việc
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="fm" method="POST" enctype="multipart/form-data">
                        <input id="code" name="code" type="hidden"/>
                        <input id="id" name="id" type="hidden"/>
                        <div class="col-xs-7" style="border-right:1px solid #307ECC">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="form-field-username">Nội dung trao đổi</label>
                                    <div>
                                        <textarea class="form-control" id="content" name="content" 
                                        placeholder="Nội dung trao đổi" style="resize:none;height:150px;"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-5">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="form-field-username">Lựa chọn file đính kèm</label>
                                    <div>
                                        <input type="file" id="file_att" name="file_att" class="file_attach" style="width:100%"
                                        onchange="change_upload_result()" multiple=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12" id="list_file_result">
                                <ul id="list_file">
                                    
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    Đóng
                </button>
                <button class="btn btn-sm btn-primary pull-right" onclick="save_comment(<?php echo $item[0]['id'] ?>)" id="save_cm">
                    <i class="ace-icon fa fa-save"></i>
                    Ghi dữ liệu
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End formm don vi tinh-->

<script src="<?php echo URL.'/public/' ?>scripts/erp/task_result.js"></script>