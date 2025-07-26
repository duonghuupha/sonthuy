<?php
function show_table_leson_cate($categories, $parent_id = 0, $char = ''){
    foreach ($categories as $key => $item){
        if ($item['parent_id'] == $parent_id){
            echo '<tr id="row_'.$item['id'].'" onclick="select_row('.$item['id'].')">';
                echo '<td style="text-align:center">'.$item['code'].'</td>';
                echo '<td><b style="font-size:16px">'.$char.'</b>'.$item['title'].'</td>';
                echo '<td class="text-center">'.$item['content'].'</td>';
                echo '<td style="text-align:center">';
                    if($item['status'] == 1){
                        echo '<a href="javascript:void(0)" onclick="change(0, '.$item['id'].')">';
                            echo '<img src="'.URL.'/styles/assets/images/publish.png"/>';
                        echo '</a>';
                    }else{
                        echo '<a href="javascript:void(0)" onclick="change(1, '.$item['id'].')">';
                            echo '<img src="'.URL.'/styles/assets/images/unpublish.png"/>';
                        echo '</a>';
                    }
                echo '</td>';
                echo '<td cstyle="text-align:center">'.$item['create_at'].'</td>';
            echo '</tr>';
            unset($categories[$key]);
            show_table_leson_cate($categories, $item['id'], $char.'|---');
        }
    }
}
?>
<table 
    id="dynamic-table"
    class="table table-bordered table-container" 
    role="grid"
    aria-describedby="dynamic-table_info">
    <thead>
        <tr role="row">
            <th style="width:120px;text-align:center">Mã danh mục</th>
            <th class="" style="width:200px">Tên danh mục</th>
            <th class="text-left">Mô tả</th>
            <th style="width:100px;text-align:center">Trạng thái</th>
            <th style="width:150px;text-align:center">Cập nhật lần cuối</th>
        </tr>
    </thead>
    <tbody>
        <?php echo show_table_leson_cate($this->jsonObj) ?>
    </tbody>
</table>