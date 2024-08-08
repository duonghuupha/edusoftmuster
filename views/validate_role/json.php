<?php
$json = $this->jsonObj;
function return_stand($id){
    $array = []; $sql = new Model();
    $str = explode(",", $id); $str = array_filter($str);
    foreach($str as $row){
        array_push($array, $sql->get_standard($row));
    }
    return implode(" ; ", $array);
}

function return_criteria($id){
    $array = []; $sql = new Model();
    $str = explode(",", $id); $str = array_filter($str);
    foreach($str as $row){
        array_push($array, $sql->get_criteria($row));
    }
    return implode(" ; ", $array);
}
$html = '{"records" : "'.$json['records'].'", "total": "'.$json['total'].'", "rows":[';
foreach($json['rows'] as $item){
    //$parent_name = ($item['parent_id'] == 0) ? 'Danh mục gốc' : $this->_Data->return_parent_name_roles($item['parent_id']);
    //$stand = $this->_Data->get_standard($item['stand'])
    $array[] = '{"id": "'.$item['id'].'", "code": "'.$item['code'].'", "user_id": "'.$item['user_id'].'", "stand_id": "'.$item['stand_id'].'", "criteria_id": "'.$item['criteria_id'].'",
                "fullname": "'.$item['fullname'].'", "status": "'.$item['status'].'", "create_at": "'.$item['create_at'].'", "standard": "'.return_stand($item['stand_id']).'", 
                "criteria": "'.return_criteria($item['criteria_id']).'"}';
}
$html .= implode(",", $array).']}';
echo $html;
?>