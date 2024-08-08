<?php
$week = ($_REQUEST['week'] != '') ? $_REQUEST['week'] : date("W");
$year = ($_REQUEST['year'] != '') ? $_REQUEST['year'] : datE("Y");
$week_array = $this->_Convert->getStartAndEndDate($week, $year);
////////////////////////////////////////////////////////////////////////////////////////////
$first_day_of_week = date("d-m-Y", strtotime($week_array['week_start'])); $from_day = $week_array['week_start'];
$last_day_of_week = date("d-m-Y", strtotime($week_array['week_end'])); $to_day = $week_array['week_end'];
/////////////////////////////////////////////////////////////////////////////////////
$begin = new DateTime( $from_day );
$end = new DateTime( $to_day );
$end = $end->modify( '+1 day' ); 
$interval = new DateInterval('P1D');
$daterange = new DatePeriod($begin, $interval ,$end);
/////////////////////////////////////////////////////////////////////////////////////
$data_dc = base64_decode($_REQUEST['data']); $data_dc_arr = explode(",", $data_dc);
////////////////////////////////////////////////////////////////////////////////////
?>
<div class="week">
    <div class="top_content">
        <div class="left_content">
            <span>UBND quận long biên</span>
            <span>Trường mầm non đô thị sài đồng</span>
        </div>
        <div class="right_content">
            <span>Lịch công tác ban giám hiệu</span>
            <span>Tuần <?php echo $week ?> (Từ ngày <?php echo $first_day_of_week ?> đến ngày <?php echo $last_day_of_week ?>)</span>
        </div>
    </div>
    <div class="content_week">
        <table id="week_task">
            <colgroup style="width:8%"></colgroup>
            <colgroup style="width:50%"></colgroup>
            <colgroup style="width:15%"></colgroup>
            <colgroup style="width:15%"></colgroup>
            <colgroup style="width:12%"></colgroup>
            <thead>
                <tr>
                    <th>Thứ</th>
                    <th>Nội dung công việc, thời gian, địa điểm</th>
                    <th>Bộ phận thực hiện</th>
                    <th>Lãnh đạo phụ trách</th>
                    <th>Các nội dung công việc phát sinh</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach($daterange as $row){
                    $i++;
                    $json = $this->_Data->get_task_of_date($data_dc, $row->format('Y-m-d'));
                    $colspan = (count($json) > 1) ? 'rowspan="'.count($json).'"' : '';
                    if(count($json) < 2){
                ?>
                <tr>
                    <td class="text-center" style="font-weight: 700" <?php echo $colspan ?>>
                        <?php echo $this->_Convert->return_day_text($row->format("D")).'<br/>'.$row->format("d/m") ?>
                    </td>
                    <?php
                    if($json[0]['user_id_process'] != ''){
                        $user_pro = $json[0]['user_id_process']; $user_pro = explode(",", $user_pro);
                        foreach($user_pro as $item){
                            $array_fullname[$i][] = $this->_Data->return_fullname_user_proccess_task($item);
                        }
                    }else{
                        $array_fullname[$i][] = '';
                    }
                    ?>
                    <td><?php echo $json[0]['title'] ?></td>
                    <td class="text-center"><?php echo implode("<br/>", $array_fullname[$i]) ?></td>
                    <td class="text-center"><?php echo $json[0]['user_monitor'] ?></td>
                    <td></td>
                </tr>
                <?php
                    }else{
                ?>
                <tr>
                    <td class="text-center" style="font-weight: 700" <?php echo $colspan ?>>
                        <?php echo $this->_Convert->return_day_text($row->format("D")).'<br/>'.$row->format("d/m") ?>
                    </td>
                    <?php
                    $json_first = $this->_Data->get_task_of_date_first($data_dc, $row->format('Y-m-d'));
                    if($json_first[0]['user_id_process'] != ''){
                        $user_pro = $json_first[0]['user_id_process']; $user_pro = explode(",", $user_pro);
                        foreach($user_pro as $item){
                            $array_fullname[$i][] = $this->_Data->return_fullname_user_proccess_task($item);
                        }
                    }else{
                        $array_fullname[$i][] = '';
                    }
                    ?>
                    <td><?php echo $json_first[0]['title'] ?></td>
                    <td class="text-center"><?php echo implode("<br/>", $array_fullname[$i]) ?></td>
                    <td class="text-center"><?php echo $json_first[0]['user_monitor'] ?></td>
                    <td></td>
                </tr>
                <?php
                    $json_continue = $this->_Data->get_task_of_date_continue($data_dc, $row->format('Y-m-d'));
                    foreach($json_continue as $item){
                        if($item['user_id_process'] != ''){
                            $user_pro = $item['user_id_process']; $user_pro = explode(",", $user_pro);
                            foreach($user_pro as $items){
                                $array_fullname[$item['id']][] = $this->_Data->return_fullname_user_proccess_task($items);
                            }
                            //print_r(array_filter($array_fullname[$item['id']]));
                        }else{
                            $array_fullname[$item['id']][] = '';
                        }
                ?>
                <tr>
                    <td><?php echo $item['title'] ?></td>
                    <td class="text-center"><?php echo implode("<br/>", array_filter($array_fullname[$item['id']])) ?></td>
                    <td class="text-center"><?php echo $item['user_monitor'] ?></td>
                    <td></td>
                </tr>
                <?php
                    }
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>