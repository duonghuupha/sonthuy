var url;
$(function(){
    var gwdth = $('#list_vocab').width(), fwdth = $('.full').width();
    $('#list_vocab').jqGrid({
        url: baseUrl + '/vocab/json?token='+localStorage.getItem('token'),
        datatype: "json",
        mtype: "GET",
        colModel: [
            {label: 'Mã nhân sự', name: 'code', width: 120, align:"center"},
            {label: 'Họ và tên', name: 'fullname', width: 200},
            {label: 'Ngày sinh', name: 'birthday', width: 150, align:"center"},
            {label: 'Điện thoại', name: 'phone', width: 150, align:"center"},
            {label: 'Trình độ', name: 'level', width: 150, align:"center"},
            {label: 'Email', name: 'email', width: 200,},
            {label: 'Địa chỉ', name: 'address', width: 350,},
            {label: '&nbsp', name: 'id', hidden: true, key: true},
            {label: '&nbsp', name: 'gender', hidden: true},
            {label: '&nbsp', name: 'image', hidden: true}
        ],
        viewrecords: true, height:200, width: gwdth, rowNum: 20, rownumbers: true,
        height:($('.footer').offset().top - $('#danh_sach_cau_hoi').offset().top - 147),
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
        var number = Math.floor(Math.random() * 999999999); $('#refreshcode').show();
        $('#code').val(number); $('#modal-form').modal('show');
        url = baseUrl + '/vocab/add?token='+localStorage.getItem('token');
    }
}

function edit(){

}

function del(){

}

function change(){

}

function save(){

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