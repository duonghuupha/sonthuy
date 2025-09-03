<?php
$item = $this->jsonObj;
?>
<div class="col-xs-4" style="display:none">
    <input id="id_sort_alphabet" name="id_sort_alphabet" value="<?php echo $item[0]['id'] ?>" type="hidden"/>
</div>
<div class="col-xs-4">
    <div class="form-group">
        <label for="form-field-username">Nhập câu trả lời <span style="color:red">(*)</span></label>
        <div>
            <input type="text" id="answer_sort_alphabet" name="answer_sort_alphabet" required="" placeholder="Câu trả lời"/>
        </div>
    </div>
</div>
<script>
$(function(){
    $('.select2').select2();
})
</script>