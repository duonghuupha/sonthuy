<h5 class="mb-3">Danh sách đáp án (tối đa 4) :: Dạng câu hỏi chọn nhiều đáp án đúng</h5>
<!-- Vòng lặp 4 đáp án -->
<div class="row">
<?php
if($_REQUEST['id'] == 0){
    for($i = 1; $i <= 4; $i++){
?>
    <div class="col-xs-12 col-sm-6 widget-container-col" id="widget-container-col-7">
        <div class="widget-box widget-color-dark" id="widget-box-7">
            <div class="widget-header widget-header-small">
                <h6 class="widget-title">Đáp án số <?php echo $i ?></h6>
                <div class="widget-toolbar no-border">
                    <label>
                        <input name="answer_multiple_true_<?php echo $i ?>" id="answer_multiple_true_<?php echo $i ?>" type="checkbox" class="ace" value="1" <?php echo ($i == 1) ? 'checked=""' : '' ?>>
                        <span class="lbl" style="font-size:12px;"> Đáp án đúng</span>
                    </label>
                </div>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <div class="form-group">
                        <label for="form-field-username">
                            Nội dung đáp án <span style="color:red">(*)</span>
                        </label>
                        <div>
                            <input type="text" id="title_multiple_true_<?php echo $i ?>" name="title_multiple_true_<?php echo $i ?>" required="" placeholder="Nội dung đáp án" style="width:100%"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="form-field-username">
                            File media đáp án
                        </label>
                        <div>
                            <input type="file" id="file_multiple_true_<?php echo $i ?>" name="file_multiple_true_<?php echo $i ?>" class="file_attach" style="width:100%"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    }
}else{
    $i = 0;
    foreach($this->jsonObj as $row){
        $i++; $id_answer[] = $row['id'];
?> 
    <div class="col-xs-12 col-sm-6 widget-container-col" id="widget-container-col-7">
        <div class="widget-box widget-color-dark" id="widget-box-7">
            <div class="widget-header widget-header-small">
                <h6 class="widget-title">Đáp án số <?php echo $i ?></h6>
                <div class="widget-toolbar no-border">
                    <label>
                        <input name="answer_multiple_true_<?php echo $row['id'] ?>" id="answer_multiple_true_<?php echo $row['id'] ?>" type="checkbox" class="ace" value="1" <?php echo ($row['answer'] == 1) ? 'checked=""' : '' ?>>
                        <span class="lbl" style="font-size:12px;"> Đáp án đúng</span>
                    </label>
                </div>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <div class="form-group">
                        <label for="form-field-username">
                            Nội dung đáp án <span style="color:red">(*)</span>
                        </label>
                        <div>
                            <input type="text" id="title_multiple_true_<?php echo $row['id'] ?>" name="title_multiple_true_<?php echo $row['id'] ?>" required="" placeholder="Nội dung đáp án" style="width:100%"
                            value="<?php echo $row['title'] ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="form-field-username">
                            File media đáp án
                        </label>
                        <div>
                            <input id="file_old_multiple_true_<?php echo $row['id'] ?>" name="file_old_multiple_true_<?php echo $row['id'] ?>" type="hidden" value="<?php echo $row['file'] ?>"/>
                            <input type="file" id="file_multiple_true_<?php echo $row['id'] ?>" name="file_multiple_true_<?php echo $row['id'] ?>" class="file_attach" style="width:100%"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    }
    echo '
    <div class="col-xs-12" style="display:none">
        <input id="id_answer" name="id_answer" value="'.implode(",", $id_answer).'" type="hidden"/>
    </div>';
}
?>
</div>
<script>
$(function(){
    $('.file_attach').ace_file_input({
        no_file:'Không có file ...',btn_choose:'Lựa chọn',
        btn_change:'Thay đổi',droppable:false,
        onchange:null,thumbnail:true
    });
})
</script>