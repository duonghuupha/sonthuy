<div class="modal-header no-padding">
    <div class="table-header">
        Video - Âm thanh của bài giảng
    </div>
</div>
<div class="modal-body">
    <div class="top-media">
        <?php
        foreach($this->jsonObj as $row){
            $ext_file = pathinfo($row['file'], PATHINFO_EXTENSION);
            if($ext_file == 'mp4'){
        ?>
        <div class="item">
            <a href="javascript:void(0)" onclick="play_media(1, <?php echo $_REQUEST['id'] ?>, '<?php echo $row['file'] ?>')">
                <i class="fa fa-youtube-play"></i>
                <?php echo $row['order_media'] ?>
            </a>
        </div>
        <?php
            }else{
        ?>
        <div class="item">
            <a href="javascript:void(0)" onclick="play_media(2, <?php echo $_REQUEST['id'] ?>, '<?php echo $row['file'] ?>')">
                <i class="fa fa-music"></i>
                <?php echo $row['order_media'] ?>
            </a>
        </div>
        <?php
            }
        }
        ?>
    </div>
    <div class="main-media"></div>
</div>
<div class="modal-footer">
    <button class="btn btn-sm btn-danger pull-right" onclick="close_media()">
        <i class="ace-icon fa fa-times"></i>
        Đóng
    </button>
</div>