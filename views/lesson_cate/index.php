<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li class="">Bài giảng</li>
                <li class="active">Danh mục bài giảng</li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Quản lý danh mục bài giảng
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
                    <div class="col-xs-12 col-sm-5">
                        <form id="fm" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="image_old" name="image_old" />
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="form-field-username">
                                            Mã danh mục <span style="color:red">(*)</span>
                                            <a href="javascript:void(0)" onclick="refresh_code()" title="Tạo mã code"
                                                id="refreshcode">
                                                <i class="fa fa-refresh"></i>
                                            </a>
                                        </label>
                                        <div>
                                            <input type="text" id="code" name="code" required="" placeholder="Mã danh mục" style="width:100%" readonly="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="form-field-username">Hình ảnh dại diện</label>
                                        <div>
                                            <input type="file" id="image" name="image" class="file_attach" style="width:100%"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="form-field-username">Tên danh mục <span
                                                style="color:red">(*)</span></label>
                                        <div>
                                            <input type="text" id="title" name="title" required=""
                                                placeholder="Tên danh mục" style="width:100%" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="form-field-username">Mô tả danh mục</label>
                                        <div>
                                            <textarea id="content" name="content" placeholder="Mô tả lớp học"
                                                style="width:100%;height:100px;resize:none"></textarea>
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
                        <!--<div id="list_lesson_cate" class="dataTables_wrapper form-inline no-footer"></div>-->
                        <table id="list_lesson_cate" 
                            class="table" 
                            role="grid"
                            aria-describedby="dynamic-table_info"></table>
                        <div id="lesson_cate_pager"></div>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<script src="<?php echo URL.'/public/' ?>scripts/lesson/cate.js"></script>