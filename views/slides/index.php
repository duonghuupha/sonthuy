<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>SONTHUY EDUCATION</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <link rel="stylesheet" href="<?php echo URL ?>/styles/assets/css/roboto.css" />
    <link rel="stylesheet" href="<?php echo URL ?>/styles/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo URL ?>/styles/assets/font-awesome/4.5.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo URL ?>/styles/assets/css/fotorama.css">
    <link rel="stylesheet" href="<?php echo URL ?>/styles/assets/css/slides.css">
    <link rel="shortcut icon" href="<?php echo URL ?>/styles/assets/images/logo_son_thuy.png" />
    <script src="<?php echo URL ?>/styles/assets/js/jquery-2.1.4.min.js"></script>
    <script src="<?php echo URL ?>/styles/assets/js/fotorama.js"></script>
    <script>
        var baseUrl = '<?php echo URL ?>';
    </script>
</head>
<body>
    <div class="content">
        <div class="col-xs-3 left_slide">
            <div class="left_top">
                <span class="title">Danh sách bài giảng</span>
                <span class="search_input">
                        <input type="text" class="form-control" placeholder="Tìm kiếm bài giảng" id="keyword" name="keyword" style="width:100%">
                </span>
            </div>
            <div class="left_center">
                <ul>
                <?php
                foreach($this->jsonObj as $row_lesson){
                    echo '
                    <li><a href="javascript:void(0)" onclick="load_lesson('.$row_lesson['id'].')"><i class="fa fa-cubes"></i>'.$row_lesson['title'].'</a></li>
                    ';
                }
                ?>
                </ul>
            </div>
            <div class="left_bottom">
                <button class="btn btn-success btn-sm" type="button" onclick="window.location.href='<?php echo URL.'/index?token='.$_SESSION['data'][0]['token'] ?>'">
                    <i class="ace-icon fa fa-question bigger-160"></i>
                    Về trang quản lý
                </button>
            </div>
        </div>
        <div class="col-xs-9">
            <div class="row main-slide">
                <div class="col-xs-1 main_left">
                    <div class="left_slide_top">
                        <button class="corner-btn top-left btn-media" title="Media">Media</button>
                    </div>
                    <div class="left_slide_bottom">
                        <button class="corner-btn bottom-left btn-question" title="Question">Question</button>
                    </div>
                </div>
                <div class="col-xs-10 main_center">
                    <div class="lesson_dc"></div>
                </div>
                <div class="col-xs-1 main_right">
                    <div class="right_slide_top">
                        <button class="corner-btn top-right btn-flash" title="Flash Cards">Flash card</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                
    <script src="<?php echo URL ?>/styles/assets/js/bootstrap.min.js"></script>
    <script src="<?php echo URL ?>/public/scripts/slides/index.js"></script>
</body>
</html>