<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li class="">Quản lý người dùng</li>
                <li class="active">Quyền sử dụng</li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Quản lý quyền sử dụng
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-8 col-sm-8">
                    <table id="list_roles" 
                        class="table" 
                        role="grid"
                        aria-describedby="dynamic-table_info"></table>
                    <div id="roles_pager"></div>
                </div><!-- /.col -->
                <div class="col-xs-4 col-sm-4">
                    <form id="fm" method="post">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="form-field-username">Menu cha</label>
                                    <div>
                                        <select class="select2" data-placeholder="Lựa chọn menu cha"
                                        style="width:100%" id="parent_id" name="parent_id">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="form-field-username">Tên quyền / menu</label>
                                    <div>
                                        <input type="text" id="title" name="title" required=""
                                        placeholder="Tên quyền / menu sử dụng" style="width:100%" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="form-field-username">Lựa chọn đường dẫn</label>
                                    <div>
                                        <select class="select2" data-placeholder="Lựa chọn đường dẫn"
                                        style="width:100%" required="" id="link" name="link">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="form-field-username">Lựa chọn chức năng</label>
                                    <div>
                                        <select class="select2" data-placeholder="Lựa chọn chức năng"
                                        style="width:100%" id="functions" name="functions[]" multiple="">
                                            <option value="1">Thêm mới</option>
                                            <option value="2">Cập nhật</option>
                                            <option value="3">Xóa</option>
                                            <option value="4">Nhập từ file</option>
                                            <option value="5">Xuất dữ liệu</option>
                                            <option value="6">Đặt trước</option>
                                            <option value="7">Duyệt yêu cầu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="form-field-username">Thứ tự hiển thị</label>
                                    <div>
                                        <input type="text" id="order" name="order" required=""
                                        placeholder="Thứ tự hiển thị" style="width:100%" onkeypress="validate(event)"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="form-field-username">Icon</label>
                                    <div>
                                        <input type="text" id="icon" name="icon" required="" placeholder="Icon" style="width:100%"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 text-center">
                                <button class="btn btn-sm btn-danger" type="button" onclick="window.location.href='<?php echo URL.'/roles' ?>'">
                                    <i class="ace-icon fa fa-times"></i>
                                    Hủy bỏ
                                </button>
                                <button class="btn btn-sm btn-primary" type="button" onclick="save()">
                                    <i class="ace-icon fa fa-save"></i>
                                    Ghi dữ liệu
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<script src="<?php echo URL.'/public/' ?>scripts/users/roles.js"></script>