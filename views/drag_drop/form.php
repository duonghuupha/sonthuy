<div class="col-sm-6">
    <div class="widget-box widget-color-blue2">
        <div class="widget-header">
            <h4 class="widget-title lighter smaller">
                Ô đích &nbsp;
                <small>
                    <a href="javascript:void(0)" style="color:white" onclick="add_target()">
                        <i class="ace-icon fa fa-plus"></i>
                    </a>
                </small>
            </h4>
        </div>
        <div class="widget-body">
            <div class="widget-main padding-8" id="drag_drop_target" style="height:calc(100vh - 300px);overflow:auto">
                <?php
                foreach($this->target as $row_t){
                ?>
                <fieldset style="margin-top:10px;" id="fm_target_<?php echo $row_t['id'] ?>">
                    <legend style="font-weight:normal;font-size:14px;margin-bottom:5px;">
                        Ô đích
                        <a href="javascript:void(0)" onclick="remove_drag_drop_target(<?php echo $row_t['id'] ?>)">
                            <i class="ace-icon fa fa-trash"></i> 
                        </a>
                    </legend>
                    <form id="target_<?php echo $row_t['id'] ?>" method="post" enctype="multipart/form-data">
                        <input type="text" class="form-control" name="target_title_<?php echo $row_t['id'] ?>" 
                        id="target_title_<?php echo $row_t['id'] ?>" value="<?php echo $row_t['title'] ?>" 
                        placeholder="Nội dung" onchange="change_data(1, <?php echo $row_t['id_temp'] ?>, 'target', 1, <?php echo $row_t['id'] ?>)" style="margin-bottom:7px;" required=""/>

                        <input id="file_target_old_<?php echo $row_t['id'] ?>" name="file_target_old_<?php echo $row_t['id'] ?>" type="hidden" value="<?php echo $row_t['file'] ?>"/>

                        <input type="file" class="file_attach" name="file_target_<?php echo $row_t['id'] ?>" id="file_target_<?php echo $row_t['id'] ?>" style="width:100%;" 
                        onchange="change_data(2, <?php echo $row_t['id_temp'] ?>, 'target', 1, <?php echo $row_t['id'] ?>)"/>
                    </form>
                </fieldset>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-6">
    <div class="widget-box widget-color-green2">
        <div class="widget-header">
            <h4 class="widget-title lighter smaller">
                Danh sách đáp án &nbsp;
                <small>
                    <a href="javascript:void(0)" style="color:white" onclick="add_answer()">
                        <i class="ace-icon fa fa-plus"></i>
                    </a>
                </small>
            </h4>
        </div>
        <div class="widget-body">
            <div class="widget-main padding-8" id="drag_drop_answer" style="height:calc(100vh - 300px);overflow:auto">
                <?php
                foreach($this->answer as $row_i){
                ?>
                <div class="col-sm-6" id="item_<?php echo $row_i['id'] ?>">
                    <fieldset style="margin-top:10px;">
                        <legend style="font-weight:normal;font-size:14px;margin-bottom:5px;">
                            Đáp án
                            <a href="javascript:void(0)" onclick="remove_drag_drop_answer(<?php echo $row_i['id'] ?>)">
                                <i class="ace-icon fa fa-trash"></i> 
                            </a>
                        </legend>
                        <form id="answer_<?php echo $row_i['id'] ?>" method="post" enctype="multipart/form-data">
                            <select class="select2" data-placeholder="Lựa chọn đích..." style="width:100%;" required="" 
                            id="target_combo_<?php echo $row_i['id'] ?>" name="target_<?php echo $row_i['id'] ?>" data-minimum-results-for-search="Infinity"
                            onchange="change_data_answer(0, <?php echo $row_i['id_temp'] ?>, 'answer', 1, <?php echo $row_i['id'] ?>)">
                            </select>

                            <input type="text" class="form-control" name="answer_title_<?php echo $row_i['id'] ?>" id="answer_title_<?php echo $row_i['id'] ?>" 
                            value="<?php echo $row_i['title'] ?>" required="" placeholder="Nội dung" onchange="change_data_answer(1, <?php echo $row_i['id_temp'] ?>, 'answer', 1, <?php echo $row_i['id'] ?>)" 
                            style="margin-bottom:7px;margin-top:7px;"/>

                            <input id="file_answer_old_<?php echo $row_i['id'] ?>" name="file_answer_old_<?php echo $row_i['id'] ?>" type="hidden" value="<?php echo $row_i['file'] ?>"/>

                            <input type="file" class="file_attach" name="file_answer_<?php echo $row_i['id'] ?>" id="file_answer_<?php echo $row_i['id'] ?>" style="width:100%;" 
                            onchange="change_data_answer(2, <?php echo $row_i['id_temp'] ?>, 'answer', 1, <?php echo $row_i['id'] ?>)"/>
                        </form>
                    </fieldset>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script>
$('.file_attach').ace_file_input({
    no_file:'Không có file ...',btn_choose:'Lựa chọn',
    btn_change:'Thay đổi',droppable:false,
    onchange:null,thumbnail:true
});
<?php
foreach($this->answer as $row_item){
?>
combo_select_2('#target_combo_<?php echo $row_item['id'] ?>', baseUrl + '/drag_drop/combo_target?token='+localStorage.getItem('token')+'&code_question=<?php echo $row_item['code_question'] ?>', <?php echo $row_item['target_id'] ?>, '<?php echo $row_item['target_title'] ?>');
<?php
}
?>
</script>