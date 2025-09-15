var url, lesson_id, myData_match = [], myData_drag_drop = []; let groupCount = 0; let itemCount = 0;
$(function(){
    lesson_id = getParameterByName('id'); $('#view_question').empty();
    var gwdth = $('#list_lesson_question').width(), fwdth = $('.full').width();
    $('#list_lesson_question').jqGrid({
        url: baseUrl + '/lesson_question/json?token='+localStorage.getItem('token')+'&id='+lesson_id,
        datatype: "json",
        mtype: "GET",
        colModel: [
            {label: 'Mã câu hỏi', name: 'code', width: 120, align:"center"},
            {label: 'Loại câu hỏi', name: 'asdasd', width: 120, align:"center", formatter: format_type_question},
            {label: 'Nội dung câu hỏi', name: 'title', width: 350, cellattr: function(rowId, tv, rawObject, dm, rdata){
                return 'style="white-space:  normal;"';
            }},
            {label: 'Trạng thái', name: 'status', width: 100, align: "center", formatter: format_trangthai},
            {label: 'Cập nhật lần cuối', name: 'create_at', width: 150, align:"center"},
            {label: '&nbsp', name: 'id', hidden: true, key: true},
            {label: '&nbsp', name: 'type_question', hidden: true},
            {label: '&nbsp', name: 'file', hidden: true}
        ],
        viewrecords: true, height:200, width: gwdth, rowNum: 20, rownumbers: true,
        height:($('.footer').offset().top - $('.page-header').offset().top - 147),
        pager: "#lesson_question_pager", rowList:[10,20,30],
        loadComplete : function() {
            var table = this;
            setTimeout(function(){
                updatePagerIcons(table);
            }, 0);
        },
        ondblClickRow: function(rowId){
            var row = $('#list_lesson_question').jqGrid("getRowData", rowId);
            view_question(rowId, row.type_question);
        }
    });
});

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

function format_type_question(cellvalue, options, rowObject){
    var array_type = ['Đúng / Sai', '1 Đáp án đúng', 'Nhiều đáp án đúng', 'Nối', 'Kéo thả', 'Sắp xếp'];
    return array_type[rowObject.type_question - 1];
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function refresh_code(){
    var number = Math.floor(Math.random() * 999999999);
    $('#code').val(number);
}

function add(){
    reset_form('#fm'); $('#form_type').empty();
    var number = Math.floor(Math.random() * 999999999); $('#refreshcode').show();
    $('#code').val(number);
    $('#modal-lesson-question').modal('show');
    url = baseUrl + '/lesson_question/add?token='+localStorage.getItem('token');
}

function update(){
    reset_form('#fm'); $('#form_type').empty();
    var rowKey = $('#list_lesson_question').jqGrid('getGridParam',"selrow");
    if(rowKey == null){
        show_message("error", "Vui lòng chọn câu hỏi cần cập nhật");
        return false;
    }else{
        var row = $('#list_lesson_question').jqGrid("getRowData", rowKey);
        $('#code').val(row.code); $('#title').val(row.title); $('#file_old').val(row.file);
        $('#type_question').val(row.type_question).trigger('change'); set_load_form(row.type_question, row.id);
        $('#modal-lesson-question').modal('show');
        url = baseUrl + '/lesson_question/update?token='+localStorage.getItem('token')+"&id="+row.id;
    }
}

function del(){
    var rowKey = $('#list_lesson_question').jqGrid('getGridParam',"selrow");
    if(rowKey == null){
        show_message("error", "Vui lòng chọn câu hỏi cần cập nhật");
        return false;
    }else{
        var data_str = "token="+localStorage.getItem('token')+'&id='+rowKey;
        del_data(data_str, "Bạn có chắc chắn muốn xóa câu hỏi này?", baseUrl + '/lesson_question/del', '#list_lesson_question', baseUrl + '/lesson_question/json?token='+localStorage.getItem('token'));
        $('#view_question').empty();
    }
}

function change(status, idh){
    var data_str = "token="+localStorage.getItem('token')+'&id='+idh+'&status='+status;
        del_data(data_str, "Bạn có chắc chắn muốn cập nhật trạng thái cho câu hỏi này?", baseUrl + '/lesson_question/change', '#list_lesson_question', baseUrl + '/lesson_question/json?token='+localStorage.getItem('token'));
}

function save(){
    var required = $('#fm input, #fm textarea, #fm select').filter('[required]:visible');
    var allRequired = true;
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }
    });
    if(allRequired){
        if($('#type_question').val() == 4){ // dang cau hoi noi
            if(myData_match.length == 0){
                show_message("error", "Chưa có đáp án nào được thêm vào");
                return false;
            }else{
                $('#data_match').val(JSON.stringify(myData_match)); 
                save_form_modal('#fm', url, '#modal-lesson-question', '#list_lesson_question',  baseUrl+'/lesson_question/json?token='+localStorage.getItem('token'));
            }
        } else{
            save_form_modal('#fm', url, '#modal-lesson-question', '#list_lesson_question',  baseUrl+'/lesson_question/json?token='+localStorage.getItem('token'));
        }
    }else{
        show_message("error", "Chưa điền đủ thông tin");
    }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function set_load_form(val, idh = 0){
    var code_question = $('#code').val();
    if(val == 1){ // true/false
        $('#form_type').load(baseUrl + '/true_false/form?token='+localStorage.getItem('token')+'&code='+code_question+'&id='+idh);
        $('#close_modal').removeAttr('onclick', 'cancel_match()').attr('data-dismiss', 'modal');
    }else if(val == 2){ // one_true
        $('#form_type').load(baseUrl + '/one_true/form?token='+localStorage.getItem('token')+'&code='+code_question+'&id='+idh);
        $('#close_modal').removeAttr('onclick', 'cancel_match()').attr('data-dismiss', 'modal');
    }else if(val == 3){ // multiple_true
        $('#form_type').load(baseUrl + '/multiple_true/form?token='+localStorage.getItem('token')+'&code='+code_question+'&id='+idh);
        $('#close_modal').removeAttr('onclick', 'cancel_match()').attr('data-dismiss', 'modal');
    }else if(val == 4){ // match
        $('#form_type').load(baseUrl + '/match/form?token='+localStorage.getItem('token')+'&code='+code_question+'&id='+idh);
        $('#close_modal').attr('onclick', 'cancel_match()').removeAttr('data-dismiss');
    }else if(val == 5){ // drag and drop
        $('#form_type').load(baseUrl + '/drag_drop/form?token='+localStorage.getItem('token')+'&code='+code_question+'&id='+idh);
    }
}

function getParameterByName(name, url = window.location.href) {
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function view_question(idh, type){
    var html = '';
    if(type == 1){// dang cau hoi dung sai
        html += ' <iframe src="'+baseUrl+'/true_false/index?token='+localStorage.getItem('token')+'&question_id='+idh+'" style="width:100%;height:calc(100vh - 250px);border:1px solid #ccc"></iframe>';
    }else if(type == 2){ // dang cau hoi 1 dap an dung
        html += ' <iframe src="'+baseUrl+'/one_true/index?token='+localStorage.getItem('token')+'&question_id='+idh+'" style="width:100%;height:calc(100vh - 250px);border:1px solid #ccc"></iframe>';
    }else if(type == 3){ // dang cau hoi nhieu dap an dung
        html += ' <iframe src="'+baseUrl+'/multiple_true/index?token='+localStorage.getItem('token')+'&question_id='+idh+'" style="width:100%;height:calc(100vh - 250px);border:1px solid #ccc"></iframe>';
    }else if(type == 4){ // dang cau hoi noi
        html += ' <iframe src="'+baseUrl+'/match/index?token='+localStorage.getItem('token')+'&question_id='+idh+'" style="width:100%;height:calc(100vh - 250px);border:1px solid #ccc"></iframe>';
    }else if(type == 5){ // dang cau hoi keo tha
        html += ' <iframe src="'+baseUrl+'/drag_drop/index?token='+localStorage.getItem('token')+'&question_id='+idh+'" style="width:100%;height:calc(100vh - 250px);border:1px solid #ccc"></iframe>';
    }
    $('#view_question').html(html);
}
  