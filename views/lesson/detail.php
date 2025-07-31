<?php  
$item = $this->jsonObj;
function getAllParents($childId){
    $sql = new Model();
    $parents = [];
    while ($childId !== null){
        $query = $sql->db->query("SELECT id, title, parent_id FROM tbl_lesson_cate WHERE id = $childId");
        $menu = $query->fetch(PDO::FETCH_ASSOC);
        if($menu){
            $parents[] = $menu;
            $childId = $menu['parent_id'];
        }else{
            break;
        }
    }
    return $parents;
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
                <li class="active">Quản lý bài giảng</li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Chi tiết bài giảng
                    <small class="pull-right">
                        <button class="btn btn-sm btn-success" id="update_personnel" onclick="save_detail(<?php echo $item[0]['id'] ?>)">
                            <i class="ace-icon fa fa-save"></i>
                            Ghi dữ liệu
                        </button>
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-12 col-sm-3">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="form-field-username">Mã bài giảng</label>
                            <div>
                                <b><?php echo $item[0]['code'] ?></b>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="form-field-username">Danh mục</label>
                            <div>
                                <?php
                                $parents = getAllParents($item[0]['cate_id']); $parents = array_reverse($parents);
                                foreach($parents as $row){
                                    $array_title[] = $row['title'];
                                }
                                echo '<b>'.implode("&#8614;", $array_title).'</b>';
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="form-field-username">Tên bài giảng</label>
                            <div>
                                <b><?php echo $item[0]['title'] ?></b>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="form-field-username">Mô tả bài giảng</label>
                            <div>
                                <b><?php echo $item[0]['content'] ?></b>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="form-field-username">Cập nhật lần cuối</label>
                            <div>
                                <b><?php echo $item[0]['create_at'] ?></b>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-9 haft">
                    <div class="col-xs-6">
                        <div class="widget-box widget-color-blue2">
                            <div class="widget-header">
                                <h4 class="widget-title lighter smaller">
                                    File bài giảng
                                    <small class="pull-right">
                                        <a href="#">
                                            <i class="ace-icon fa fa-save"></i>
                                        </a>
                                    </small>
                                </h4>
                            </div>
                            <div class="widget-body" style="overflow: auto;height: calc(100vh/4);">
                                <div class="widget-main padding-8" id="lesson_dc">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="widget-box widget-color-blue2">
                            <div class="widget-header">
                                <h4 class="widget-title lighter smaller">File video / âm thanh</h4>
                            </div>
                            <div class="widget-body" style="overflow: auto;height: calc(100vh/4);">
                                <div class="widget-main padding-8">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="widget-box widget-color-blue2">
                            <div class="widget-header">
                                <h4 class="widget-title lighter smaller">Thẻ từ bài giảng</h4>
                            </div>
                            <div class="widget-body" style="overflow: auto;height: calc(100vh/4);">
                                <div class="widget-main padding-8">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="widget-box widget-color-blue2">
                            <div class="widget-header">
                                <h4 class="widget-title lighter smaller">Câu hỏi tương tác</h4>
                            </div>
                            <div class="widget-body" style="overflow: auto;height: calc(100vh/4);">
                                <div class="widget-main padding-8">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<script src="<?php echo URL.'/public/' ?>scripts/lesson/detail.js"></script>