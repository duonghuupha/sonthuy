<?php
for($i = 1; $i <= 5; $i++){
?>
<div class="col-sm-4">
    <div class="item_dc">
        <div class="image">
            <img src="<?php echo URL ?>/styles/assets/images/logo_son_thuy.png" class="img-responsive" alt="Lesson Image" style="width:50%">
        </div>
        <div class="order_dc">
            <div class="form-group">
                <label for="form-field-username"></label>
                <div>
                    <input type="text" id="order_dc" name="order_dc" required="" style="width:100%" onkeypress="validate(event)"/>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
?>
<style>
.item_dc{
    border: 1px solid #ccc;
    padding:10px;
    margin-bottom: 10px;
    text-align:center;
    display:flex;
}
</style>