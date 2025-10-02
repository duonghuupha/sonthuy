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
                        <form id="fm" method="post">
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
                                            <input type="text" id="code" name="code" required=""
                                                placeholder="Mã danh mục" style="width:100%" readonly="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="form-field-username">Lựa chọn danh mục cha</label>
                                        <div>
                                            <select class="select2" data-placeholder="Lựa chọn danh mục..." style="width:100%" id="parent_id" name="parent_id">
                                                <option value="">Lựa chọn danh mục</option>
                                                <?php show_parent_lesson_cate($this->jsonObj) ?>
                                            </select>
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
                        <div class="widget-box widget-color-blue2">
                            <div class="widget-header">
                                <h4 class="widget-title lighter smaller">Danh mục bài giảng</h4>
                            </div>
                            <div class="widget-body" style="overflow: auto;height: calc(100vh - 280px);">
                                <div class="widget-main padding-8">
                                    <?php
                                    function show_tree_view_lesson_cate($categories, $parent_id = 0, $char = ''){
                                        $cate_child = array();
                                        foreach ($categories as $key => $item){
                                            if ($item['parent_id'] == $parent_id){
                                                $cate_child[] = $item;
                                                unset($categories[$key]);
                                            }
                                        }
                                        if ($cate_child){
                                            echo '<ul class="tree tree-unselectable tree-branch-children" role="tree">';
                                            foreach ($cate_child as $key => $item){
                                                echo '
                                                <li id="tree_view_'.$item['id'].'" class="tree-branch tree-open" role="treeitem" aria-expanded="true" onclick="set_active_lesson_cate('.$item['id'].')">
                                                    <div class="tree-branch-header"> 
                                                        <span class="tree-branch-name"> 
                                                            <i class="icon-folder ace-icon tree-minus"></i> 
                                                            <span class="tree-label">'.$item['title'].'</span> 
                                                        </span> 
                                                    </div>
                                                ';
                                                show_tree_view_lesson_cate($categories, $item['id'], $char.'|---');
                                                echo '</li>';
                                            }
                                            echo '</ul>';
                                        }
                                    }
                                    show_tree_view_lesson_cate($this->jsonObj);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<script src="<?php echo URL.'/public/' ?>scripts/lesson/cate.js"></script>