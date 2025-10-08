var url, lesson_id;
let myData_match = [], myData_drag_drop_target = [], myData_drag_drop_answer = [];
$(function(){
    lesson_id = getParameterByName('id'); $('#view_question').empty();
    var gwdth = $('#list_lesson_question').width(), fwdth = $('.full').width();
    $('#list_lesson_question').jqGrid({
        url: baseUrl + '/question/json?token='+localStorage.getItem('token')+'&id='+lesson_id,
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
        height:($('.footer').offset().top - $('#view_detail').offset().top - 227),
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
    url = baseUrl + '/question/add?token='+localStorage.getItem('token');
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
        $('#type_question').val(row.type_question).trigger('change'); set_load_form(row.type_question, row.id, 1);
        $('#modal-lesson-question').modal('show');
        url = baseUrl + '/question/update?token='+localStorage.getItem('token')+"&id="+row.id;
    }
}

function del(){
    var rowKey = $('#list_lesson_question').jqGrid('getGridParam',"selrow");
    if(rowKey == null){
        show_message("error", "Vui lòng chọn câu hỏi cần cập nhật");
        return false;
    }else{
        var data_str = "token="+localStorage.getItem('token')+'&id='+rowKey;
        del_data(data_str, "Bạn có chắc chắn muốn xóa câu hỏi này?", baseUrl + '/question/del', '#list_lesson_question', baseUrl + '/question/json?token='+localStorage.getItem('token'));
        $('#view_question').empty();
    }
}

function change(status, idh){
    var data_str = "token="+localStorage.getItem('token')+'&id='+idh+'&status='+status;
    del_data(data_str, "Bạn có chắc chắn muốn cập nhật trạng thái cho câu hỏi này?", baseUrl + '/question/change', '#list_lesson_question', baseUrl + '/question/json?token='+localStorage.getItem('token'));
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
            save_form_modal('#fm', url, '#modal-lesson-question', '#list_lesson_question',  baseUrl+'/question/json?token='+localStorage.getItem('token'));
        }else{
            show_message("error", "Chưa điền đủ thông tin 1");
        }
    }else{
        show_message("error", "Chưa điền đủ thông tin");
    }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function set_load_form(val, idh = 0, id_edit = 0){
    var code_question = $('#code').val();
    if(val == 1){ // true/false
        $('#form_type').load(baseUrl + '/true_false/form?token='+localStorage.getItem('token')+'&code='+code_question+'&id='+idh);
        $('#close_modal').removeAttr('onclick').attr('data-dismiss', 'modal');
    }else if(val == 2){ // one_true
        $('#form_type').load(baseUrl + '/one_true/form?token='+localStorage.getItem('token')+'&code='+code_question+'&id='+idh);
        $('#close_modal').removeAttr('onclick').attr('data-dismiss', 'modal');
    }else if(val == 3){ // multiple_true
        $('#form_type').load(baseUrl + '/multiple_true/form?token='+localStorage.getItem('token')+'&code='+code_question+'&id='+idh);
        $('#close_modal').removeAttr('onclick').attr('data-dismiss', 'modal');
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
        $('#close_modal').removeAttr('data-dismiss').attr('onclick', 'close_modal_match()');
    }else if(val == 5){ // drag and drop
        $('#form_type').load(baseUrl + '/drag_drop/form?token='+localStorage.getItem('token')+'&code='+code_question+'&id='+idh);
        if(id_edit == 1){
            var data_str_target = getRemote(baseUrl + '/drag_drop/json_target?token='+localStorage.getItem('token')+'&code='+code_question);
            var data_str_answer = getRemote(baseUrl + '/drag_drop/json_answer?token='+localStorage.getItem('token')+'&code='+code_question);
            myData_drag_drop_target = (data_str_target.length != 0) ? JSON.parse(data_str_target) : [];
            myData_drag_drop_answer = (data_str_answer.length != 0) ? JSON.parse(data_str_answer) : [];
            setTimeout(() => {
                render_drag_drop_target_edit(); render_drag_drop_answer_edit();
            }, 50);
        }else{
            myData_drag_drop_answer = []; myData_drag_drop_target = [];
        }
        $('#close_modal').removeAttr('data-dismiss').attr('onclick', 'close_modal_drag_drop()');
    }else if(val == 6){ // sort alphabet
        $('#form_type').load(baseUrl + '/sort_alphabet/form?token='+localStorage.getItem('token')+'&code='+code_question+'&id='+idh);
        $('#close_modal').removeAttr('onclick').attr('data-dismiss', 'modal');
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
    }else{
        html += ' <iframe src="'+baseUrl+'/sort_alphabet/index?token='+localStorage.getItem('token')+'&question_id='+idh+'" style="width:100%;height:calc(100vh - 250px);border:1px solid #ccc"></iframe>';
    }
    $('#view_question').html(html);
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function getRemote(remote_url){
    return $.ajax({
        type: 'GET',
        url: remote_url,
        async: false
    }).responseText;
}

function render_data_match_edit(){
    var html = ''; $('#table_match_tbody').empty();
    for(i in myData_match){
        html += `
            <tr id="row_${myData_match[i].id}">
                <td style="width:45%;height:100px">
                    <input type="text" class="form-control" name="answer_left_${myData_match[i].id}" id="answer_left_${myData_match[i].id}" value="${myData_match[i].answer_a}" 
                    placeholder="Nội dung" onchange="change_data_match(1, ${myData_match[i].id})" style="margin-bottom:7px;"/>

                    <input type="file" class="file_attach" name="file_left_${myData_match[i].id}" id="file_left_${myData_match[i].id}" style="width:100%;" 
                    onchange="change_data_match(2, ${myData_match[i].id})"/>
                </td>
                <td style="width:45%">
                    <input type="text" class="form-control" name="answer_right_${myData_match[i].id}" id="answer_right_${myData_match[i].id}" value="${myData_match[i].answer_b}" 
                    placeholder="Nội dung" onchange="change_data_match(3, ${myData_match[i].id})" style="margin-bottom:7px;"/>

                    <input type="file" class="file_attach" name="file_right_${myData_match[i].id}" id="file_right_${myData_match[i].id}" style="width:100%;" 
                    onchange="change_data_match(4, ${myData_match[i].id})"/>
                </td>
                <td style="width:5%;text-align:center">
                    <a href="javascript:void(0)" onclick="remove_match_answer(${myData_match[i].id})" title="Xóa" style="color:red">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
        `;
    }
    $('#table_match_tbody').html(html);
    setTimeout(() => {
        $('.file_attach').ace_file_input({
            no_file:'Không có file ...',btn_choose:'Lựa chọn',
            btn_change:'Thay đổi',droppable:false,
            onchange:null,thumbnail:true
        });
    }, 50);
}

function render_drag_drop_target_edit(){
    var html = ''; $('#drag_drop_target').empty();
    for(i in myData_drag_drop_target){
        count_target = parseInt(i)+1;
        html += `
        <fieldset style="margin-top:10px;" id="fm_target_${myData_drag_drop_target[i].id}">
            <legend style="font-weight:normal;font-size:14px;margin-bottom:5px;">
                Ô đích số ${count_target}
                <a href="javascript:void(0)" onclick="remove_drag_drop_target(${myData_drag_drop_target[i].id})">
                    <i class="ace-icon fa fa-trash"></i> 
                </a>
            </legend>
            <input type="text" class="form-control" name="target_title_${myData_drag_drop_target[i].id}" id="target_title_${myData_drag_drop_target[i].id}" 
            value="${myData_drag_drop_target[i].title}" placeholder="Nội dung" onchange="change_data_target(1, ${myData_drag_drop_target[i].id})" style="margin-bottom:7px;"/>

            <input type="file" class="file_attach" name="file_target_${myData_drag_drop_target[i].id}" id="file_target_${myData_drag_drop_target[i].id}" style="width:100%;" 
            onchange="change_data_target(2, ${myData_drag_drop_target[i].id})"/>
        </fieldset>
        `;
    }
    $('#drag_drop_target').html(html);
    setTimeout(() => {
        $('.file_attach').ace_file_input({
            no_file:'Không có file ...',btn_choose:'Lựa chọn',
            btn_change:'Thay đổi',droppable:false,
            onchange:null,thumbnail:true
        });
    }, 50);
}

function render_drag_drop_answer_edit(){
    var html = '', option = ''; $('#drag_drop_answer').empty();
    for(i in myData_drag_drop_answer){
        count_answer = parseInt(i)+1;
        html += `
        <div class="col-sm-6" id="item_${myData_drag_drop_answer[i].id}">
            <fieldset style="margin-top:10px;">
                <legend style="font-weight:normal;font-size:14px;margin-bottom:5px;">
                    Đáp án số ${count_answer}
                    <a href="javascript:void(0)" onclick="remove_drag_drop_answer(${myData_drag_drop_answer[i].id})">
                        <i class="ace-icon fa fa-trash"></i> 
                    </a>
                </legend>
                <form id="answer_${myData_drag_drop_answer[i].id}" method="post" enctype="multipart/form-data">
                    <select class="select2" data-placeholder="Lựa chọn đích..." style="width:100%;"
                    id="target_combo_${myData_drag_drop_answer[i].id}" name="target_combo_${myData_drag_drop_answer[i].id}" data-minimum-results-for-search="Infinity"
                    onchange="change_data_answer(0, ${myData_drag_drop_answer[i].id})">
                        <option value="">--Lựa chọn đich--</option>
                        ${
                            myData_drag_drop_target.map(o => `<option value="${o.id_temp}" ${o.id_temp == myData_drag_drop_answer[i].target_id ? 'selected' : ''}>${o.title}</option>`).join('')
                        }
                    </select>

                    <input type="text" class="form-control" name="answer_title_${myData_drag_drop_answer[i].id}" id="answer_title_${myData_drag_drop_answer[i].id}" 
                    value="${myData_drag_drop_answer[i].title}" placeholder="Nội dung" onchange="change_data_answer(1, ${myData_drag_drop_answer[i].id})" 
                    style="margin-bottom:7px;margin-top:7px;"/>

                    <input type="file" class="file_attach" name="file_answer_${myData_drag_drop_answer[i].id}" id="file_answer_${myData_drag_drop_answer[i].id}" style="width:100%;" 
                    onchange="change_data_answer(2, ${myData_drag_drop_answer[i].id})"/>
                </form>
            </fieldset>
        </div>
        `;
    }
    $('#drag_drop_answer').html(html);
    setTimeout(() => {
        $('.file_attach').ace_file_input({
            no_file:'Không có file ...',btn_choose:'Lựa chọn',
            btn_change:'Thay đổi',droppable:false,
            onchange:null,thumbnail:true
        });
    }, 50);
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function close_modal_match(){
    if(myData_match.length == 0){
        $('#modal-lesson-question').modal('hide');
    }else{
        $.getJSON(baseUrl + '/match/remove_file_temp_after_click_close_modal',
            {token: localStorage.getItem('token'), data: btoa(JSON.stringify(myData_match)), type: 'lesson'}, 
            function(result){
            if(result.success){
                $('#modal-lesson-question').modal('hide'); myData_match = [];
            }
        });
    }
}

function close_modal_drag_drop(){
    if(myData_drag_drop_answer.length == 0 || myData_drag_drop_target == 0){
        $('#modal-lesson-question').modal('hide');
    }else{
        $.getJSON(baseUrl + '/drag_drop/remove_file_temp',
            {token: localStorage.getItem('token'), data: btoa(JSON.stringify(myData_drag_drop_answer)), type: 'lesson'}, function(result){}
        );
        $.getJSON(baseUrl + '/drag_drop/remove_file_temp',
            {token: localStorage.getItem('token'), data: btoa(JSON.stringify(myData_drag_drop_target)), type: 'lesson'}, function(result){});
        myData_drag_drop_answer = []; myData_drag_drop_target = []; $('#modal-lesson-question').modal('hide');
    }
}