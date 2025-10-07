var url, id_selected = 0;
$(function(){
    var gwdth = $('#list_lesson_cate').width(), fwdth = $('.full').width();
    $('#list_lesson_cate').jqGrid({
        url: baseUrl + '/lesson_cate/json?token='+localStorage.getItem('token'),
        datatype: "json",
        mtype: "GET",
        colModel: [
            {label: 'Mã danh mục', name: 'code', width: 120, align:"center"},
            {label: 'Hình ảnh', name: 'image', width: 120, align:"center", formatter: format_image},
            {label: 'Tên danh mục', name: 'title', width: 200, formatter: format_title},
            {label: 'Mô tả', name: 'content', width: 300},
            {label: 'Trạng thái', name: 'status', width: 100, align: "center", formatter: format_trangthai},
            {label: 'Cập nhật lần cuối', name: 'create_at', width: 150, align:"center"},
            {label: '&nbsp', name: 'id', hidden: true, key: true},
            {label: '&nbsp', name: 'image', hidden: true},
            {label: '&nbsp', name: 'title', hidden: true},
            {label: '&nbsp', name: 'total_lesson', hidden: true}
        ],
        viewrecords: true, height:200, width: gwdth, rowNum: 20, rownumbers: true,
        height:($('.footer').offset().top - $('.page-header').offset().top - 147),
        pager: "#lesson_cate_pager", rowList:[10,20,30],
        loadComplete : function() {
            var table = this;
            setTimeout(function(){
                updatePagerIcons(table);
            }, 0);
        }
    });
    $('#image, #title, #content').attr('disabled', true);
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

function format_image(cellvalue, options, rowObject){
    var html = '';
    if(cellvalue != ''){
        html += '<img src="'+baseUrl+'/public/lesson/cate/'+cellvalue+'" style="height: 50px;"/>';
    }else{
        html += '<img src="'+baseUrl+'/styles/assets/images/no-image.jpeg" style="height: 50px;"/>';
    }
    return html;
}

function format_title(cellvalue, options, rowObject){
    return cellvalue + ' <b>('+rowObject.total_lesson+' bài học)</b>';
}
///////////////////////////////////////////////////////////////////////////////////////////////////
function refresh_code(){
    if($('#code').val().length == 0){
        show_message("error", "Mã lớp học chưa được tạo, hoặc đã trùng trong hệ thống");
    }else{
        var number = Math.floor(Math.random() * 999999999);
        $('#code').val(number);
    }
}

function add(){
    reset_form('#fm'); $('#image, #title, #content').attr('disabled', false);
    var number = Math.floor(Math.random() * 999999999);
    $('#code').val(number);
    url = baseUrl + '/lesson_cate/add?token='+localStorage.getItem('token');
}

function update(){
    var rowKey = $('#list_lesson_cate').jqGrid('getGridParam',"selrow");
    if(rowKey == null){
        show_message("error", "Vui lòng chọn danh mục cần cập nhật");
        return false;
    }else{
        reset_form('#fm'); $('#image, #title, #content').attr('disabled', false);
        var row = $('#list_lesson_cate').jqGrid("getRowData", rowKey);
        $('#code').val(row.code); $('#title').val(row.title); $('#content').val(row.content);
        $('#image_old').val(row.image);
        url = baseUrl + '/lesson_cate/update?id='+row.id+'&token='+localStorage.getItem('token');
    }
}

function del(){
    var rowKey = $('#list_lesson_cate').jqGrid('getGridParam',"selrow");
    if(rowKey == null){
        show_message("error", "Vui lòng chọn danh mục cần xóa");
        return false;
    }else{
        var row = $('#list_lesson_cate').jqGrid("getRowData", rowKey);
        var data_str = "token="+localStorage.getItem('token')+"&id="+row.id;
        del_data(data_str, "Bạn có chắc muốn xóa danh mục này không?", baseUrl + '/lesson_cate/del', '#list_lesson_cate', baseUrl + '/lesson_cate/json?token='+localStorage.getItem('token'));
    }
}

function change(status, idh){
    var data_str = "token="+localStorage.getItem('token')+"&id="+idh+"&status="+status;
    del_data(data_str, "Bạn có chắc muốn thay đổi trạng thái của danh mục này không?", baseUrl + '/lesson_cate/change', '#list_lesson_cate', baseUrl + '/lesson_cate/json?token='+localStorage.getItem('token'));
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
        save_reject('#fm', url, baseUrl+'/lesson_cate?token='+localStorage.getItem('token')); 
    }else{
        show_message("error", "Chưa điền đủ thông tin");
    }
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function canel_form(){
    reset_form('#fm');
}
