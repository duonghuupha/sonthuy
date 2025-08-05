<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li class="">Bài giảng</li>
                <li class="">Quản lý bài giảng</li>
                <li class="active">Câu hỏi tương tác của bài giảng</li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Câu hỏi tương tác của bài giảng
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

<script src="<?php echo URL.'/public/' ?>scripts/lesson/question/true_false.js"></script>