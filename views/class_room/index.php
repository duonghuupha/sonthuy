<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li class="active">Quản lý lớp học</li>
            </ul><!-- /.breadcrumb -->
            <div class="nav-search" id="nav-search">
                <form class="form-search">
                    <span class="input-icon">
                        <input type="text" placeholder="Tìm kiếm ..." class="nav-search-input" id="search_personnel"
                        onkeyup="search()"/>
                        <i class="ace-icon fa fa-search nav-search-icon"></i>
                    </span>
                </form>
            </div><!-- /.nav-search -->
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Quản lý lớp học
                    <small class="pull-right">
                        <?php 
                            echo $this->_Convert->return_role_functions_static($this->_Info[0]['id'], 5, 'order_teacher()'); // xep lop
                            echo $this->_Convert->return_role_functions_static($this->_Info[0]['id'], 1, 'add()'); // them moi
                            echo $this->_Convert->return_role_functions_static($this->_Info[0]['id'], 2, 'update()'); // cap nhat
                            echo $this->_Convert->return_role_functions_static($this->_Info[0]['id'], 3, 'del()'); // xoa
                        ?>
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <div class="col-xs-12 col-sm-5">
                        <form id="fm" method="post">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="form-field-username">
                                            Mã lớp học <span style="color:red">(*)</span>
                                            <a href="javascript:void(0)" onclick="refresh_code()" title="Tạo mã code" id="refreshcode">
                                                <i class="fa fa-refresh"></i>
                                            </a>
                                        </label>
                                        <div>
                                            <input type="text" id="code" name="code" required="" placeholder="Mã lớp học" 
                                            style="width:100%" readonly=""/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="form-field-username">Tên lớp học <span style="color:red">(*)</span></label>
                                        <div>
                                            <input type="text" id="title" name="title" required="" placeholder="Tên lớp học" style="width:100%" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="form-field-username">Ngày bắt đầu <span style="font-size:10px;">(dd-mm-yyyy)</span> <span style="color:red">(*)</span></label>
                                        <div>
                                            <input type="text" id="date_start" name="date_start" required="" placeholder="Ngày bắt đầu" style="width:100%"
                                            onchange="set_date_end(this.value)" class="input-mask-date"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="form-field-username">Ngày kết thúc <span style="font-size:10px;">(dd-mm-yyyy)</span> <span style="color:red">(*)</span></label>
                                        <div>
                                            <input type="text" id="date_end" name="date_end" required="" placeholder="Ngày bắt đầu" style="width:100%" class="input-mask-date"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="form-field-username">Mô tả lớp học</label>
                                        <div>
                                            <textarea id="content" name="content" placeholder="Mô tả lớp học" style="width:100%;height:100px;resize:none"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="space-4"></div>
                                </div>
                                <div class="col-xs-12 text-center">
                                    <button class="btn btn-sm btn-danger" type="button" onclick="canel_form()">
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
                    <div class="col-xs-12 col-sm-7 haft">
                        <table id="list_class" 
                            class="table" 
                            role="grid"
                            aria-describedby="dynamic-table_info"></table>
                        <div id="class_pager"></div>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<!--Form don vi tinh-->
<div id="modal-order-teacher" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    Xếp lớp cho giáo viên
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="fm-order" method="POST" enctype="multipart/form-data">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="form-field-username">
                                    Lựa chọn giáo viên <span style="color:red">(*)
                                </label>
                                <div>
                                    <select class="select2" data-placeholder="Lựa chọn giáo viên..."
                                    style="width:100%" required="" id="user_id" name="user_id">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="form-field-username">Lựa chọn lớp học <span style="color:red">(*)</span></label>
                                <div>
                                    <select class="select2" data-placeholder="Lựa chọn lớp học..."
                                    style="width:100%" required="" id="class_id" name="class_id">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger pull-left" id="close_modal" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    Đóng
                </button>
                <button class="btn btn-sm btn-primary pull-right" id="save_modal" onclick="save_order()">
                    <i class="ace-icon fa fa-save"></i>
                    Ghi dữ liệu
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End formm don vi tinh-->

<script src="<?php echo URL.'/public/' ?>scripts/class_room/index.js"></script>