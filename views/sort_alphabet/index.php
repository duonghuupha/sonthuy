<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Sắp xếp từ - jQuery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>sort_alphabet/sort-style.css">
    <script>
        var baseUrl = '<?php echo URL ?>';
    </script>
    <script src="<?php echo URL ?>/styles/assets/js/jquery-2.1.4.min.js"></script>
    <script src="<?php echo URL.'/styles/' ?>sort_alphabet/sort-plugin.js"></script>
</head>

<body>
    <div id="sort-quiz"></div>

    <script>
    $('#sort-quiz').sortQuiz({
        data: '<?php echo URL.'/sort_alphabet/get_json_question?token='.$_SESSION['data'][0]['token'].'&question_id='.$_REQUEST['question_id'] ?>',
        soundCorrect: baseUrl + '/styles/assets/audio/Dung.mp3',
        soundWrong: baseUrl + '/styles/assets/audio/Sai.mp3',
        onComplete: function(isCorrect) {
            //alert(isCorrect ? "Chính xác!" : "Chưa đúng, thử lại nhé.");
        }
    });
    </script>
</body>

</html>