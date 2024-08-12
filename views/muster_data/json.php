<?php
$json = $this->jsonObj;
$html = '{"records" : "'.$json['records'].'", "total": "'.$json['total'].'", "rows":[';
foreach($json['rows'] as $item){
    $array[] = '{"food_main": "'.$this->_Data->get_last_food_main_of_date($item['class_id'], $item['create_at']).'", "create_at": "'.date("d-m-Y", strtotime($item['create_at'])).'"}';
}
$html .= implode(",", $array).']}';
echo $html;
?>