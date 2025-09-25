<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quiz Đúng/Sai</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>true_false/quiz-style.css">
    <script>
        var baseUrl = '<?php echo URL ?>';
    </script>
    <script src="<?php echo URL ?>/styles/assets/js/jquery-2.1.4.min.js"></script>
    <script src="<?php echo URL.'/styles/' ?>true_false/quiz-plugin.js"></script>
</head>

<body>
    <div id="quiz-container">Đang tải câu hỏi...</div>
    <script>
    $(function() {
        $.getJSON('<?php echo URL.'/true_false/get_json_question?token='.$_SESSION['data'][0]['token'].'&question_id='.$_REQUEST['question_id'] ?>', function(data) {
            $('#quiz-container').trueFalseQuiz({
                questions: data
            });
        }).fail(function() {
            $('#quiz-container').text("Không thể tải câu hỏi. Vui lòng kiểm tra file JSON.");
        });
    });
    </script>
</body>

</html>