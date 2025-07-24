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
        <li class="hover">
            <a href="javacsript:void(0)" onclick="window.location.href='<?php echo URL.'/class_room?token='.$_SESSION['data'][0]['token'] ?>'">
                <i class="menu-icon fa fa-life-bouy"></i>
                <span class="menu-text"> Lớp học</span>
            </a>
            <b class="arrow"></b>
        </li>
        <li class="hover">
            <a href="javacript:void(0)" onclick="window.location.href='<?php echo URL.'/teacher?token='.$_SESSION['data'][0]['token'] ?>'">
                <i class="menu-icon fa fa-users"></i>
                <span class="menu-text"> Nhân sự</span>
            </a>
            <b class="arrow"></b>
        </li>
        <li class="hover">
            <a href="javascript:void(0)" class="dropdown-toggle">
                <i class="menu-icon fa fa-graduation-cap"></i>
                <span class="menu-text">
                    Học sinh
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="hover">
                    <a href="typography.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Thông tin học sinh
                    </a>
                    <b class="arrow"></b>
                </li>
                <li class="hover">
                    <a href="elements.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Kiểm tra đầu vào
                    </a>
                    <b class="arrow"></b>
                </li>
                <li class="hover">
                    <a href="buttons.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Chuyên cần
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
        <li class="hover">
            <a href="javascript:void(0)" class="dropdown-toggle">
                <i class="menu-icon fa fa-folder-open-o"></i>
                <span class="menu-text"> Bài giảng</span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="hover">
                    <a href="tables.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Danh mục
                    </a>
                    <b class="arrow"></b>
                </li>
                <li class="hover">
                    <a href="jqgrid.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Quản lý bài giảng
                    </a>
                    <b class="arrow"></b>
                </li>
                <li class="hover">
                    <a href="jqgrid.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Từ vựng
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
        <li class="hover">
            <a href="javascript:void(0)" class="dropdown-toggle">
                <i class="menu-icon fa fa-pencil-square-o"></i>
                <span class="menu-text"> Kiểm tra/Thi</span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="hover">
                    <a href="form-elements.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Danh mục
                    </a>
                    <b class="arrow"></b>
                </li>
                <li class="hover">
                    <a href="form-elements-2.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Quản lý thi/kiểm tra
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
        <li class="hover">
            <a href="javascript:void(0)" class="dropdown-toggle">
                <i class="menu-icon fa fa-user"></i>
                <span class="menu-text"> Quản lý người dùng</span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="hover">
                    <a href="form-elements.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Người dùng
                    </a>
                    <b class="arrow"></b>
                </li>
                <li class="hover">
                    <a href="form-elements-2.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Phân quyền
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
        <li class="hover">
            <a href="javascript:void(0)" class="dropdown-toggle">
                <i class="menu-icon fa fa-bar-chart"></i>
                <span class="menu-text"> Báo cáo</span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="hover">
                    <a href="form-elements.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Học sinh
                    </a>
                    <b class="arrow"></b>
                </li>
                <li class="hover">
                    <a href="form-elements-2.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Bài giảng
                    </a>
                    <b class="arrow"></b>
                </li>
                <li class="hover">
                    <a href="form-elements-2.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Thi/Kiểm tra
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
    </ul>
</div>