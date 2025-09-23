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
                <fieldset style="margin-top:10px;" id="fm_target_${index}">
                    <legend style="font-weight:normal;font-size:14px;margin-bottom:5px;">
                        Ô đích
                        <a href="javascript:void(0)" onclick="remove_drag_drop_target(${index})">
                            <i class="ace-icon fa fa-trash"></i> 
                        </a>
                    </legend>
                    <form id="target_${index}" method="post" enctype="multipart/form-data">
                        <input type="text" class="form-control" name="target_title_${index}" id="target_title_${index}" value="" 
                        placeholder="Nội dung" onchange="change_data(1, ${index}, 'target')" style="margin-bottom:7px;" required=""/>
                        <input type="file" class="file_attach" name="file_target_${index}" id="file_target_${index}" style="width:100%;" 
                        onchange="change_data(2, ${index}, 'target')"/>
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
                <div class="col-sm-6" id="item_${index}">
                    <fieldset style="margin-top:10px;">
                        <legend style="font-weight:normal;font-size:14px;margin-bottom:5px;">
                            Đáp án
                            <a href="javascript:void(0)" onclick="remove_drag_drop_answer(${index})">
                                <i class="ace-icon fa fa-trash"></i> 
                            </a>
                        </legend>
                        <form id="answer_${index}" method="post" enctype="multipart/form-data">
                            <select class="select2" data-placeholder="Lựa chọn đích..." style="width:100%;" required="" 
                            id="target_${index}" name="target_${index}" data-minimum-results-for-search="Infinity"
                            onchange="change_data_answer(0, ${index}, 'answer')">
                            </select>
                            <input type="text" class="form-control" name="answer_title_${index}" id="answer_title_${index}" value="" required=""
                            placeholder="Nội dung" onchange="change_data_answer(1, ${index}, 'answer')" style="margin-bottom:7px;margin-top:7px;"/>
                            <input type="file" class="file_attach" name="file_answer_${index}" id="file_answer_${index}" style="width:100%;" 
                            onchange="change_data_answer(2, ${index}, 'answer')"/>
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
</script>