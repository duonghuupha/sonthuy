<?php
for($i = 1; $i <= 5; $i++){
?>
<div class="col-sm-6">
    <div class="image">
        <img src="<?php echo URL ?>/styles/assets/images/logo_son_thuy.png" class="img-responsive" alt="Lesson Image">
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
<?php
}
?>