<div id="sidebar" class="sidebar responsive ace-save-state sidebar-fixed compact">
    <ul class="nav nav-list">
        <li class="hover">
            <a href="<?php echo URL.'/index?token='.$_SESSION['data'][0]['token'] ?>">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Bàn làm việc </span>
            </a>
            <b class="arrow"></b>
        </li>
    <!------------------------------------Danh muc----------------------------------------->
        <?php
        $json = $this->_Data->return_sidebar($this->_Info[0]['id'], 0);
        foreach($json as $row){
            $json_con = $this->_Data->return_sidebar($this->_Info[0]['id'], $row['id']);
            $link = ($row['link'] == '#') ? 'javascript:void(0)' : URL.'/'.$row['link'].'?token='.$_SESSION['data'][0]['token'];
            if(count($json_con) > 0){
                $class = 'class="dropdown-toggle"';
                $tag_html = '<b class="arrow fa fa-angle-down"></b>';
            }else{
                $class = ''; $tag_html = '';
            }
            if($row['link'] == '#'){
                $active = ($parnet_id == $row['id']) ? 'active' : '';
            }else{
                $active = ($url[0] == $row['link']) ? 'active' : '';
            }
            echo '
            <li class="hover '.$active.'">
                <a href="'.$link.'" '.$class.'>
                    <i class="menu-icon fa fa-'.$row['icon'].'"></i>
                    <span class="menu-text">
                        '.$row['title'].'
                    </span>
                    '.$tag_html.'
                </a>
                <b class="arrow"></b>
            ';
            if(count($json_con) > 0){
                echo '<ul class="submenu">';
                foreach($json_con as $item){
                    $link_con = ($item['link'] == '#') ? 'javascript:void(0)' : URL.'/'.$item['link'].'?token='.$_SESSION['data'][0]['token'];
                    $active = ($url[0] == $item['link']) ? 'active' : '';
                    echo '
                    <li class="hover '.$active.'">
                        <a href="'.$link_con.'">
                            <i class="menu-icon fa fa-caret-right"></i>
                            '.$item['title'].'
                        </a>
                        <b class="arrow"></b>
                    </li>
                    ';
                }
                echo '</ul>';
            }
            echo '</li>';
        }
        ?>
    </ul>
</div>