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
        $level_1 = $this->_Data->get_menu();
        foreach($level_1 as $item){
            $url_level_1 = ($item['link'] == '#') ? 'javascript:void(0)' : URL.'/'.$item['link'].'?token='.$_SESSION['data'][0]['token'];
            $level_2 = $this->_Data->get_menu($item['id']);
            $class_level = (!empty($level_2)) ? 'dropdown-toggle' : ''; $tag_level = (!empty($level_2)) ? 'fa fa-angle-down' : '';
        ?>
        <li class="hover" class="<?php echo $class_level ?>">
            <a href="javacsript:void(0)" onclick="window.location.href='<?php echo $url_level_1 ?>'">
                <i class="menu-icon fa fa-<?php echo $item['icon'] ?>"></i>
                <span class="menu-text"> <?php echo $item['title'] ?></span>
                <b class="arrow <?php echo $tag_level ?>"></b>
            </a>
            <b class="arrow"></b>
            <?php
            if(!empty($level_2)){
                echo '<ul class="submenu">';
                foreach($level_2 as $item_2){
                    $url_level_2 = ($item_2['link'] == '#') ? 'javascript:void(0)' : URL.'/'.$item_2['link'].'?token='.$_SESSION['data'][0]['token'];
                ?>
                <li class="hover">
                    <a href="jaavscript:void(0)" onclick="window.location.href='<?php echo $url_level_2 ?>'">
                        <i class="menu-icon fa fa-caret-right"></i>
                        <?php echo $item_2['title'] ?>
                    </a>
                    <b class="arrow"></b>
                </li>
                <?php
                }
                echo '</ul>';
            }
            ?>
        </li>
        <?php
        }
        ?>
    </ul>
</div>