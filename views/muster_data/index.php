<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bảng điểm danh :: EDUSOFT</title>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="5">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo URL ?>/styles/assets/css/roboto.css">
    <link rel="stylesheet" href="<?php echo URL ?>/styles/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo URL ?>/styles/assets/css/muster_data.css">
    <script src="<?php echo URL ?>/styles/assets/js/jquery-1.11.3.min.js"></script>
    <script src="<?php echo URL ?>/styles/assets/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="<?php echo URL ?>/styles/assets/images/edusoft_tran.png" />
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4 title_left">
                <h2>Trường mầm non đô thị sài đồng</h2>
            </div>
            <div class="col-sm-8 title_right">
                <h1>Bảng tổng hợp báo ăn ngày <?php echo date("d-m-Y") ?></h1>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <?php
            $json = $this->jsonObj; $total = count($json); $page = ceil($total/2);
            $i = 0;
            foreach($json as $item){
                $i++;
                if($i == 1 || $i == $page+1){
                    echo '
                    <div class="col-sm-6">
                        <div style="overflow-x: auto;">
                            <table id="customers" style="width:100%">
                                <colgroup style="width:50%"></colgroup>
                                <colgroup style="width:50%"></colgroup>
                                <colgroup style="width:25%"></colgroup>
                                <tr>
                                    <th>Lớp</th>
                                    <th>Ăn chính</th>
                                    <!--<th>Ăn sáng</th>-->
                                </tr>
                    ';
                }
                echo '
                <tr>
                    <td>'.$item['title'].'</td>
                    <td>'.$item['food_main'].'</td>
                    <!--<td>'.$item['food_morning'].'</td>-->
                </tr>
                ';
                if($i == $page || $i == $total){
                    echo '
                            </table>
                        </div>
                    </div>
                    ';
                }
            }
            ?>
        </div>
    </div>

</body>

</html>