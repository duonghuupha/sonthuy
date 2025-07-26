var url, id_selected = 0;
$(function(){
    var height = $('.footer').offset().top - $('.page-header').offset().top - 67;
    $('#list_lesson_cate').load(baseUrl + '/lesson_cate/json?token'+localStorage.getItem('token'));
    setTimeout(() => {
        $('.table-container').css({'max-height': height+'px'});
    }, 200);
});

function refresh_code(){
    if($('#code').val().length == 0){
        show_message("error", "Mã lớp học chưa được tạo, hoặc đã trùng trong hệ thống");
    }else{
        var number = Math.floor(Math.random() * 999999999);
        $('#code').val(number);
    }
}

function add(){
    reset_form('#fm');
    var number = Math.floor(Math.random() * 999999999);
    $('#code').val(number);
    url = baseUrl + '/lesson_cate/add?token='+localStorage.getItem('token');
}

function update(){
    if(id_selected == 0){
        show_message("error", "Chưa chọn danh mục cần sửa");    
    }else{
        reset_form('#fm');
        var data_str = getRemote(baseUrl + '/lesson_cate/get_row?id='+id_selected+'&token='+localStorage.getItem('token'));
        var row = JSON.parse(data_str);
        $('#code').val(row.code); $('#title').val(row.title); $('#content').val(row.content);
        $('#parent_id').val(row.parent_id).trigger('change');
        url = baseUrl + '/lesson_cate/update?id='+id_selected+'&token='+localStorage.getItem('token');
    }
}

function del(){
    if(id_selected == 0){
        show_message("error", "Chưa chọn danh mục cần xóa");    
    }else{
        var data_str = "token="+localStorage.getItem('token')+"&id="+id_selected;
        del_refresh_content(data_str, "Bạn có chắc muốn xóa danh mục này không?", baseUrl + '/lesson_cate/del', '#list_lesson_cate', baseUrl + '/lesson_cate/json?token='+localStorage.getItem('token'));
    }
}

function change(status, idh){
    var data_str = "token="+localStorage.getItem('token')+"&id="+idh+"&status="+status;
    del_refresh_content(data_str, "Bạn có chắc muốn thay đổi trạng thái của danh mục này không?", baseUrl + '/lesson_cate/change', '#list_lesson_cate', baseUrl + '/lesson_cate/json?token='+localStorage.getItem('token'));
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
        save_form_refresh_div('#fm', url, '#list_lesson_cate',  baseUrl+'/lesson_cate/json?token='+localStorage.getItem('token')); 
    }else{
        show_message("error", "Chưa điền đủ thông tin");
    }
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function canel_form(){
    reset_form('#fm');
}

function select_row(idh){
    $('tr[id^="row_"]').removeClass('active_row');
    $('#row_'+idh).addClass('active_row'); id_selected = idh;
}

function getRemote(remote_url){
    return $.ajax({
        type: 'GET',
        url: remote_url,
        async: false
    }).responseText;
}