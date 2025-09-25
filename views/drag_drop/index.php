<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Demo DragDrop Quiz Plugin v2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>drag_drop/quiz-style.css">
    <script>
        var baseUrl = '<?php echo URL ?>';
    </script>
    <script src="<?php echo URL ?>/styles/assets/js/jquery-2.1.4.min.js"></script>
    <script src="<?php echo URL.'/styles/' ?>drag_drop/quiz-plugin.js"></script>
</head>

<body>
    <div id="quiz"></div>
    <script>
    $('#quiz').dragDropQuiz({
        data: baseUrl + '/drag_drop/get_json_question?token=<?php echo $_SESSION['data'][0]['token'] ?>&question_id=<?php echo $_REQUEST['question_id'] ?>',
        onComplete: function(correct, total) {
            //alert(`Bạn đã làm đúng ${correct} / ${total}`);
        }
    });
    </script>
</body>

</html>