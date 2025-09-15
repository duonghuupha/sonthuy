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
                <div class="col-xs-12 col-sm-6">
                    <table id="list_lesson_question" 
                        class="table" 
                        role="grid"
                        aria-describedby="dynamic-table_info"></table>
                    <div id="lesson_question_pager"></div>
                </div>
                <div class="col-xs-12 col-sm-6 haft" id="view_question">
                    
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<!--Form don vi tinh-->
<div id="modal-lesson-question" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width:80%">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    Thêm mới - Cập nhật câu hỏi cho bài giảng
                </div>
            </div>
            <div class="modal-body" style="height:calc(100vh - 200px)">
                <div class="row">
                    <form id="fm" method="POST" enctype="multipart/form-data">
                        <input id="lesson_id" name="lesson_id" type="hidden" value="<?php echo base64_decode($_REQUEST['id']) ?>"/>
                        <input id="file_old" name="file_old" type="hidden"/>
                        <input id="data_match" name="data_match" type="hidden"/>
                        <div class="col-xs-4">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="form-field-username">
                                        Mã bài giảng <span style="color:red">(*)</span>
                                    </label>
                                    <div>
                                        <input type="text" id="code" name="code" required="" placeholder="Mã câu hỏi" style="width:100%" readonly=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="form-field-username">Loại câu hỏi <span style="color:red">(*)</span></label>
                                    <div>
                                        <select class="select2" data-placeholder="Lựa chọn loại câu hỏi..."
                                        style="width:100%" required="" id="type_question" name="type_question"
                                        data-minimum-results-for-search="Infinity" onchange="set_load_form(this.value)">
                                            <option value="">Lựa chọn loại câu hỏi</option>
                                            <option value="1">Đúng / Sai</option>
                                            <option value="2">1 Đáp án đúng</option>
                                            <option value="3">Nhiều đáp án đúng</option>
                                            <option value="4">Nối</option>
                                            <option value="5">Kéo thả</option>
                                            <option value="6">Sắp xếp chữ cái</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="form-field-username">Nội dung câu hỏi <span style="color:red">(*)</span></label>
                                    <div>
                                        <textarea  id="title" name="title" placeholder="Nội dung câu hỏi" style="width:100%;height:70px;resize:none"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="form-field-username">File âm thanh/video/hình ảnh</label>
                                    <div>
                                        <input type="file" id="file" name="file" class="file_attach" style="width:100%"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-8" id="form_type">
                            
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

<script src="<?php echo URL.'/public/' ?>scripts/lesson/question/index.js"></script>
<script src="<?php echo URL.'/public/' ?>scripts/lesson/question/match.js"></script>