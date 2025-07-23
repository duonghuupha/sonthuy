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
            {label: 'Trình độ', name: 'level_title', width: 150, align:"center"},
            {label: 'Chuyên môn', name: 'job_title', width: 150, align:"center"},
            {label: 'Chức vụ', name: 'regency_title', width: 150, align:"center"},
            {label: 'Địa chỉ', name: 'address', width: 350,},
            {label: 'Trạng thái', name: 'status', width: 100, align: "center", formatter: format_trangthai},
            {label: '&nbsp', name: 'id', hidden: true, key: true}
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
    add();
});

function format_trangthai(cellvalue, options, rowObject){
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
    url = baseUrl + '/teacher/add?token=' + localStorage.getItem('token');
    var number = Math.floor(Math.random() * 999999999); $('#refreshcode').show();
    $('#code').val(number); $('.input-mask-date').mask('99-99-9999'); $('.input-mask-phone').mask('9999999999');
    $('#modal-teacher').modal('show');
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
    if(allRequired && vali_email){
        save_form_modal('#fm', url, '#modal-teacher', '#list_teacher',  baseUrl+'/teacher/json?token='+localStorage.getItem('token')); 
    }else{
        show_message("error", "Chưa điền đủ thông tin");
    }
}

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