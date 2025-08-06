var url, lesson_id;
$(function(){
    lesson_id = getParameterByName('id');
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
            {label: '&nbsp', name: 'type_question', hidden: true}
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
            $('#view_question').load(baseUrl + '/lesson_question/view_question?token='+localStorage.getItem('token')+'&id='+rowId);
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
    reset_form('#fm');
    var number = Math.floor(Math.random() * 999999999); $('#refreshcode').show();
    $('#code').val(number);
    $('#modal-lesson-question').modal('show');
    url = baseUrl + '/lesson_question/add?token='+localStorage.getItem('token');
}

function update(){

}

function del(){

}

function change(){

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
        save_form_modal('#fm', url, '#modal-lesson-question', '#list_lesson_question',  baseUrl+'/lesson_question/json?token='+localStorage.getItem('token')); 
    }else{
        show_message("error", "Chưa điền đủ thông tin");
    }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function set_load_form(idh){
    var code_question = $('#code').val();
    if(idh == 1){ // true/false
        $('#form_type').load(baseUrl + '/question_true_false/form?token='+localStorage.getItem('token')+'&code='+code_question);
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