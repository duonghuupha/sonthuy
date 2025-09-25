<div class="modal-header no-padding">
    <div class="table-header">
        Câu hỏi của bài học
    </div>
</div>
<div class="modal-body" style="height:calc(100vh - 200px)">
    <div class="row">
        <div class="col-xs-2 list_question" style="height:calc(100vh - 230px); border-right: 1px solid #ccc">
            <div class="question-panel">
                <div class="question-list">
                    <?php
                    $i = 0;
                    foreach($this->jsonObj as $row){
                        $i++;
                        echo '
                        <button type="button" onclick="view_question('.$row['id'].', '.$row['type_question'].')" class="btn_'.$row['id'].'">
                            <i class="fa fa-question"></i>
                            Câu hỏi số '.$i.'
                        </button>
                        ';
                    }
                    ?>
                </div>
            </div>
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