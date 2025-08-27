<?php
class Match extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        $this->view->render('match/index');
    }

    function form(){
        $this->view->render('match/form');
    }

    function get_json_question(){
        /*$question_id = isset($_REQUEST['question_id']) ? $_REQUEST['question_id'] : 0;
        $data = $this->model->get_json_question_Obj($question_id);
        if($data){
            $code = $data[0]['code'];
            $detail = $this->model->get_detail_question($code);
            $info = $this->model->get_info($question_id);
            $questions = [];
            $answers = [];
            foreach($detail as $row){
                $questions[] = [
                    'id' => $row['id'],
                    'type' => ($row['file'] != '') ? 'image' : 'text',
                    'content' => ($row['file'] != '') ? URL.'/styles/question/Noi/'.$row['file'] : $row['title']
                ];
                $answers[] = [
                    'id' => $row['id'],
                    'type' => ($row['file'] != '') ? 'image' : 'text',
                    'content' => ($row['file'] != '') ? URL.'/styles/question/Noi/'.$row['file'] : $row['answer']
                ];
            }
            $result = [
                'questionText' => isset($info[0]['title']) ? $info[0]['title'] : '',
                'questions' => $questions,
                'answers' => $answers
            ];
            echo json_encode($result);
        } else {
            echo json_encode(['error' => 'Câu hỏi không tồn tại']);
        }*/
        $this->view->render('match/get_json_question');
    }
}
?>