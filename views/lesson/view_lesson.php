<link rel="stylesheet" href="<?php echo URL ?>/styles/assets/css/fotorama.css">
<script src="<?php echo URL ?>/styles/assets/js/fotorama.js"></script>
<div class="col-xs-2" style="display:inline;align-item:right">
    <button class="btn btn-success btn-block" type="button">
        <i class="ace-icon fa fa-youtube-play bigger-160"></i>
        Media
    </button>
    <button class="btn btn-primary btn-block" type="button">
        <i class="ace-icon fa fa-cc-mastercard bigger-160"></i>
        Card
    </button>
    <button class="btn btn-info btn-block" type="button">
        <i class="ace-icon fa fa-question bigger-160"></i>
        Question
    </button>
</div>
<div class="col-xs-10">
    <div class="fotorama" data-nav="thumbs" data-width="800" data-allowfullscreen="true">
        <?php
        foreach($this->lesson_dc as $row_dc){
        ?>
        <img src="<?php echo URL.'/public/lesson/'.base64_decode($_REQUEST['id']).'/dc/'.$row_dc['image'] ?>"/>
        <?php
        }
        ?>
    </div>                     
</div>