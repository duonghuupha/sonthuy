var url = '', myData = [], id_relation = 0;
let array_relation = ['Bố', 'Mẹ', 'Ông', 'Bà', 'Bác', 'Cô/Dì'];
$(function(){
    var gwdth = $('#list_student').width(), fwdth = $('.full').width();
    $('#list_student').jqGrid({
        url: baseUrl + '/students/json?token='+localStorage.getItem('token'),
        datatype: "json",
        mtype: "GET",
        colModel: [
            {label: 'Mã học sinh', name: 'code', width: 120, align:"center"},
            {label: 'Họ và tên', name: 'fullname', width: 200},
            {label: 'Giới tính', name: 'gender', width: 100, align:"center", formatter: format_gender},
            {label: 'Ngày sinh', name: 'birthday', width: 150, align:"center"},
            {label: 'Lớp học', name: 'class_title', width: 100},
            {label: 'Email', name: 'email', width: 250,},
            {label: 'Địa chỉ', name: 'address', width: 250,},
            {label: 'Trạng thái', name: 'status', width: 100, align: "center", formatter: format_trangthai},
            {label: '&nbsp', name: 'id', hidden: true, key: true},
            {label: '&nbsp', name: 'gender', hidden: true},
            {label: '&nbsp', name: 'class_id', hidden: true}
        ],
        viewrecords: true, height:200, width: gwdth, rowNum: 20, rownumbers: true,
        height:($('.footer').offset().top - $('.page-header').offset().top - 147),
        pager: "#student_pager", rowList:[10,20,30],
        loadComplete : function() {
            var table = this;
            setTimeout(function(){
                updatePagerIcons(table);
            }, 0);
        }
    });
    $('.input-mask-date').mask('99-99-9999'); combo_select_2('#class_id_search', baseUrl + '/other/combo_class');
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

function format_gender(cellvalue, options, rowObject){
    if(cellvalue == 1){
        return 'Nam';
    }else if(cellvalue == 2){
        return 'Nữ';
    }else{
        return 'Khác';
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
function refresh_code(){
    var number = Math.floor(Math.random() * 999999999);
    $('#code').val(number);
}

function add(){
    reset_form('#fm'); $('#tbody').empty(); myData = [];
    var number = Math.floor(Math.random() * 999999999); $('#refreshcode').show();
    $('#code').val(number); combo_select_2('#class_id', baseUrl + '/other/combo_class');
    $('#modal-student').modal('show');
    url = baseUrl + '/students/add?token=' + localStorage.getItem('token');
}

function update(){
    reset_form('#fm');
    var rowKey = $('#list_student').jqGrid('getGridParam',"selrow");
    if(rowKey == null){
        show_message("error", "Vui lòng chọn học sinh cần cập nhật");
        return false;
    }else{
        var row = $('#list_student').jqGrid("getRowData", rowKey);
        $('#code').val(row.code); $('#fullname').val(row.fullname); $('#birthday').val(row.birthday);
        $('#gender').val(row.gender).trigger('change'); $('#address').val(row.address); $('#email').val(row.email);
        combo_select_2('#class_id', baseUrl + '/other/combo_class', row.class_id, row.class_title);
        var data_str = getRemote(baseUrl + '/students/relation?code=' + row.code); myData = JSON.parse(data_str); console.log(myData);
        render_html_edit(); $('#modal-student').modal('show');
        url = baseUrl + '/students/update?token=' + localStorage.getItem('token') + '&id=' + row.id;
    }
}

function del(){
    var rowKey = $('#list_student').jqGrid('getGridParam',"selrow");
    if(rowKey == null){
        show_message("error", "Vui lòng chọn học sinh cần xóa");
        return false;
    }else{
        var row = $('#list_student').jqGrid("getRowData", rowKey);
        var str_data = "token=" + localStorage.getItem('token') + "&id=" + row.id;
        del_data(str_data, "Bạn có chắc chắn muốn xóa học sinh này không?", baseUrl + '/students/del', '#list_student', baseUrl + '/students/json?token=' + localStorage.getItem('token'));
    }
}

function change(status, id){
    var str_data = "token=" + localStorage.getItem('token') + "&id=" + id + "&status=" + status;
    del_data(str_data, "Bạn có chắc chắn muốn thay đổi trạng thái học sinh này không?", baseUrl + '/students/change', '#list_student', baseUrl + '/students/json?token=' + localStorage.getItem('token'));
}

function save(){
    var required = $('#fm input, #fm textarea, #fm select').filter('[required]:visible');
    var allRequired = true, required_all = true;
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }
    });
    if(myData.length == 0){
        required_all = true;
    }else{
        for(i in myData){
            if(myData[i].relationship_id.length == 0 || myData[i].fullname.length == 0 || myData[i].phone.length == 0){
                required_all = false;
            }
        }
    }
    if(allRequired && required_all){
        $('#relation_dc').val(JSON.stringify(myData));
        save_form_modal('#fm', url, '#modal-student', '#list_student',  baseUrl+'/students/json?token='+localStorage.getItem('token')); 
    }else{
        show_message("error", "Chưa điền đủ thông tin");
    }
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function add_relation(){
    if(myData.length == 0){
        var str = {'id': 9999, 'fullname': '', 'phone': '', 'email': '', 'relationship_id': 0};
        myData.push(str); render_html(9999);
    }else{
        var required_all = true;
        for(i in myData){
            if(myData[i].relationship_id.length == 0 || myData[i].fullname.length == 0 || myData[i].phone.length == 0){
                required_all = false;
            }
        }
        if(required_all){
            var str = {'id': 9999, 'fullname': '', 'phone': '', 'email': '', 'relationship_id': 0};
            myData.push(str); render_html(9999);
        }else{
            show_message("error", "Chưa nhập đủ thông tin");
        }
    }
}

function render_html(idh){
    var html = '', objIndex = myData.findIndex(item => item.id == idh);
    html += '<tr id="row_relation_'+idh+'">';
        html += '<td style="text-align:center">';
            html += '<select class="select2" id="relation_'+idh+'" style="width:100%" data-minimum-results-for-search="Infinity" onchange="change_data('+idh+', 1)">';
            html += render_combo_relation(myData[objIndex].relationship_id);
            html += '</select>';
        html += '</td>';
        html += '<td><input class="form-control" id="fullname_'+idh+'" type="text" style="width:100%" value="'+myData[objIndex].fullname+'" onchange="change_data('+idh+', 2)"/></td>';
        html += '<td><input class="form-control" id="phone_'+idh+'" type="text" style="width:100%" onkeypress="validate(event)" maxlength="10" onchange="change_data('+idh+', 3)"/></td>';
        html += '<td><input class="form-control" id="email_'+idh+'" type="text" style="width:100%" onchange="change_data('+idh+', 4)"/></td>';
        html += '<td class="text-center">';
            html += '<a href="javascript:void(0)" onclick="del_selected('+idh+')">';
                html += '<i class="fa fa-trash" style="color:red"></i>';
            html += '</a>';
        html += '</td>';
    html += '</tr>';
    $('#tbody').append(html);
    setTimeout(function(){
        $('select[id^="relation_"]').select2();
    }, 50);
}

function render_html_edit(){
    var html = ''; $('#tbody').empty();
    for(var i = 0; i < myData.length; i++){
        html += '<tr id="row_relation_'+myData[i].id+'">';
            html += '<td style="text-align:center">';
                html += '<select class="select2" id="relation_'+myData[i].id+'" style="width:100%" data-minimum-results-for-search="Infinity" onchange="change_data('+myData[i].id+', 1)">';
                html += render_combo_relation(myData[i].relationship_id);
                html += '</select>';
            html += '</td>';
            html += '<td><input class="form-control" id="fullname_'+myData[i].id+'" type="text" style="width:100%" value="'+myData[i].fullname+'" onchange="change_data('+myData[i].id+', 2)"/></td>';
            html += '<td><input class="form-control" id="phone_'+myData[i].id+'" type="text" style="width:100%" value="'+myData[i].phone+'" onkeypress="validate(event)" maxlength="10" onchange="change_data('+myData[i].id+', 3)"/></td>';
            html += '<td><input class="form-control" id="email_'+myData[i].id+'" type="text" style="width:100%" value="'+myData[i].email+'" onchange="change_data('+myData[i].id+', 4)"/></td>';
            html += '<td class="text-center">';
                html += '<a href="javascript:void(0)" onclick="del_selected('+myData[i].id+')">';
                    html += '<i class="fa fa-trash" style="color:red"></i>';
                html += '</a>';
            html += '</td>';
        html += '</tr>';
    }
    $('#tbody').html(html);
    setTimeout(function(){
        $('select[id^="relation_"]').select2();
    }, 50);
}

function change_data(idh, type){
    var objIndex = myData.findIndex(item => item.id == idh);
    if(type == 1){
        myData[objIndex].relationship_id = $('#relation_'+idh).val();
    }else if(type == 2){
        myData[objIndex].fullname = $('#fullname_'+idh).val();
    }else if(type == 3){
        if($('#phone_'+idh).val().length != 10){
            show_message("error", "Số điện thoại phải đủ 10 số");
            $('#phone_'+idh).val('');
        }else{
            myData[objIndex].phone = $('#phone_'+idh).val();
        }
    }else if(type == 4){
        if($('#email_'+idh).val() != '' && validateEmail($('#email_'+idh).val())){
            myData[objIndex].email = $('#email_'+idh).val();
        }else{
            show_message("error", "Email không hợp lệ");
            $('#email_'+idh).val('');
        }
    }
}

function del_selected(idh){
    myData = myData.filter(item => item.id != idh);
    $('#row_relation_'+idh).remove();
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function getRemote(remote_url){
    return $.ajax({
        type: 'GET',
        url: remote_url,
        async: false
    }).responseText;
}

function render_combo_relation(value_default){
    var html = '';
    if(value_default == 0){
        html += '<option value="0">Lựa chọn</option>';
        for(var i = 1; i < array_relation.length; i++){
            html += '<option value="'+(i + 1)+'">'+array_relation[i]+'</option>';
        }
    }else{
        for(var i = 1; i < array_relation.length; i++){
            if(value_default == (i + 1)){
                html += '<option value="'+(i + 1)+'" selected>'+array_relation[i]+'</option>';
            }else{
                html += '<option value="'+(i + 1)+'">'+array_relation[i]+'</option>';
            }
        }
    }
    return html;
}