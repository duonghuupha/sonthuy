var url = '', id_edit = 0;
$(function(){
    var gwdth = $('#list_users').width(), fwdth = $('.full').width();
    $('#list_users').jqGrid({
        url: baseUrl + '/users/json?token='+localStorage.getItem('token'),
        datatype: "json",
        mtype: "GET",
        colModel: [
            {label: 'Mã người dùng', name: 'code', width: 120, align:"center"},
            {label: 'Nhân sự', name: 'teacher_title', width: 200},
            {label: 'Tên đăng nhập', name: 'username', width: 200, align:"center"},
            {label: 'Nhóm người dùng', name: 'group_title', width: 150, align:"center"},
            {label: 'Trạng thái', name: 'status', width: 100, align: "center", formatter: format_trangthai},
            {label: '&nbsp', name: 'id', hidden: true, key: true},
            {label: '&nbsp', name: 'personnel_id', hidden: true},
            {label: '&nbsp', name: 'group_role_id', hidden: true}
        ],
        viewrecords: true, height:200, width: gwdth, rowNum: 20, rownumbers: true,
        height:($('.footer').offset().top - $('.page-header').offset().top - 147),
        pager: "#users_pager", rowList:[10,20,30],
        loadComplete : function() {
            var table = this;
            setTimeout(function(){
                updatePagerIcons(table);
            }, 0);
        }
    });
    $('#personnel_id, #username, #pass, #repass, #group_role_id, #btncancel, #btnsave').attr('disabled', 'disabled');
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
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function add(){
    $('#personnel_id, #username, #pass, #repass, #group_role_id, #btncancel, #btnsave').removeAttr('disabled');
    $('#personnel_id, #username, #pass, #repass, #group_role_id').attr('required', 'required');
    combo_select_2('#personnel_id', baseUrl+'/other/combo_personnel', 0, '');
    combo_select_2('#group_role_id', baseUrl+'/other/combo_group_role', 0, '');
    url = baseUrl + '/users/add?token='+localStorage.getItem('token');
}

function update(){
    var rowKey = $('#list_users').jqGrid('getGridParam',"selrow");
    if(rowKey == null){
        show_message("error", "Vui lòng chọn người dùng cần cập nhật");
        return false;
    }else{
        var row = $('#list_users').jqGrid("getRowData", rowKey); id_edit = row.id;
        $('#group_role_id, #btncancel, #btnsave').removeAttr('disabled');
        $('#personnel_id, #username, #pass, #repass').removeAttr('required');
        $('#group_role_id').attr('required', 'required'); $('#username').val(row.username);
        combo_select_2('#group_role_id', baseUrl+'/other/combo_group_role', row.group_role_id, row.group_title);
        combo_select_2('#personnel_id', baseUrl+'/other/combo_personnel', row.personnel_id, row.teacher_title);
        url = baseUrl + '/users/update?token=' + localStorage.getItem('token') + '&id=' + row.id;
    }
}

function del(){
    var rowKey = $('#list_teacher').jqGrid('getGridParam',"selrow");
    if(rowKey == null){
        show_message("error", "Vui lòng chọn nhân sự cần xóa");
        return false;
    }else{
        var row = $('#list_teacher').jqGrid("getRowData", rowKey);
        var str_data = "token=" + localStorage.getItem('token') + "&id=" + row.id+ "&image=" + btoa(row.image);
        del_data(str_data, "Bạn có chắc chắn muốn xóa nhân sự này không?", baseUrl + '/teacher/del', '#list_teacher', baseUrl + '/teacher/json?token=' + localStorage.getItem('token'));
    }
}

function change(status, id){
    var str_data = "token=" + localStorage.getItem('token') + "&id=" + id + "&status=" + status;
    del_data(str_data, "Bạn có chắc chắn muốn thay đổi trạng thái nhân sự này không?", baseUrl + '/teacher/change', '#list_teacher', baseUrl + '/teacher/json?token=' + localStorage.getItem('token'));
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
        if((($('#pass').val() != $('#repass').val()) || ($('#pass').val().length < 6)) && id_edit == 0){
            show_message("error", "Mật khẩu không khớp hoặc ít hơn 6 ký tự");
            return false;
        }else{
            save_reject('#fm', url,  baseUrl+'/users?token='+localStorage.getItem('token')); 
        }
    }else{
        show_message("error", "Chưa điền đủ thông tin");
    }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function set_username(){
    var value = $('#personnel_id').text();
    //console.log(removeVietnameseTones(value.trim()));
    $('#username').val(removeVietnameseTones(value.trim()).toLowerCase().replaceAll(' ', '.'));
}