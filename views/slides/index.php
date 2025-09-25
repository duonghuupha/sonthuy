<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài giảng - Son Thuy Education</title>
    <link rel="stylesheet" href="<?php echo URL ?>/styles/assets/css/bootstrap.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URL ?>/styles/assets/css/fotorama.css"/>
    <link rel="stylesheet" href="<?php echo URL ?>/styles/assets/css/slides.css"/>
    <link rel="shortcut icon" href="<?php echo URL ?>/styles/assets/images/logo_son_thuy.png" />
    <script src="<?php echo URL ?>/styles/assets/js/jquery-2.1.4.min.js"></script>
    <script src="<?php echo URL ?>/styles/assets/js/fotorama.js"></script>
    <script>
        var baseUrl = '<?php echo URL ?>';
    </script>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h5>DANH SÁCH BÀI GIẢNG</h5>
        <input type="text" class="form-control" placeholder="Tìm kiếm bài giảng" id="keyword" name="keyword"
        onkeypress="search_lesson()"/>
        <div class="lesson-list" id="result_search_lesson">
            <!--<div class="lesson-item">
                <i class="fa-solid fa-book-open"></i> Unit 1: Hello
            </div>
            <div class="lesson-item">
                <i class="fa-solid fa-book-open"></i> Unit 2: Family
            </div>-->
        </div>
        <button class="btn btn-back mt-4" onclick="window.location.href='<?php echo URL.'/index?token='.$_SESSION['data'][0]['token'] ?>'">
            <i class="fa-solid fa-arrow-left"></i> Về trang quản lý
        </button>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="content-card">
            <!--<h4>Bài giảng sẽ hiển thị tại đây</h4>
            <p>Ví dụ: hình ảnh, sách, flashcard,...</p>-->
            <div class="fotorama" data-nav="thumbs" data-width="800" data-allowfullscreen="true">
                <?php
                foreach($this->json_lesson_dc as $row_dc){
                    echo '<img src="'.URL.'/public/lesson/'.$_REQUEST['id'].'/dc/'.$row_dc['image'].'"/>';
                }
                ?>
            </div>
        </div>
        <!-- Floating Buttons -->
        <button type="button" class="btn-float btn-media" onclick="open_media(<?php echo $_REQUEST['id'] ?>)"><i class="fa-solid fa-photo-film"></i> Media</button>
        <button type="button" class="btn-float btn-flash" onclick="open_flashcard(<?php echo $_REQUEST['id'] ?>)"><i class="fa-solid fa-clone"></i> Flash card</button>
        <button type="button" class="btn-float btn-question" onclick="open_question(<?php echo $_REQUEST['id'] ?>)"><i class="fa-solid fa-circle-question"></i> Question</button>
    </div>
    <div id="modal-lesson-extra" class="modal fade" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content" id="form-detail">
                
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- End formm don vi tinh-->
     <script src="<?php echo URL ?>/styles/assets/js/bootstrap.min.js"></script>
    <script src="<?php echo URL ?>/public/scripts/slides/index.js"></script>
</body>

</html>