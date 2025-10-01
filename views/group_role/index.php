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
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Quản lý nhóm người dùng
                    <small class="pull-right hidden-480">
                        <button type="button" class="btn btn-primary btn-sm" onclick="add()">
                            <i class="fa fa-plus"></i>
                            Thêm mới
                        </button>
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-sm-12">
                    <table id="list_role" 
                        class="table" 
                        role="grid"
                        aria-describedby="dynamic-table_info"></table>
                    <div id="role_pager"></div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<!--Form don vi tinh-->
<div id="modal-role" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width:60%">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    Thêm mới - Cập nhật thông tin nhóm người dùng
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="fm" method="POST" enctype="multipart/form-data">
                        <input id="datadc" name="datadc" type="hidden"/>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="form-field-username">Tiêu đề</label>
                                <div>
                                    <input type="text" id="title" name="title" required=""
                                        placeholder="Tên nhóm người dùng" style="width:100%" />
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12" id="roles" style="height:63vh;overflow:auto"></div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    Đóng
                </button>
                <button class="btn btn-sm btn-primary pull-right" onclick="save()" id="save_form">
                    <i class="ace-icon fa fa-save"></i>
                    Ghi dữ liệu
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End formm don vi tinh-->
<script src="<?php echo URL.'/public/' ?>scripts/users/group_role.js"></script>