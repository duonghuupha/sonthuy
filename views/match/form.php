<h5 class="mb-3">
    Danh sách đáp án cho câu hỏi nối
    <button class="btn btn-sm btn-success pull-right" onclick="add_match_answer()" type="button"
        id="select_devices">
        <i class="ace-icon fa fa-question"></i>
        Thêm mới (s)
    </button>
</h5>
<div class="row">
    <div class="col-xs-12">
        <table class="table_modal">
            <colgroup style="width:47%;"></colgroup>
            <colgroup style="width:47%;"></colgroup>
            <colgroup style="width:6%;"></colgroup>
            <thead>
                <tr>
                    <th style="text-align:center">Cột A</th>
                    <th style="text-align:center">Cột B</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="table_match_tbody">
                <?php
                foreach($this->detail as $row){
                ?>
                <tr id="row_<?php echo $row['id'] ?>">
                    <td style="width:45%;height:100px">
                        <form id="left_title_<?php echo $row['id'] ?>" method="post" enctype="multipart/form-data">
                            <input type="text" class="form-control" name="answer_left_<?php echo $row['id'] ?>" id="answer_left_<?php echo $row['id'] ?>" value="<?php echo $row['answer_a'] ?>" 
                            placeholder="Nội dung" onchange="change_data_match(1, <?php echo $row['id_temp'] ?>, 'left_title_', 1, <?php echo $row['id'] ?>)" style="margin-bottom:7px;"/>
                        </form>
                        <form id="left_file_<?php echo $row['id'] ?>">
                            <input id="file_left_old_<?php echo $row['id'] ?>" name="file_left_old_<?php echo $row['id'] ?>" type="hidden" value="<?php echo $row['file_a'] ?>"/>
                            <input type="file" class="file_attach" name="file_left_<?php echo $row['id'] ?>" id="file_left_<?php echo $row['id'] ?>" style="width:100%;" 
                            onchange="change_data_match(2, <?php echo $row['id_temp'] ?>, 'left_file_', 1, <?php echo $row['id'] ?>)"/>
                        </form>
                        </td>
                    <td style="width:45%">
                        <form id="right_title_<?php echo $row['id'] ?>" method="post" enctype="multipart/form-data">
                            <input type="text" class="form-control" name="answer_right_<?php echo $row['id'] ?>" id="answer_right_<?php echo $row['id'] ?>" value="<?php echo $row['answer_b'] ?>" 
                            placeholder="Nội dung" onchange="change_data_match(3, <?php echo $row['id_temp'] ?>, 'right_title_', 1, <?php echo $row['id'] ?>)" style="margin-bottom:7px;"/>
                        </form>
                        <form id="right_file_<?php echo $row['id'] ?>">
                            <input id="file_right_old_<?php echo $row['id'] ?>" name="file_right_old_<?php echo $row['id'] ?>" type="hidden" value="<?php echo $row['file_b'] ?>"/>
                            <input type="file" class="file_attach" name="file_right_<?php echo $row['id'] ?>" id="file_right_<?php echo $row['id'] ?>" style="width:100%;" 
                            onchange="change_data_match(4, <?php echo $row['id_temp'] ?>, 'right_file_', 1, <?php echo $row['id'] ?>)"/>
                        </form>
                        </td>
                    <td style="width:5%;text-align:center">
                        <a href="javascript:void(0)" onclick="remove_match_answer(<?php echo $row['id'] ?>)" title="Xóa" style="color:red">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
                <?php
                }
                ?>  
            </tbody>
        </table>
    </div>
</div>
<script>
    $('.file_attach').ace_file_input({
        no_file:'Không có file ...',btn_choose:'Lựa chọn',
        btn_change:'Thay đổi',droppable:false,
        onchange:null,thumbnail:true
    });
</script>