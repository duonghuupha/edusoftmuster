<?php
$item = $this->jsonObj;
?>
<div class="modal-header no-padding">
    <div class="table-header">
        Phê duyệt yêu cầu chuyển lớp
    </div>
</div>
<div class="modal-body">
    <div class="row">
        <div class="document_class">
            <div class="top">
                <div class="top_left">
                    <span>ubnd quận long biên</span>
                    <span>trường mầm non đô thị sài đồng</span>
                </div>
                <div class="top_right">
                    <span>cộng hòa xã hội chủ nghĩa việt nam</span>
                    <span>Độc lập  - Tự do - Hạnh phúc</span>
                </div>
            </div>
            <div class="middle">
                <h3>phiếu chấp thuận chuyển lớp</h3>
                <span>Số phiếu: <?php echo $item[0]['code'] ?></span>
                <span>Ban giám hiệu Trường mầm non Đô thị Sài Đồng đồng ý cho học sinh chuyển lớp với thông tin sau:</span>
            </div>
            <div class="content">
                <div class="row_1">
                    <span>Họ và tên học sinh: <b><?php echo $item[0]['fullname'] ?></b></span>
                    <span>Ngày sinh: <b><?php echo date("d-m-Y", strtotime($item[0]['birthday'])) ?></b></span>
                    <span>Giới tính: <b>Nữ</b></span>
                </div>
                <div class="row_2">
                    <span>Mã học sinh: <b><?php echo $item[0]['student_code'] ?></b></span>
                </div>
                <div class="row_2">
                    <span>Lớp học hiện tại: <b><?php echo $item[0]['class_from'].' - '.$item[0]['year_from'] ?></b></span>
                </div>
                <div class="row_3">
                    <span>Lớp học chuyển đến: <b><?php echo $item[0]['class_to'].' - '.$item[0]['year_to'] ?></b></span>
                </div>
                <div class="row_3">
                    <span>Lý do chuyển lớp: <b><?php echo $item[0]['content'] ?></b></span>
                </div>
            </div>
            <?php
            if($item[0]['status'] == 1){
            ?>
            <div class="bottom">
                <span>&nbsp;</span>
                <span>
                    <span>Long Biên, ngày 05 tháng 10 năm 2024</span>
                    <span>T/M Ban giám hiệu</span>
                    <span>Hiệu trưởng</span>
                    <span>Trần Thị Phương Dung</span>
                </span>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
        <i class="ace-icon fa fa-times"></i>
        Đóng
    </button>
    <button class="btn btn-sm btn-success pull-right" onclick="save_approve(<?php echo $item[0]['id'] ?>)">
        <i class="ace-icon fa fa-check"></i>
        Duyệt chuyển lớp
    </button>
</div>
</script>