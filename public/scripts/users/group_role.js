var url = '', data = [];
$(function(){
    var gwdth = $('#list_role').width(), fwdth = $('.full').width();
    $('#list_role').jqGrid({
        url: baseUrl + '/group_role/json?token='+localStorage.getItem('token'),
        datatype: "json",
        mtype: "GET",
        colModel: [
            {label: 'Mã nhóm', name: 'code', width: 120},
            {label: 'Tên nhóm', name: 'title', width: 200},
            {label: 'Quyền sử dụng', name: 'roles', width: 150, align: "center", formatter: format_button_role},
            {label: 'Số người dùng được phân quyền', name: 'total_user', width: 150, align: 'center'},
            {label: 'Trạng thái', name: 'status', width: 100, align: "center", formatter: format_trangthai},
            {label: 'Cập nhật lần cuối', name: 'create_at', width: 150, align: 'center'},
            {label: '&nbsp', name: 'id', hidden: true, key: true}
        ],
        viewrecords: false, height:200, width: gwdth, rowNum: 10, rownumbers: true,
        height:($('.footer').offset().top - $('.page-header').offset().top - 147),
        pager: "#role_pager", rowList:[10,20,30],
        loadComplete : function() {
            var table = this;
            setTimeout(function(){
                updatePagerIcons(table);
            }, 0);
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

function format_button_role(cellvalue, options, rowObject){
    var html = '';
    html += '<a href="javascript:void(0)" onclick="detail('+rowObject.id+')">';
        html += 'Xem chi tiết quyền sử dụng';
    html += '</a>';
    return html;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function add(){
    reset_form('#fm'); data = [];
    $('#title').val(null); $('#save_form').show(); $('#title').attr("readonly", false);
    $('#roles').load(baseUrl + '/group_role/data_role?token='+localStorage.getItem('token'));
    $('#modal-role').modal('show');
    url= baseUrl + '/group_role/add?token='+localStorage.getItem('token');
}

function edit(){
    var rowKey = $('#list_role').jqGrid('getGridParam',"selrow");
    if(rowKey == null){
        show_message("error", "Vui lòng chọn bản ghi cần cập nhật");
        return false;
    }else{
        var row = $('#list_role').jqGrid("getRowData", rowKey);
        $('#title').val(row.title); $('#title').attr("readonly", false); data = [];
        $('#roles').load(baseUrl + '/group_role/data_role?id='+row.id+'&token='+localStorage.getItem('token'));
        $('#modal-role').modal('show'); $('#save_form').show();
        url= baseUrl + '/group_role/update?id='+row.id+'&token='+localStorage.getItem('token');
    }
}

function del(idh){
    var data_str = "id="+idh+"&token="+localStorage.getItem('token');
    del_data(data_str, "Bạn có chắc chắn muốn xóa bản ghi này?", baseUrl +'/group_role/del', '#list_role', baseUrl + '/group_role/json?token='+localStorage.getItem('token'));
}

function change(status, idh){
    var data_str = "id="+idh+'&status='+status+'&token='+localStorage.getItem('token');
    del_data(data_str, "Bỏ kích hoạt bản ghi này sẽ ảnh hưởng đến quyền sử dụng của những người dùng đã được cấp quyền. Bạn có chắc chắn muốn thay đổi trạng thái của bản ghi này?", baseUrl + '/group_role/change', '#list_role', baseUrl+'/group_role/json?token='+localStorage.getItem('token'));
}

function save(){
    var required = $('input,textarea,select').filter('[required]:visible');
    var allRequired = true;
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }
    });
    $("input:checkbox[type=checkbox]:checked").each(function(){
        data.push($(this).val());
    });
    if(allRequired){
        $('#datadc').val(btoa(data.join(",")));
        save_form_modal('#fm', url, '#modal-role', '#list_role',  baseUrl+'/group_role/json?token='+localStorage.getItem('token'))
    }else{
        show_message("error", "Chưa điền đủ thông tin");
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function set_checked(idh, id){
    var value = $('#role_'+idh+'_'+id).is(':checked');
    if(value){
        $("input:checkbox[name=role_"+idh+"_"+id+"_]").each(function(){
            $(this).prop('checked', true);
        });
        $('#role'+idh).prop('checked', true);
    }else{
        $("input:checkbox[name=role_"+idh+"_"+id+"_]").each(function(){
            $(this).prop('checked', false);
        });
    }
}

function set_checked_main(id){
    var value = $('#role'+id).is(":checked");
    if(value){
        $("input:checkbox[data_role=role_"+id+"_]").each(function(){
            $(this).prop('checked', true);
        });
    }else{
        $("input:checkbox[data_role=role_"+id+"_]").each(function(){
            $(this).prop('checked', false);
        });
    }
}

function detail(idh){
    var grid = $('#list_role');
    jQuery('#list_role').jqGrid("setSelection", idh);
    var row = grid.jqGrid("getRowData", idh);
    $('input:checkbox').each(function(){
        $(this).prop('disabled', true);
    });
    $('#title').val(row.title); $('#title').attr("readonly", true);
    $('#roles').load(baseUrl + '/group_role/data_role?id='+idh+'&token='+localStorage.getItem('token'));
    $('#modal-role').modal('show'); $('#save_form').hide();
}