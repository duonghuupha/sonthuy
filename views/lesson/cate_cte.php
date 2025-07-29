<?php
$menuId = $_REQUEST['id']; $menus = [];
while($menuId){
    $row = $this->_Data->return_all_title_cate_lesson($menuId);
    if($row){
        $menus = $row; // Thêm menu hiện tại
        $menuId = $row['parent_id']; //Gán lại menuId là cha để tiếp tục vòng lặp
    }else{
        break; // Nếu không tìm thấy, thoát vòng lặp
    }
    print_r($row);
}
// Đảo ngược kết quả để láy thứ tự từ cha đến con
$menus = array_reverse($menus); print_r($menus);
// In ra breadcrumb
foreach($menus as $menu){
    echo $menu['title']. ' > ';
}
?>