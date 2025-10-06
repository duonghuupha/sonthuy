<?php  
$item = $this->jsonObj;
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
                        <button class="btn btn-sm btn-primary" type="button" onclick="window.location.href='<?php echo URL.'/lesson?token='.$_SESSION['data'][0]['token'] ?>'">
                            <i class="ace-icon fa fa-reply icon-only"></i>
                            Quay lại
                        </button>
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-12 col-sm-4">
                    <div id="accordion" class="accordion-style1 panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                        <i class="ace-icon fa fa-angle-down bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                        &nbsp;Thông tin bài giảng
                                    </a>
                                </h4>
                            </div>
                            <div class="panel-collapse collapse in" id="collapseOne" data-value="<?php echo $item[0]['id'] ?>">
                                <div class="panel-body">
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
                                                <b><?php echo $item[0]['cate_title'] ?></b>
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
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                        <i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                        &nbsp;File bài giảng
                                    </a>
                                </h4>
                            </div>
                            <div class="panel-collapse collapse" id="collapseTwo" data-value="<?php echo $item[0]['id'] ?>">
                                <div class="panel-body">
                                    <div class="col-xs-12">
                                        <form id="fm-dc" method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <div>
                                                    <input type="file" id="image" name="image[]" class="file_attach" style="width:100%"
                                                    accept="image/png, image/gif, image/jpeg" onchange="upload_dc(<?php echo $item[0]['id']?>)" multiple=""/>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-xs-12">
                                        <table id="list_lesson_dc" 
                                            class="table" 
                                            role="grid"
                                            aria-describedby="dynamic-table_info"></table>
                                        <div id="lesson_dc_pager"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                        <i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                        &nbsp;File video/âm thanh
                                    </a>
                                </h4>
                            </div>
                            <div class="panel-collapse collapse" id="collapseThree" data-value="<?php echo $item[0]['id'] ?>">
                                <div class="panel-body">
                                    <div class="col-xs-12">
                                        <form id="fm-media" method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <div>
                                                    <input type="file" id="media" name="media[]" class="file_attach" style="width:100%"
                                                    accept=".mp4,.mp3,.html,video/mp4,audio/mpeg,text/html" onchange="upload_media(<?php echo $item[0]['id']?>)" multiple=""/>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-xs-12">
                                        <table class="table_modal">
                                            <colgroup style="width:150px;"></colgroup>
                                            <colgroup style="width:50px;"></colgroup>
                                            <colgroup style="width:20px;"></colgroup>
                                            <thead>
                                                <tr>
                                                    <th>Tên file</th>
                                                    <th style="text-align:center">Thứ tự hiển thị</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_lesson_media">
                                                <tr>
                                                    <td>asdfafasfasd</td>
                                                    <td>
                                                        <input type="text" id="order_media" name="order_media" class="form-controll" style="width:100%"
                                                        onkeypress="validate(event)"/>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                        <i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                        &nbsp;Thẻ từ bài giảng
                                    </a>
                                </h4>
                            </div>
                            <div class="panel-collapse collapse" id="collapseFour" data-value="<?php echo $item[0]['id'] ?>">
                                <div class="panel-body">
                                    <div class="col-xs-12">
                                        <form id="fm-card" method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <div>
                                                    <input type="file" id="card" name="card[]" class="file_attach" style="width:100%"
                                                    accept="image/png, image/gif, image/jpeg" onchange="upload_card(<?php echo $item[0]['id']?>)" multiple=""/>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-xs-12">
                                        <table class="table_modal">
                                            <colgroup style="width:150px;"></colgroup>
                                            <colgroup style="width:50px;"></colgroup>
                                            <colgroup style="width:20px;"></colgroup>
                                            <thead>
                                                <tr>
                                                    <th>Tên file</th>
                                                    <th style="text-align:center">Thứ tự hiển thị</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_lesson_card">
                                                <tr>
                                                    <td>asdfafasfasd</td>
                                                    <td>
                                                        <input type="text" id="order_media" name="order_media" class="form-controll" style="width:100%"
                                                        onkeypress="validate(event)"/>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                                        <i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                        &nbsp;Câu hỏi tương tác
                                    </a>
                                </h4>
                            </div>
                            <div class="panel-collapse collapse" id="collapseFive" data-value="<?php echo $item[0]['id'] ?>">
                                <div class="panel-body">
                                    <button class="btn btn-success btn-block" type="button" onclick="window.location.href='<?php echo URL.'/question?token='.$_SESSION['data'][0]['token'].'&id='.base64_encode($item[0]['id']) ?>'">
                                        <i class="ace-icon fa fa-question bigger-160"></i>
                                        Mở trang thiết kế câu hỏi tương tác
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-8 haft" id="view_lesson"></div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<!--Form don vi tinh-->
<div id="modal-lesson" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" id="document_lesson">
    </div><!-- /.modal-dialog -->
</div>
<!-- End formm don vi tinh-->

<script src="<?php echo URL.'/public/' ?>scripts/lesson/detail.js"></script>
<script src="<?php echo URL.'/public/' ?>scripts/lesson/dc.js"></script>
<script src="<?php echo URL.'/public/' ?>scripts/lesson/view_lesson.js"></script>