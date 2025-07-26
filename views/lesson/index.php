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
                <div class="col-xs-12 col-sm-4">
                    
                </div>
                <div class="col-xs-12 col-sm-8 haft">
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
    <div class="modal-dialog" style="width:80%">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    Thêm mới - Cập nhật thông tin bài giảng
                </div>
            </div>
            <div class="modal-body" style="height:calc(100vh - 200px); overflow: auto;">
                <div class="row">
                    <form id="fm" method="POST" enctype="multipart/form-data">
                        <div class="col-sm-3">
                            <h3 class="header smaller lighter blue">Thông tin chung của bài giảng</h3>
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
                                    <label for="form-field-username">Lựa chọn danh mục <span style="color:red">(*)</span></label>
                                    <div class="input-group">
                                        <input type="text" id="fullname_sign" name="fullname_sign" required=""
                                        placeholder="Click Go! để lựa chọn" style="width:100%;" readonly=""/>
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm btn-primary" type="button" onclick="select_user_sign()">
                                                <i class="ace-icon fa fa-users bigger-110"></i>
                                                Go!
                                            </button>
                                        </span>
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
                        </div>
                        <div class="col-sm-3">
                            <div class="widget-box widget-color-blue2">
                                <div class="widget-header">
                                    <h4 class="widget-title lighter smaller">Hình ảnh tài liệu bài giảng</h4>
                                </div>
                                <div class="widget-body" style="height:calc(100vh - 300px); overflow: auto;">
                                    <div class="widget-main padding-3">
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <label for="form-field-username">
                                                    Lựa chọn hình ảnh <span style="color:red">(*)</span>
                                                </label>
                                                <div>
                                                    <input type="file" id="image_dc" name="image_dc[]" class="file_attach" style="width:100%"
                                                    accept="image/png, image/gif, image/jpeg" onchange="check_type_image('#image_dc')" multiple=""/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12" id="content_dc" style="padding:0px;">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="widget-box widget-color-blue2">
                                <div class="widget-header">
                                    <h4 class="widget-title lighter smaller">File âm thanh - video của bài giảng</h4>
                                </div>
                                <div class="widget-body" style="height:calc(100vh - 300px); overflow: auto;">
                                    <div class="widget-main padding-8">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="widget-box widget-color-blue2">
                                <div class="widget-header">
                                    <h4 class="widget-title lighter smaller">Hình ảnh thẻ từ liên quan bài giảng</h4>
                                </div>
                                <div class="widget-body" style="height:calc(100vh - 300px); overflow: auto;">
                                    <div class="widget-main padding-8">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger pull-left" id="close_modal" onclick="cancel()">
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