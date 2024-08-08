<?php
$json = $this->jsonObj;
$html = '{"records" : "'.$json['records'].'", "total": "'.$json['total'].'", "rows":[';
foreach($json['rows'] as $item){
    $user_pro = explode(",", $item['user_id_process']); $user_pro = array_filter(array_unique($user_pro));
    foreach($user_pro as $post){
        $array_fullname[$item['id']][] = $this->_Data->return_fullname_user_proccess_task($post);
    }
    $array[] = '{"id": "'.$item['id'].'", "code": "'.$item['code'].'", "prioritize": "'.$item['prioritize'].'", "group_title": "'.$item['group_title'].'", "title": "'.$item['title'].'",
                "user_create": "'.$item['user_create'].'", "date_end": "'.$item['date_end'].'", "deadline": "'.$item['deadline'].'", "status": "'.$item['status'].'", "create_at": "'.$item['create_at'].'",
                "trang_thai": "'.$item['trang_thai'].'", "user_id_create": "'.$item['user_id_create'].'", "date_result": "'.$item['date_result'].'", "user_monitor": "'.$item['user_monitor'].'",
                "user_process": "'.implode(", ", $array_fullname[$item['id']]).'", "private": "'.$item['private'].'"}';
}
$html .= implode(",", $array).']}';
echo $html;
?>