<?php
$json = $this->jsonObj; $array_action = ['Thêm mới', 'Cập nhật', 'Xóa', 'Nhập từ file', 'Xuất dữ liệu', 'Đặt trước', 'Duyệt yêu cầu'];
$html = '{"records" : "'.$json['records'].'", "total": "'.$json['total'].'", "rows":[';
foreach($json['rows'] as $item){
    $parent_name = ($item['parent_id'] == 0) ? 'Danh mục gốc' : $this->_Data->return_parent_name_roles($item['parent_id']);
    if($item['functions'] != ''){
        $arr_fun = explode(",",  $item['functions']);
        foreach($arr_fun as $row){
            $array_fun[$item['id']][] = $array_action[$row - 1];
        }
        $chucnang = implode(", ", $array_fun[$item['id']]);
    }else{
        $chucnang = '';
    }
    $array[] = '{"id": "'.$item['id'].'", "parent_id": "'.$item['parent_id'].'", "title": "'.$item['title'].'", "link": "'.$item['link'].'", "parent": "'.$parent_name.'",
                "functions": "'.$item['functions'].'", "order_position": "'.$item['order_position'].'", "icon": "'.$item['icon'].'", "is_submenu": "'.$item['is_submenu'].'",
                "icon_display": "'.$item['icon'].'", "functions": "'.$item['functions'].'", "chuc_nang": "'.$chucnang.'", "status": "'.$item['status'].'"}';
}
$html .= implode(",", $array).']}';
echo $html;
?>