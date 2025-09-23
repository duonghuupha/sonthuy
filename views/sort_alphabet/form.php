<?php
$item = $this->jsonObj;
?>
<div class="col-xs-4" style="display:none">
    <input id="id_sort_alphabet" name="id_sort_alphabet" value="<?php echo $item[0]['id'] ?>" type="hidden"/>
</div>
<div class="col-xs-6">
    <div class="form-group">
        <label for="form-field-username">Nhập câu trả lời <span style="color:red">(*)</span></label>
        <div>
            <input type="text" id="answer_sort_alphabet" name="answer_sort_alphabet" required="" placeholder="Câu trả lời"
            style="text-transform:uppercase;width:100%" oninput="this.value = this.value.toUpperCase()" value="<?php echo $item[0]['answer'] ?>"/>
        </div>
    </div>
</div>