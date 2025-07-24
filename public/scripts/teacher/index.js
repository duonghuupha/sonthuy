var url = '';
$(function(){
    var gwdth = $('#list_teacher').width(), fwdth = $('.full').width();
    $('#list_teacher').jqGrid({
        url: baseUrl + '/teacher/json?token='+localStorage.getItem('token'),
        datatype: "json",
        mtype: "GET",
        colModel: [
            {label: 'Mã nhân sự', name: 'code', width: 120, align:"center"},
            {label: 'Họ và tên', name: 'fullname', width: 200},
            {label: 'Giới tính', name: 'gender', width: 100, align:"center", formatter: format_gender},
            {label: 'Ngày sinh', name: 'birthday', width: 150, align:"center"},
            {label: 'Điện thoại', name: 'phone', width: 150, align:"center"},
            {label: 'Trình độ', name: 'level', width: 150, align:"center"},
            {label: 'Email', name: 'email', width: 200,},
            {label: 'Địa chỉ', name: 'address', width: 350,},
            {label: 'Trạng thái', name: 'status', width: 100, align: "center", formatter: format_trangthai},
            {label: '&nbsp', name: 'id', hidden: true, key: true},
            {label: '&nbsp', name: 'gender', hidden: true},
            {label: '&nbsp', name: 'image', hidden: true}
        ],
        viewrecords: true, height:200, width: gwdth, rowNum: 20, rownumbers: true,
        height:($('.footer').offset().top - $('.page-header').offset().top - 147),
        pager: "#teacher_pager", rowList:[10,20,30],
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

function format_gender(cellvalue, options, rowObject){
    if(cellvalue == 1){
        return 'Nam';
    }else if(cellvalue == 2){
        return 'Nữ';
    }else{
        return 'Khác';
    }
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function refresh_code(){
    var number = Math.floor(Math.random() * 999999999);
    $('#code').val(number);
}

function add(){
    var number = Math.floor(Math.random() * 999999999); $('#refreshcode').show();
    $('#code').val(number); $('.input-mask-date').mask('99-99-9999'); $('.input-mask-phone').mask('9999999999');
    $('#modal-teacher').modal('show'); $('#delete_image').hide();
    url = baseUrl + '/teacher/add?token=' + localStorage.getItem('token');
}

function update(){
    reset_form('#fm');
    var rowKey = $('#list_teacher').jqGrid('getGridParam',"selrow");
    if(rowKey == null){
        show_message("error", "Vui lòng chọn nhân sự cần cập nhật");
        return false;
    }else{
        var row = $('#list_teacher').jqGrid("getRowData", rowKey);
        $('#code').val(row.code); $('#fullname').val(row.fullname); $('#birthday').val(row.birthday);
        $('#gender').val(row.gender).trigger('change'); $('#address').val(row.address); $('#phone').val(row.phone);
        $('#email').val(row.email); $('#level').val(row.level); $('#image_old').val(row.image);
        $('#modal-teacher').modal('show');
        url = baseUrl + '/teacher/update?token=' + localStorage.getItem('token') + '&id=' + row.id;
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
    var allRequired = true, vali_email = true;
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }
    });
    if(!validateEmail($('#email').val())){
        vali_email = false;
    }
    if(allRequired){
        if(vali_email){
            save_form_modal('#fm', url, '#modal-teacher', '#list_teacher',  baseUrl+'/teacher/json?token='+localStorage.getItem('token')); 
        }else{
            show_message("error", "Email không hợp lệ");
        }
    }else{
        show_message("error", "Chưa điền đủ thông tin");
    }
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function check_type(){
    var file = $('#image').val(), validExtensions = ["jpg","pdf","jpeg","gif","png"];
    file = file.split('.').pop();
    if(validExtensions.indexOf(file) == -1){
        show_message("error", "File hình ảnh phải có định dạng: "+validExtensions.join(", "));
        $('#image').ace_file_input('reset_input');
    }else{
        return true;
    }
}

function validate_phone(val){
    if(val.length < 10){
        show_message("error", "Số điện thoại không hợp lệ");
        $('#phone').val('');
    }
}