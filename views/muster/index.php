<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li>Học sinh</li>
                <li class="active">Chuyên cần</li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Chuyên cần của học sinh
                    <small class="pull-right">
                        <button class="btn btn-sm btn-primary" onclick="manager_muster()">
                            <i class="ace-icon fa fa-newspaper-o"></i>
                            Quản lý chuyên cần học sinh
                        </button>
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-12 col-sm-12" id="form_search_muster">
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label for="form-field-username">Lựa chọn lớp để điểm danh</label>
                            <div>
                                <select class="select2" data-placeholder="Lựa chọn lớp học..." style="width:100%"
                                id="class_id" name="class_id"></select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label for="form-field-username"></label>
                            <div>
                                <span><i>Lựa chọn lớp học để thực hiện điểm danh. Thời gian điểm danh sẽ theo thời gian thực</i>. <b>Điểm danh ngày hôm nay <?php echo date("d-m-Y") ?></b></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="form-field-username"></label>
                            <div>
                                <h3 class="header smaller lighter blue" style="margin-bottom:0px;">Dữ liệu điểm danh ngày <b><?php echo date("d-m-Y") ?></b></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6">
                    <table id="list_student" class="table" role="grid" aria-describedby="dynamic-table_info"></table>
                    <div id="student_pager"></div>
                </div><!-- /.col -->
                <div class="col-xs-6 col-sm-6">
                    <table id="list_student_muster" class="table" role="grid" aria-describedby="dynamic-table_info"></table>
                    <div id="student_muster_pager"></div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<!--Form don vi tinh-->
<div id="modal-muster" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width:70%">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    Quản lý chuyên cần học sinh
                </div>
            </div>
            <div class="modal-body" style="height:calc(100vh - 200px);">
                <div class="row">
                    <div class="col-xs-4">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="form-field-username">Lựa chọn lớp để điểm danh</label>
                                <div>
                                    <select class="select2" data-placeholder="Lựa chọn lớp học..." style="width:100%"
                                    id="class_id_total" name="class_id_total"></select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                             <div class="calendar">
                                <div class="calendar-header">
                                    <button class="btn btn-sm btn-info" onclick="changeMonth(-1)">← Tháng trước</button>
                                    <h3 id="month-year"></h3>
                                    <button class="btn btn-sm btn-info" onclick="changeMonth(1)">Tháng sau →</button>
                                </div>

                                <table>
                                    <thead>
                                        <tr>
                                            <th>CN</th>
                                            <th>T2</th>
                                            <th>T3</th>
                                            <th>T4</th>
                                            <th>T5</th>
                                            <th>T6</th>
                                            <th>T7</th>
                                        </tr>
                                    </thead>
                                    <tbody id="calendar-body"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-8">
                        <table id="list_muster_total" class="table" role="grid" aria-describedby="dynamic-table_info"></table>
                        <div id="muster_total_pager"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger pull-right" id="close_modal" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    Đóng
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End formm don vi tinh-->

<script src="<?php echo URL.'/public/' ?>scripts/students/muster.js"></script>