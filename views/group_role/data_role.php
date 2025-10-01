<?php
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
$i = 0; $array_action = ['Thêm mới', 'Cập nhật', 'Xóa', 'Nhập từ file', 'Xuất dữ liệu', 'Đặt trước', 'Duyệt yêu cầu'];
foreach($this->_Data->get_data_role_parent() as $row){
    $role_sub = $this->_Data->get_data_role_sub($row['id']);
    $i++;
?>
<div class="col-xs-4">
    <div class="widget-box widget-color-blue2" style="height:200px;overflow:auto">
        <div class="widget-header">
            <h5 class="widget-title smaller"><?php echo $row['title'] ?></h5>
            <input type="checkbox" id="role<?php echo $row['id'] ?>" name="role<?php echo $row['id'] ?>"
            value="<?php echo $row['id'] ?>" onclick="set_checked_main(<?php echo $row['id'] ?>)"
            <?php echo ($id != 0 && $this->_Data->checked_role($id, $row['id']) != 0) ? 'checked=""' : '' ?>/>
        </div>
        <div class="widget-body">
            <div class="widget-main padding-8">
                <ul id="tree1" class="tree tree-unselectable" role="tree">
                    <?php
                    if(count($role_sub) > 0){ // kiem tra xem co role con ben torng khong
                        foreach($role_sub as $item){
                    ?>
                    <li class="tree-branch tree-open" role="treeitem" aria-expanded="true">
                        <div class="tree-branch-header">
                            <span class="tree-branch-name"> 
                                <input id="role_<?php echo $row['id'].'_'.$item['id'] ?>" name="role_<?php echo $row['id'].'_'.$item['id'] ?>" type="checkbox"
                                value="<?php echo $item['id'] ?>" onclick="set_checked(<?php echo $row['id'].', '.$item['id'] ?>)" data_role="role_<?php echo $row['id'] ?>_"
                                <?php echo ($id != 0 && $this->_Data->checked_role($id, $item['id']) != 0) ? 'checked=""' : '' ?>/>
                                <span class="tree-label"><b><?php echo $item['title'] ?></b></span> 
                            </span> 
                        </div>
                        <?php
                        if($item['functions'] != ''){
                            echo '<ul class="tree-branch-children" role="group">';
                            $arr_fun_sub = explode(",",  $item['functions']);
                            foreach($arr_fun_sub as $row_fun_sub){
                        ?>
                        <li class="tree-item" role="treeitem"> 
                            <span class="tree-item-name"> 
                                <input id="function_<?php echo $item['id'].'_'.$row_fun_sub ?>" name="function_<?php echo $item['id'].'_'.$row_fun_sub ?>" type="checkbox"
                                value="<?php echo $item['id'].'_'.$row_fun_sub ?>" onclick="set_checked_function(<?php echo $item['id'].', '.$row_fun_sub ?>)"
                                <?php echo ($id != 0 && $this->_Data->checked_role($id, $item['id'].'_'.$row_fun_sub) != 0) ? 'checked=""' : '' ?>/>
                                <span class="tree-label">
                                    <?php echo $array_action[$row_fun_sub - 1] ?>
                                    <i class="ace icon fa fa-wrench"></i>
                                </span>
                            </span> 
                        </li>
                        <?php
                            }
                            echo "</ul>";
                        }
                        ?>
                    </li>
                    <?php
                        }
                    }else{ // neu khong
                        if($row['functions'] != ''){ // kiem tra co chuc nang khong
                            $arr_fun = explode(",",  $row['functions']);
                            foreach($arr_fun as $row_fun){
                    ?>
                    <li class="tree-branch tree-open" role="treeitem" aria-expanded="true">
                        <div class="tree-branch-header">
                            <span class="tree-branch-name"> 
                                <input id="function_<?php echo $row['id'].'_'.$row_fun ?>" name="function_<?php echo $row['id'].'_'.$row_fun ?>" type="checkbox"
                                value="<?php echo $row['id'].'_'.$row_fun ?>" onclick="set_checked_function(<?php echo $row['id'].', '.$row_fun ?>)"
                                <?php echo ($id != 0 && $this->_Data->checked_role($id, $row['id'].'_'.$row_fun) != 0) ? 'checked=""' : '' ?>/>
                                <span class="tree-label">
                                    <?php echo $array_action[$row_fun - 1] ?>
                                    <i class="ace icon fa fa-wrench"></i>
                                </span> 
                            </span> 
                        </div>
                    </li>
                    <?php
                            }
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php
}
?>