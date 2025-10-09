<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li class="">Bài giảng</li>
                <li class="active">Từ vựng</li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Quản lý câu hỏi từ vựng
                    <small class="pull-right">
                        <?php 
                            echo $this->_Convert->return_role_functions_static($this->_Info[0]['id'], 1, 'add()'); // them moi
                            echo $this->_Convert->return_role_functions_static($this->_Info[0]['id'], 2, 'update()'); // cap nhat
                            echo $this->_Convert->return_role_functions_static($this->_Info[0]['id'], 3, 'del()'); // xoa
                        ?>
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <table id="list_vocab" 
                        class="table" 
                        role="grid"
                        aria-describedby="dynamic-table_info"></table>
                    <div id="vocab_pager"></div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<div id="modal-form" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width:80%">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    Thêm mới - Cập nhật câu hỏi
                </div>
            </div>
            <div class="modal-body" style="height:calc(100vh - 200px)">
                <div class="row">
                    <form id="fm" method="POST" enctype="multipart/form-data">
                        <input id="file_old" name="file_old" type="hidden"/>
                        <input id="data_match" name="data_match" type="hidden"/>
                        <input id="data_drag_drop_target" name="data_drag_drop_target" type="hidden"/>
                        <input id="data_drag_drop_answer" name="data_drag_drop_answer" type="hidden"/>
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
                                    <label for="form-field-username">Lựa chọn danh mục <span style="color:red">(*)</span></label>
                                    <div>
                                        <select class="select2" data-placeholder="Lựa chọn danh mục..."
                                        style="width:100%" required="" id="cate_vocab_id" name="cate_vocab_id">
                                        </select>
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
                                        <textarea  id="title" name="title" placeholder="Nội dung câu hỏi" style="width:100%;height:70px;resize:none" required=""></textarea>
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
                <button class="btn btn-sm btn-danger pull-left" id="close_modal" data-dismiss="modal" type="button">
                    <i class="ace-icon fa fa-times"></i>
                    Đóng
                </button>
                <button class="btn btn-sm btn-primary pull-right" id="save_modal" onclick="save()" type="button">
                    <i class="ace-icon fa fa-save"></i>
                    Ghi dữ liệu
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End formm don vi tinh-->

<div id="modal-form-view-question" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width:60%">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    Xem trước câu hỏi
                </div>
            </div>
            <div class="modal-body" style="height:calc(100vh - 200px)" id="form_view_question">
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger pull-right" id="close_modal" data-dismiss="modal" type="button">
                    <i class="ace-icon fa fa-times"></i>
                    Đóng
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End formm don vi tinh-->
<script src="<?php echo URL.'/public/' ?>scripts/vocabulary/index.js"></script>
<script src="<?php echo URL.'/public/' ?>scripts/vocabulary/match.js"></script>
<script src="<?php echo URL.'/public/' ?>scripts/vocabulary/drag_drop.js"></script>