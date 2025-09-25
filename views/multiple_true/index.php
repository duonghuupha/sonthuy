<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Trắc nghiệm nhiều đáp án đúng</title>
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>multiple_true/quiz-style.css">
    <script>
        var baseUrl = '<?php echo URL ?>';
    </script>
    <script src="<?php echo URL ?>/styles/assets/js/jquery-2.1.4.min.js"></script>
    <script src="<?php echo URL.'/styles/' ?>multiple_true/quiz-plugin.js"></script>
</head>

<body>
    <div class="quiz-container" id="quiz"></div>
    <script>
    $.getJSON('<?php echo URL.'/multiple_true/get_json_question?token='.$_SESSION['data'][0]['token'].'&question_id='.$_REQUEST['question_id'] ?>', function(data) {
        $('#quiz').multiCorrectQuiz({
            questions: data
        });
    });
    </script>
</body>

</html>