<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li class="active">Quản lý người dùng</li>
            </ul><!-- /.breadcrumb -->
            <div class="nav-search" id="nav-search">
                <form class="form-search">
                    <span class="input-icon">
                        <input type="text" placeholder="Tìm kiếm ..." class="nav-search-input" id="search_users"
                        onkeyup="search()"/>
                        <i class="ace-icon fa fa-search nav-search-icon"></i>
                    </span>
                </form>
            </div><!-- /.nav-search -->
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Quản lý người dùng
                    <small class="pull-right">
                        <button class="btn btn-sm btn-primary" onclick="add()">
                            <i class="ace-icon fa fa-plus"></i>
                            Thêm mới
                        </button>
                        <button class="btn btn-sm btn-success" onclick="update()">
                            <i class="ace-icon fa fa-edit"></i>
                            Cập nhật
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="del()">
                            <i class="ace-icon fa fa-trash"></i>
                            Xóa
                        </button>
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-4 col-sm-4">
                    <form id="fm" method="post">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="form-field-username">Lựa chọn nhân sự <span style="color:red">(*)</span></label>
                                <div>
                                    <select class="select2" data-placeholder="Lựa chọn nhân sự..."
                                    style="width:100%" required="" id="personnel_id" name="personnel_id" onchange="set_username()">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="form-field-username">Tên đăng nhập <span style="color:red">(*)</span></label>
                                <div>
                                    <input type="text" id="username" name="username" required="" placeholder="Tên đăng nhập" style="width:100%" />
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="form-field-username">Mật khẩu <span style="color:red">(*)</span></label>
                                <div>
                                    <input type="password" id="pass" name="pass" required="" placeholder="Mật khẩu" style="width:100%" />
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="form-field-username">Xác nhận mật khẩu <span style="color:red">(*)</span></label>
                                <div>
                                    <input type="password" id="repass" name="repass" required="" placeholder="Xác nhận mật khẩu" style="width:100%" />
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="form-field-username">Lựa chọn quyền sử dụng <span style="color:red">(*)</span></label>
                                <div>
                                    <select class="select2" data-placeholder="Lựa chọn quyền sử dụng..."
                                    style="width:100%"  id="group_role_id" name="group_role_id">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="space-4"></div>
                        </div>
                        <div class="col-xs-12 text-center">
                            <button class="btn btn-sm btn-danger" type="button" id="btncancel" onclick="window.location.reload()">
                                <i class="ace-icon fa fa-times"></i>
                                Hủy bỏ
                            </button>
                            <button class="btn btn-sm btn-primary" type="button" id="btnsave" onclick="save()">
                                <i class="ace-icon fa fa-save"></i>
                                Ghi dữ liệu
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-xs-8 col-sm-8">
                    <table id="list_users" 
                        class="table" 
                        role="grid"
                        aria-describedby="dynamic-table_info"></table>
                    <div id="users_pager"></div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<script src="<?php echo URL.'/public/' ?>scripts/users/index.js"></script>