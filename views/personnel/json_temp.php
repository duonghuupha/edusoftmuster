<?php
$json = $this->jsonObj;
$html = '{"records" : "'.$json['records'].'", "total": "'.$json['total'].'", "rows":[';
if(count($json['rows']) > 0){
    foreach($json['rows'] as $item){
        $dupli = $this->_Data->return_dupli_code_personnel_temp($item['code']);
        $array[] = '{"id": "'.$item['id'].'", "code": "'.$item['code'].'", "fullname": "'.$item['fullname'].'", "gender": "'.$item['gender'].'", "birthday": "'.$item['birthday'].'",
        "phone": "'.$item['phone'].'", "email": "'.$item['email'].'", "address": "'.$item['address'].'", "gender_display": "'.$item['gender'].'", "dupli": "'.$dupli.'",
        "code_display": "'.$item['code'].'", "level_title": "'.$item['level_title'].'", "job_title": "'.$item['job_title'].'", "regency_title": "'.$item['regency_title'].'",
        "level_id": "'.$item['level_id'].'", "job_id": "'.$item['job_id'].'", "regency_id": "'.$item['regency_id'].'"}';
    }
    $html .= implode(",", $array).']}';
}else{
    $html .= ']}';
}
echo $html;
?>