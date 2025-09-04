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
            <div class="row">
                <div class="col-xs-12 col-sm-4 half">
                    <h3 class="header smaller lighter blue">
                        Danh mục / nhóm từ vựng
                    </h3>
                    <div class="col-xs-12 col-sm-12" id="btn_cate">
                        <button type="button" class="btn btn-primary btn-sm pull-left" onclick="add_cate()" id="add_row">
                            <i class="fa fa-plus"></i>
                            Thêm mới
                        </button>
                        <button type="button" class="btn btn-success btn-sm pull-left" onclick="save_cate(0, 0)" id="save_row">
                            <i class="fa fa-save"></i>
                            Ghi dữ liệu
                        </button>
                        <button type="button" class="btn btn-danger btn-sm pull-left" onclick="del_cate()" id="del_row">
                            <i class="fa fa-trash"></i>
                            Xóa
                        </button>
                        <button type="button" class="btn btn-info btn-sm pull-left" onclick="cancel_cate(0)" id="cancel_row">
                            <i class="fa fa-times"></i>
                            Hủy bỏ
                        </button>
                    </div>
                    <div class="col-xs-12 col-sm-12">
                        <div class="space-4"></div>
                    </div>
                    <div class="col-xs-12 col-sm-12">
                        <table id="list_cate" 
                            class="table" 
                            role="grid"
                            aria-describedby="dynamic-table_info"></table>
                        <div id="cate_pager"></div>
                    </div>
                </div><!-- /.col -->
                <div class="col-xs-12 col-sm-8 half">
                    <h3 class="header smaller lighter blue">
                        Danh sách câu hỏi
                        <a href="javascript:void(0)" class="btn-sm" title="Thêm mới" onclick="add_level()">
                            <i class="fa fa-plus"></i>
                        </a>
                    </h3>
                    <table id="list_vocab"></table>
                    <div id="vocab_pager"></div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<div id="modal-form" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" id="form">
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End formm don vi tinh-->

<script src="<?php echo URL.'/public/' ?>scripts/vocabulary/cate.js"></script>
<script src="<?php echo URL.'/public/' ?>scripts/vocabulary/index.js"></script>