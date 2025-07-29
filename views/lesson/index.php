<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li class="">Bài giảng</li>
                <li class="active">Quản lý bài giảng</li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Quản lý bài giảng
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
                <div class="col-xs-12 col-sm-3">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="form-field-username">Tên bài giảng</label>
                            <div>
                                <input type="text" id="code_search" name="code_search" style="width:100%"placeholder="Mã học sinh"
                                onkeypress="validate(event)"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="form-field-username">Danh   mục</label>
                            <div>
                                <select class="select2" data-placeholder="Lựa chọn lớp học..." style="width:100%"
                                required="" id="class_id_search" name="class_id_search"></select>
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
                <div class="col-xs-12 col-sm-9 haft">
                    <table id="list_lesson" 
                        class="table" 
                        role="grid"
                        aria-describedby="dynamic-table_info"></table>
                    <div id="lesson_pager"></div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<!--Form don vi tinh-->
<div id="modal-lesson" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    Thêm mới - Cập nhật thông tin bài giảng
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="fm" method="POST" enctype="multipart/form-data">
                        <input id="cate_id" name="cate_id" type="hidden"/>
                        <div class="col-xs-6">
                            <div class="widget-box widget-color-blue2">
                                <div class="widget-header">
                                    <h4 class="widget-title lighter smaller">Danh mục bài giảng</h4>
                                </div>
                                <div class="widget-body" style="overflow: auto;height: 283px;">
                                    <div class="widget-main padding-8">
                                        <div id="lesson_cate_tree"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="form-field-username">
                                        Mã bài giảng <span style="color:red">(*)</span> &nbsp;
                                        <a href="javascript:void(0)" onclick="refresh_code()" title="Tạo mã code" id="refreshcode">
                                            <i class="fa fa-refresh"></i>
                                        </a>
                                    </label>
                                    <div>
                                        <input type="text" id="code" name="code" style="width:100%" required="" readonly=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="form-field-username">Tên bài giảng <span style="color:red">(*)</span></label>
                                    <div>
                                        <input type="text" id="title" name="title" required="" placeholder="Tên bài giảng" style="width:100%" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="form-field-username">Mô tả bài giảng</label>
                                    <div>
                                        <textarea  id="content" name="content" placeholder="Mô tả bài giảng" style="width:100%;height:150px;resize:none"></textarea>
                                    </div>
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
                <button class="btn btn-sm btn-primary pull-right" id="save_modal" onclick="save()">
                    <i class="ace-icon fa fa-save"></i>
                    Ghi dữ liệu
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End formm don vi tinh-->

<script src="<?php echo URL.'/public/' ?>scripts/lesson/index.js"></script>