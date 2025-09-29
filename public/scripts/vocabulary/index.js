var url; let myData_match = [], myData_drag_drop_target = [], myData_drag_drop_answer = [];
$(function(){
    var gwdth = $('#list_vocab').width();
    $('#list_vocab').jqGrid({
        url: baseUrl + '/vocabulary/json?token='+localStorage.getItem('token'),
        datatype: "json",
        mtype: "GET",
        colModel: [
            {label: 'Mã câu hỏi', name: 'code', width: 120, align:"center"},
            {label: 'Dạng câu hỏi', name: 'fullname', width: 150},
            {label: 'Tiêu đề câu hỏi', name: 'birthday', width: 300, align:"left"},
            {label: 'File', name: 'phone', width: 70, align:"center"},
            {label: 'Trạng thái', name: 'level', width: 80, align:"center"},
            {label: 'Cập nhật lần cuối', name: 'email', width: 120},
            {label: '&nbsp', name: 'id', hidden: true, key: true}
        ],
        viewrecords: true, height:200, width: gwdth, rowNum: 20, rownumbers: true,
        height:($('.footer').offset().top - $('#danh_sach_cau_hoi').offset().top - 137),
        pager: "#vocab_pager", rowList:[10,20,30],
        loadComplete : function() {
            var table = this;
            setTimeout(function(){
                updatePagerIcons(table);
            }, 0);
        }
    });
});

function add_question(){
    reset_form('#fm');
    var rowKey = $('#list_cate').jqGrid('getGridParam',"selrow");
    if(rowKey == null){
        show_message("error", "Vui lòng chọn danh mục từ vựng");
        return false;
    }else{
        var row = $('#list_cate').jqGrid("getRowData", rowKey); 
        $('.table-header').text("Thêm mới - Cập nhật câu hỏi cho nhóm từ vựng "+row.title);
        $('#cate_id').val(rowKey); $('#form_type').empty();
        var number = Math.floor(Math.random() * 99999999); $('#refreshcode').show();
        $('#code').val(number); $('#modal-form').modal('show');
        url = baseUrl + '/vocabulary/add?token='+localStorage.getItem('token');
    }
}

function edit(){

}

function del(){

}

function change(){

}

function save(){
    var required = $('#fm input, #fm textarea, #fm select').filter('[required]:visible');
    var allRequired = true, required_all = true;
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }
    });
    if(allRequired){
        console.log(myData_match);
        if($('#type_question').val() == 4){
            if(myData_match.length == 0){
                required_all = false;
            }else{
                for(i in myData_match){
                    if(myData_match[i].answer_a.length == 0 && myData_match[i].file_a.length == 0
                    && myData_match[i].answer_b.length == 0 && myData_match[i].file_b.length == 0){
                        required_all = false;
                    }
                }
            }
        }else if($('#type_question').val() == 5){
            if(myData_drag_drop_answer.length == 0 || myData_drag_drop_target.length == 0){
                required_all = false;
            }else{
                for(i in myData_drag_drop_target){
                    if(myData_drag_drop_target[i].title.length == 0 && myData_drag_drop_target[i].file.length == 0){
                        required_all = false;
                    }
                }
                for(i in myData_drag_drop_answer){
                    if(myData_drag_drop_answer[i].title.length == 0 && myData_drag_drop_answer[i].file.length == 0 && myData_drag_drop_answer[i].target_id.length == 0){
                        required_all = false;
                    }
                }
            }
        }else{
            required_all = true;
        }
        if(required_all){
            $('#data_match').val(JSON.stringify(myData_match)); $('#data_drag_drop_target').val(JSON.stringify(myData_drag_drop_target));
            $('#data_drag_drop_answer').val(JSON.stringify(myData_drag_drop_answer));
            save_form_modal('#fm', url, '#modal-lesson-question', '#list_lesson_question',  baseUrl+'/vocabulary/json?token='+localStorage.getItem('token'));
        }else{
            show_message("error", "Chưa điền đủ thông tin 1");
        }
    }else{
        show_message("error", "Chưa điền đủ thông tin");
    }
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function set_load_form(val, idh = 0, id_edit = 0){
    var code_question = $('#code').val();
    if(val == 1){ // true/false
        $('#form_type').load(baseUrl + '/true_false/form?token='+localStorage.getItem('token')+'&code='+code_question+'&id='+idh);
    }else if(val == 2){ // one_true
        $('#form_type').load(baseUrl + '/one_true/form?token='+localStorage.getItem('token')+'&code='+code_question+'&id='+idh);
    }else if(val == 3){ // multiple_true
        $('#form_type').load(baseUrl + '/multiple_true/form?token='+localStorage.getItem('token')+'&code='+code_question+'&id='+idh);
    }else if(val == 4){ // match
        $('#form_type').load(baseUrl + '/match/form?token='+localStorage.getItem('token')+'&code='+code_question+'&id='+idh);
        if(id_edit == 1){
            var data_str = getRemote(baseUrl + '/match/json_edit?token='+localStorage.getItem('token')+'&code='+code_question);
            //console.log(data_str);
            myData_match = (data_str.length != 0) ? JSON.parse(data_str) : [];
            setTimeout(() => {
                render_data_match_edit();
            }, 50);
        }else{
            myData_match = [];
        }
    }else if(val == 5){ // drag and drop
        $('#form_type').load(baseUrl + '/drag_drop/form?token='+localStorage.getItem('token')+'&code='+code_question+'&id='+idh);
        var data_str_target = getRemote(baseUrl + '/drag_drop/json_target?token='+localStorage.getItem('token')+'&code='+code_question);
        var data_str_answer = getRemote(baseUrl + '/drag_drop/json_answer?token='+localStorage.getItem('token')+'&code='+code_question);
        myData_drag_drop_target = (data_str_target.length != 0) ? JSON.parse(data_str_target) : [];
        myData_drag_drop_answer = (data_str_answer.length != 0) ? JSON.parse(data_str_answer) : [];
        setTimeout(() => {
            render_drag_drop_target_edit(); render_drag_drop_answer_edit();
        }, 50);
    }else if(val == 6){ // sort alphabet
        $('#form_type').load(baseUrl + '/sort_alphabet/form?token='+localStorage.getItem('token')+'&code='+code_question+'&id='+idh);
    }
}