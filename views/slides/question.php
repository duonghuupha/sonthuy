<div class="modal-header no-padding">
    <div class="table-header">
        Câu hỏi của bài học
    </div>
</div>
<div class="modal-body" style="height:calc(100vh - 200px)">
    <div class="row">
        <div class="col-xs-2 list_question" style="height:calc(100vh - 230px); border-right: 1px solid #ccc">
            <ul>
                <?php
                foreach($this->jsonObj as $row){
                ?>
                <li>
                    <a href="javascript:void(0)" onclick="view_question(<?php echo $row['id'].', '.$row['type_question'] ?>)">
                        <i class="fa fa-question"></i>
                        Câu hỏi số 1
                    </a>
                </li>
                <?php
                }
                ?>
            </ul>
        </div>
        <div class="col-xs-10" id="content_question">

        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-sm btn-danger pull-right" onclick="close_question()">
        <i class="ace-icon fa fa-times"></i>
        Đóng
    </button>
</div>