<div id="navbar" class="navbar navbar-default ace-save-state navbar-fixed-top">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="navbar-header pull-left">
            <a href="<?php echo URL.'/index' ?>" class="navbar-brand">
                <small>
                    <i class="fa fa-leaf"></i>
                    SONTHUY EDU
                </small>
            </a>
        </div>
        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">
                <li class="light-blue dropdown-modal">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <img class="nav-user-photo" src="<?php echo URL.'/styles/assets' ?>/images/logo_son_thuy.png"/>
                        <span class="user-info">
                            <small>Xin chào,</small>
                            <?php
                            if($_SESSION['data'][0]['username'] == 'admin'){
                                echo "Administrator";
                            }
                            ?>
                        </span>
                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>
                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <?php
                        if($_SESSION['data'][0]['id'] != 1){
                        ?>
                        <li>
                            <a href="<?php echo URL.'/profile?token='.$this->_Info[0]['token'] ?>">
                                <i class="ace-icon fa fa-user"></i>
                                Tài khoản
                            </a>
                        </li>
                        <li class="divider"></li>
                        <?php
                        }else{
                        ?>
                        <li>
                            <a href="<?php echo URL.'/setting?token='.$this->_Info[0]['token'] ?>">
                                <i class="ace-icon fa fa-gears"></i>
                                Cài đặt
                            </a>
                        </li>
                        <li class="divider"></li>
                        <?php
                        }
                        ?>
                        <li>
                            <a href="<?php echo URL.'/index/logout' ?>">
                                <i class="ace-icon fa fa-power-off"></i>
                                Đăng xuất
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div><!-- /.navbar-container -->
</div>