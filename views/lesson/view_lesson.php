<link rel="stylesheet" href="<?php echo URL ?>/styles/assets/css/fotorama.css">
<script src="<?php echo URL ?>/styles/assets/js/fotorama.js"></script>
<div class="col-xs-2" style="display:inline;align-item:right">
    <button class="btn btn-success btn-block" type="button" onclick="view_media(<?php echo $this->lesson_id ?>)">
        <i class="ace-icon fa fa-youtube-play bigger-160"></i>
        Video/Âm thanh
    </button>
    <button class="btn btn-primary btn-block" type="button" onclick="view_flash_card(<?php echo $this->lesson_id ?>)">
        <i class="ace-icon fa fa-cc-mastercard bigger-160"></i>
        Flash Card
    </button>
    <button class="btn btn-info btn-block" type="button" onclick="view_question(<?php echo $this->lesson_id ?>)">
        <i class="ace-icon fa fa-question bigger-160"></i>
        Question
    </button>
</div>
<div class="col-xs-10" style="display:flex;justify-content: center">
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

<!--Form don vi tinh-->
<div id="modal-lesson-media" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    Video - Âm thanh của bài giảng
                </div>
            </div>
            <div class="modal-body" id="height-lesson-media">
                <div class="col-xs-3">
                    <table class="table_modal">
                        <colgroup style="width:10%;"></colgroup>
                        <colgroup style="width:90%;"></colgroup>
                        <thead>
                            <tr>
                                <th style="text-align:center">#</th>
                                <th>Tên file</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach($this->lesson_media as $row_media){
                                $i++;
                            ?>
                            <tr>
                                <td style="text-align:center"><?php echo $i ?></td>
                                <td>
                                    <?php
                                    $ext = pathinfo($row_media['file'], PATHINFO_EXTENSION);
                                    if($ext == 'mp4'){
                                        echo "<a href='javascript:void(0)' onclick=\"play_media(1, ".$this->lesson_id.", '" . $row_media['file'] . "')\">File video số " . $i . "</a>";
                                    }elseif($ext == 'mp3'){
                                        echo "<a href='javascript:void(0)' onclick=\"play_media(2, ".$this->lesson_id.", '" . $row_media['file'] . "')\">File âm thanh số " . $i . "</a>";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-xs-9 text-center" id="play_media">
                    
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger pull-right" id="close_modal" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    Đóng
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End formm don vi tinh-->

<!--Form don vi tinh-->
<div id="modal-lesson-card" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width:60%">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    Flash card của bài giảng
                </div>
            </div>
            <div class="modal-body" id="height-lesson-card" style="display:flex;justify-content: center">
                <div class="flash_card">
                    <?php
                    foreach($this->lesson_card as $row_card){
                    ?>
                    <img src="<?php echo URL.'/public/lesson/'.base64_decode($_REQUEST['id']).'/card/'.$row_card['image'] ?>"/>
                    <?php
                    }
                    ?>
                </div>       
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger pull-right" id="close_modal" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    Đóng
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End formm don vi tinh-->