var url; let myData_match = [], myData_drag_drop_target = [], myData_drag_drop_answer = [];
$(function(){
    var gwdth = $('#list_vocab').width();
    $('#list_vocab').jqGrid({
        url: baseUrl + '/vocabulary/json?token='+localStorage.getItem('token'),
        datatype: "json",
        mtype: "GET",
        colModel: [
            {label: 'Mã câu hỏi', name: 'code', width: 120, align:"center"},
            {label: 'Danh mục/Nhóm từ vựng', name: 'cate_vocab_title', width: 150, align:"center"},
            {label: 'Dạng câu hỏi', name: 'type_question', width: 150, align:"center", formatter: format_type_question},
            {label: 'Tiêu đề câu hỏi', name: 'title', width: 300, align:"left"},
            {label: 'File', name: 'file', width: 70, align:"center", formatter: format_file},
            {label: 'Trạng thái', name: 'status', width: 80, align:"center", formatter: format_trangthai},
            {label: 'Cập nhật lần cuối', name: 'create_at', width: 120, align:"center"},
            {label: '&nbsp', name: 'id', hidden: true, key: true},
            {label: '&nbsp', name: 'code', hidden: true},
            {label: '&nbsp', name: 'type_question', hidden: true},
            {label: '&nbsp', name: 'cate_vocab_id', hidden: true},
            {label: '&nbsp', name: 'file', hidden: true}
        ],
        viewrecords: true, height:200, width: gwdth, rowNum: 20, rownumbers: true,
        height:($('.footer').offset().top - $('#danh_sach_cau_hoi').offset().top - 137),
        pager: "#vocab_pager", rowList:[10,20,30],
        loadComplete : function() {
            var table = this;
            setTimeout(function(){
                updatePagerIcons(table);
            }, 0);
        },
        ondblClickRow: function(rowId){
            $('#modal-form-view-question').modal('show'); var row = $('#list_vocab').jqGrid("getRowData", rowId);
            var html = '';
            if(row.type_question == 1){// dang cau hoi dung sai
                html += ' <iframe src="'+baseUrl+'/true_false/index?token='+localStorage.getItem('token')+'&question_id='+rowId+'" style="width:100%;height:calc(100vh - 250px);border:1px solid #ccc"></iframe>';
            }else if(row.type_question == 2){ // dang cau hoi 1 dap an dung
                html += ' <iframe src="'+baseUrl+'/one_true/index?token='+localStorage.getItem('token')+'&question_id='+rowId+'" style="width:100%;height:calc(100vh - 250px);border:1px solid #ccc"></iframe>';
            }else if(row.type_question == 3){ // dang cau hoi nhieu dap an dung
                html += ' <iframe src="'+baseUrl+'/multiple_true/index?token='+localStorage.getItem('token')+'&question_id='+rowId+'" style="width:100%;height:calc(100vh - 250px);border:1px solid #ccc"></iframe>';
            }else if(row.type_question == 4){ // dang cau hoi noi
                html += ' <iframe src="'+baseUrl+'/match/index?token='+localStorage.getItem('token')+'&question_id='+rowId+'" style="width:100%;height:calc(100vh - 250px);border:1px solid #ccc"></iframe>';
            }else if(row.type_question == 5){ // dang cau hoi keo tha
                html += ' <iframe src="'+baseUrl+'/drag_drop/index?token='+localStorage.getItem('token')+'&question_id='+rowId+'" style="width:100%;height:calc(100vh - 250px);border:1px solid #ccc"></iframe>';
            }else{
                html += ' <iframe src="'+baseUrl+'/sort_alphabet/index?token='+localStorage.getItem('token')+'&question_id='+rowId+'" style="width:100%;height:calc(100vh - 250px);border:1px solid #ccc"></iframe>';
            }
            $('#form_view_question').html(html);
        }
    });
});

function format_file(cellvalue, options, rowObject){
    if(cellvalue != ''){
        return '<a href="'+baseUrl+'/public/vocab/'+rowObject.code+'/question/'+cellvalue+'" target="_blank"><i class="fa fa-file"></i></a>';
    }else{
        return '';
    }
}

function format_type_question(cellvalue, options, rowObject){
    if(cellvalue == 1){
        return 'Đúng / Sai';   
    }else if(cellvalue == 2){
        return '1 đáp án đúng';
    }else if(cellvalue == 3){
        return 'Nhiều đáp án đúng';
    }else if(cellvalue == 4){
        return 'Nối';
    }else if(cellvalue == 5){
        return 'Kéo thả';
    }else if(cellvalue == 6){
        return 'Sắp xếp từ';
    }else{ 
        return '';
    }
}

function format_trangthai(cellvalue, options, rowObject){
    var html = '';
    if(cellvalue == 1){
        html += '<a href="javascript:void(0)" onclick="change(0, '+rowObject.id+')">';
            html += '<img src="'+baseUrl+'/styles/assets/images/publish.png"/>';
        html += '</a>';
    }else{
        html += '<a href="javascript:void(0)" onclick="change(1, '+rowObject.id+')">';
            html += '<img src="'+baseUrl+'/styles/assets/images/unpublish.png"/>';
        html += '</a>';
    }
    return html;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function add_question(){
    reset_form('#fm'); $('#form_type').empty();
    combo_select_2('#cate_vocab_id', baseUrl + '/other/combo_vocab', 0, '');
    var number = Math.floor(Math.random() * 99999999); $('#refreshcode').show();
    $('#code').val(number); $('#modal-form').modal('show');
    url = baseUrl + '/vocabulary/add?token='+localStorage.getItem('token');
}

function update_question(){
    reset_form('#fm'); $('#form_type').empty();
    var rowKey = $('#list_vocab').jqGrid('getGridParam',"selrow");
    if(rowKey == null){
        show_message("error", "Vui lòng chọn câu hỏi cần cập nhật");
        return false;
    }else{
        var row = $('#list_vocab').jqGrid("getRowData", rowKey);
        combo_select_2('#cate_vocab_id', baseUrl + '/other/combo_vocab', row.cate_vocab_id, row.cate_vocab_title);
        $('#code').val(row.code); $('#title').val(row.title); $('#file_old').val(row.file);
        $('#type_question').val(row.type_question).trigger('change'); set_load_form(row.type_question, row.id, 1);
        $('#modal-form').modal('show');
        url = baseUrl + '/vocabulary/update?token='+localStorage.getItem('token')+"&id="+row.id;
    }
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
            save_form_modal('#fm', url, '#modal-form', '#list_vocab',  baseUrl+'/vocabulary/json?token='+localStorage.getItem('token'));
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
