var url;
$(function(){
    add();
});
//////////////////////////////////////////////////////////////////////////////////////////////////
function refresh_code(){
    var number = Math.floor(Math.random() * 999999999);
    $('#code').val(number);
}

function add(){
    reset_form('#fm');
    var number = Math.floor(Math.random() * 999999999); $('#refreshcode').show();
    $('#code').val(number);
    $('#modal-lesson').modal('show');
    url = baseUrl + '/lesson/add?token='+localStorage.getItem('token');
    setTimeout(() => {
        $('#content_dc').load(baseUrl + '/lesson_dc/index?token='+localStorage.getItem('token'));
    }, 200);
}
//////////////////////////////////////////////////////////////////////////////////////////////
function upload_image_dc(){
    var file = $('#image_dc').val(), validExtensions = ["jpg","pdf","jpeg","gif","png"];
    file = file.split('.').pop();
    if(validExtensions.indexOf(file) == -1){
        show_message("error", "File hình ảnh phải có định dạng: "+validExtensions.join(", "));
        $('#image_dc').ace_file_input('reset_input');
    }else{
        save_upload_lesson('#fm', baseUrl + '/lesson/add_dc', '#content_dc', baseUrl + '/lesson_dc/index?token='+localStorage.getItem('token')+'&code='+$('#code').val());
    }
}

function save_upload_lesson(id_form, post_url, id_content, url_refresh){
    var xhr = new XMLHttpRequest();
    var formData = new FormData($(id_form)[0]);
    $('.overlay').show();
    $.ajax({
        url: post_url,  //server script to process data
        type: 'POST',
        xhr: function() {
            return xhr;
        },
        data: formData,
        success: function(data){
            var result = JSON.parse(data);
            if(result.success == true){
                $('.overlay').hide();
                show_message('success', result.msg);
                $(id_content).load(url_refresh);
            }else{
                $('.overlay').hide();
                show_message('error', result.msg);
                return false;
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
}