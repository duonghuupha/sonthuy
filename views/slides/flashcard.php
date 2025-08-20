<div class="modal-header no-padding">
    <div class="table-header">
        Flash Card
    </div>
</div>
<div class="modal-body">
    <div class="flash_card">
        <?php
        foreach($this->jsonObj as $row){
            echo '<img src="'.URL.'/public/lesson/'.$_REQUEST['id'].'/card/'.$row['image'].'"/>';
        }
        ?>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-sm btn-danger pull-right" onclick="close_flash_card()">
        <i class="ace-icon fa fa-times"></i>
        Đóng
    </button>
</div>