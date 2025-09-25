<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Câu hỏi nối</title>
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>match/style.css">
    <script>
        var baseUrl = '<?php echo URL ?>';
    </script>
    <script src="<?php echo URL ?>/styles/assets/js/jquery-2.1.4.min.js"></script>
    <script src="<?php echo URL.'/styles/' ?>match/plugin.js"></script>
</head>

<body>
    <div class="quiz-container">
        <div id="quiz"></div>
    </div>
    <script>
        $("#quiz").matchingQuiz({
            dataUrl: baseUrl + '/match/get_json_question?token=<?php echo $_SESSION['data'][0]['token'] ?>&question_id=<?php echo $_REQUEST['question_id'] ?>'
        });
    </script>
</body>

</html>