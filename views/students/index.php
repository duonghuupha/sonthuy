<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li class="">Quản lý học sinh</li>
                <li class="active">Thông tin học sinh</li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Quản lý thông tin học sinh
                    <small class="pull-right">
                        <button class="btn btn-sm btn-primary" id="add_personnel" onclick="add()">
                            <i class="ace-icon fa fa-plus"></i>
                            Thêm mới
                        </button>
                        <button class="btn btn-sm btn-success" id="update_personnel" onclick="update()">
                            <i class="ace-icon fa fa-edit"></i>
                            Cập nhật
                        </button>
                        <button class="btn btn-sm btn-danger" id="del_personnel" onclick="del()">
                            <i class="ace-icon fa fa-trash"></i>
                            Xóa
                        </button>
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-4 col-sm-4">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="form-field-username">Lớp học</label>
                            <div>
                                <select class="select2" data-placeholder="Lựa chọn lớp học..." style="width:100%"
                                    required="" id="class_id_search" name="class_id_search" <?php echo $disabled ?>></select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="form-field-username">Mã học sinh</label>
                            <div>
                                <input type="text" id="code_search" name="code_search" style="width:100%"
                                    placeholder="Mã học sinh" />
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="form-field-username">Họ và tên</label>
                            <div>
                                <input type="text" id="fullname_search" name="fullname_search" style="width:100%"
                                    placeholder="Họ và tên" />
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="form-field-username">Ngày sinh</label>
                            <div>
                                <input class="form-control input-mask-date" id="birthday_search" type="text"
                                name="birthday_search" onkeypress="validate(event)" />
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="form-field-username">Giới tính</label>
                            <div>
                                <select class="select2" data-placeholder="Lựa chọn giới tính..." style="width:100%"
                                    required="" id="gender_search" name="gender_search"
                                    data-minimum-results-for-search="Infinity">
                                    <option value="0">Tất cả</option>
                                    <option value="1">Nam</option>
                                    <option value="2">Nữ</option>
                                    <option value="3">Khác</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="form-field-username">Địa chỉ</label>
                            <div>
                                <input class="form-control input-mask-date" id="birthday_search" type="text"
                                name="birthday_search" onkeypress="validate(event)" />
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 text-center">
                        <button class="btn btn-sm btn-primary" onclick="search()">
                            <i class="ace-icon fa fa-search"></i>
                            Tìm kiếm
                        </button>
                    </div>
                </div>
                <div class="col-xs-8 col-sm-8">
                    <table id="list_student" 
                        class="table" 
                        role="grid"
                        aria-describedby="dynamic-table_info"></table>
                    <div id="student_pager"></div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<!--Form don vi tinh-->
<div id="modal-student" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width:40%">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    Thêm mới - Cập nhật thông tin học sinh
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="fm" method="POST" enctype="multipart/form-data">
                        <input type="hidden" id="relation_dc" name="relation_dc" value=""/>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="form-field-username">
                                    Mã học sinh <span style="color:red">(*)</span> &nbsp;
                                    <a href="javascript:void(0)" onclick="refresh_code()" title="Tạo mã code" id="refreshcode">
                                        <i class="fa fa-refresh"></i>
                                    </a>
                                </label>
                                <div>
                                    <input type="text" id="code" name="code" style="width:100%" required="" readonly=""/>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="form-field-username">Họ và tên <span style="color:red">(*)</span></label>
                                <div>
                                    <input type="text" id="fullname" name="fullname" required="" placeholder="Họ và tên" style="width:100%" />
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="form-field-username">Ngày sinh (dd-mm-yyyy) <span style="color:red">(*)</span></label>
                                <div>
                                    <input class="form-control input-mask-date" id="birthday" type="text" 
                                    name="birthday" placeholder="Ngày sinh" required="" onkeypress="validate(event)"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="form-field-username">Giới tính <span style="color:red">(*)</span></label>
                                <div>
                                    <select class="select2" data-placeholder="Lựa chọn giới tính..."
                                    style="width:100%" required="" id="gender" name="gender"
                                    data-minimum-results-for-search="Infinity">
                                        <option value="1">Nam</option>
                                        <option value="2">Nữ</option>
                                        <option value="3">Khác</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="form-field-username">Lớp học <span style="color:red">(*)</span></label>
                                <div>
                                    <select class="select2" data-placeholder="Lựa chọn lớp học..."
                                    style="width:100%" required="" id="class_id" name="class_id"></select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="form-field-username">Email</label>
                                <div>
                                    <input type="email" id="email" name="email" placeholder="Email" style="width:100%"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="form-field-username">Địa chỉ <span style="color:red">(*)</span></label>
                                <div>
                                    <input type="text" id="address" name='address' placeholder="Địa chỉ" style="width:100%"
                                    required=""/>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <hr />
                        </div>
                        <div class="col-xs-6">
                            <h3 class="header smaller lighter blue" style="border:none;margin:0;">
                                Phụ huynh
                            </h3>
                        </div>
                        <div class="col-xs-6">
                            <button class="btn btn-sm btn-success pull-right" onclick="add_relation()" type="button"
                                id="select_devices">
                                <i class="ace-icon fa fa-user"></i>
                                Thêm mới (s)
                            </button>
                        </div>
                        <div class="col-xs-12">
                            <table class="table_modal">
                                <colgroup style="width:100px;"></colgroup>
                                <colgroup style="width:150px;"></colgroup>
                                <colgroup style="width:120px;"></colgroup>
                                <colgroup style="width:170px;"></colgroup>
                                <colgroup style="width:20px;"></colgroup>
                                <thead>
                                    <tr>
                                        <th style="text-align:center">Quan hệ (*)</th>
                                        <th>Họ và tên (*)</th>
                                        <th>Điện thoại (*)</th>
                                        <th>Email</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="tbody"></tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger pull-left" id="close_modal" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    Đóng
                </button>
                <button class="btn btn-sm btn-primary pull-right" id="save_modal" onclick="save()">
                    <i class="ace-icon fa fa-save"></i>
                    Ghi dữ liệu
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End formm don vi tinh-->

<!--Form don vi tinh-->
<div id="modal-detail" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width:40%">
        <div class="modal-content" id="detail">
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End formm don vi tinh-->

<script src="<?php echo URL.'/public/' ?>scripts/students/index.js"></script>