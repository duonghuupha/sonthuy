<div class="col-xs-4">
    <div class="form-group">
        <label for="form-field-username">Lựa chọn đáp án <span style="color:red">(*)</span></label>
        <div>
            <select class="select2" data-placeholder="Lựa chọn đáp án..."
            style="width:100%" required="" id="true_false_value" name="true_false_value"
            data-minimum-results-for-search="Infinity">
                <option value="">Lựa chọn đáp án</option>
                <option value="1">Đúng</option>
                <option value="2">Sai</option>
            </select>
        </div>
    </div>
</div>
<script>
$(function(){
    $('.select2').select2();
})
</script>