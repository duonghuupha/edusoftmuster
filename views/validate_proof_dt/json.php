<?php
$json = $this->jsonObj;
$html = '{"records" : "'.$json['records'].'", "total": "'.$json['total'].'", "rows":[';
foreach($json['rows'] as $item){
    if($item['file_link'] != ''){
        $file_link = explode(".", $item['file_link']); $type_dc = $file_link[0]; $file_link_dc = $file_link[1];
        if($file_link[0] == 1){ // van ban den
            $file_dc = 'document_in/'.$this->_Data->return_file_name_dc_in($file_link[1])[0]['file'];
            $file_title = addslashes($this->_Data->return_file_name_dc_in($file_link[1])[0]['title']);
        }else{ // van ban di
            $file_dc = 'document_out/'.$this->_Data->return_file_name_dc_out($file_link[1])[0]['file'];
            $file_title = addslashes($this->_Data->return_file_name_dc_out($file_link[1])[0]['title']);
        }
    }else{
        $file_dc = ''; $type_dc = 0; $file_title = '';
    }
    $array[] = '{"id": "'.$item['id'].'", "code": "'.$item['code'].'", "proof_id": "'.$item['proof_id'].'", "year_proof": "'.$item['year_proof'].'", "title": "'.$item['title'].'",
                "type_data": "'.$item['type_data'].'", "file": "'.$item['file'].'", "file_link": "'.$file_link_dc.'", "link": "'.$item['link'].'", "year_proof_title": "'.$item['year_proof_title'].'",
                "user_id": "'.$item['user_id'].'", "status": "'.$item['status'].'", "create_at": "'.$item['create_at'].'", "type_dc": "'.$type_dc.'",
                "title_file_link": "'.$file_title.'", "file_dc" : "'.$file_dc.'"}';
}
$html .= implode(",", $array).']}';
echo $html;
?>