<?php
$item = $this->jsonObj;
?>
<div class="modal-header no-padding">
    <div class="table-header">
        Thêm mới - Cập nhật thông tin học sinh
    </div>
</div>
<div class="modal-body" style="height:600px;overflow:scroll">
    <div class="row">
        <form id="fm-charge" method="POST" enctype="multipart/form-data">
            <?php
            foreach($item as $row){
            ?>
            <div class="col-xs-4">
                <div class="widget-box">
                    <div class="widget-header widget-header-flat">
                        <h4 class="widget-title"><?php echo $row['title'] ?></h4>
                    </div>
                    <div class="widget-body">
                        <div class="widget-main">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <div>
                                            <select class="select2 user_id" data-placeholder="Lựa chọn giáo viên" onchange="select_user(<?php echo $row['id'] ?>)"
                                            style="width:100%" required="" id="user_id_<?php echo $row['id'] ?>" name="user_id_<?php echo $row['id'] ?>">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12" id="name_user_class_<?php echo $row['id'] ?>">
                                    <ul class="list-unstyled spaced">
                                        <?php
                                        foreach($this->_Data->get_list_name_per_class($row['id']) as $post){
                                            echo '
                                            <li>
                                                <i class="ace-icon fa fa-check bigger-110 green"></i>'
                                                    .$post['fullname'].
                                                    '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" style="color:red" title="Hủy phân lớp giáo viên" onclick="del_charge('.$row['id'].', '.$post['id'].')"><i class="ace icon fa fa-trash"></i></a>
                                            </li>';
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
        </form>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
        <i class="ace-icon fa fa-times"></i>
        Đóng
    </button>
</div>
<script>
$(function(){
    $('.select2').select2();
});
</script>