<?php
function show_parent_lesson_cate($categories, $parent_id = 0, $char = ''){
    foreach ($categories as $key => $item){
        if ($item['parent_id'] == $parent_id){
            echo '<option value="'.$item['id'].'">';
                echo $char . $item['title'];
            echo '</option>';
            unset($categories[$key]);
            show_parent_lesson_cate($categories, $item['id'], $char.'|---');
        }
    }
}
?>
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
                <div class="col-xs-12 col-sm-12">
                    <div class="col-xs-12 col-sm-5">
                        <form id="fm" method="post">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="form-field-username">
                                            Mã danh mục <span style="color:red">(*)</span>
                                            <a href="javascript:void(0)" onclick="refresh_code()" title="Tạo mã code" id="refreshcode">
                                                <i class="fa fa-refresh"></i>
                                            </a>
                                        </label>
                                        <div>
                                            <input type="text" id="code" name="code" required="" placeholder="Mã danh mục" 
                                            style="width:100%" readonly=""/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="form-field-username">Lựa chọn danh mục cha</label>
                                        <div>
                                            <select class="select2" data-placeholder="Lựa chọn danh mục..."
                                            style="width:100%" id="parent_id" name="parent_id"
                                            data-minimum-results-for-search="Infinity">
                                                <option value="">Lựa chọn danh mục</option>
                                                <?php show_parent_lesson_cate($this->jsonObj) ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="form-field-username">Tên danh mục <span style="color:red">(*)</span></label>
                                        <div>
                                            <input type="text" id="title" name="title" required="" placeholder="Tên danh mục" style="width:100%" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="form-field-username">Mô tả danh mục</label>
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
                        <div id="list_lesson_cate" class="dataTables_wrapper form-inline no-footer"></div>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<script src="<?php echo URL.'/public/' ?>scripts/lesson/cate.js"></script>