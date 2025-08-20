var myData_lesson_dc = [], myData_lesson_media = [], myData_lesson_card = [];
$(function(){
    var id_glgobal = getParameterByName('id'); render_view_lesson(atob(id_glgobal));
    $('#accordion').on('show.bs.collapse', function(e){
        var id_lesson = e.target.dataset.value;
        /*****************lesson dc****************************************************************************************** */
        var str_lesson_dc = getRemote(baseUrl + '/lesson_dc/json?token='+localStorage.getItem('token')+'&id='+id_lesson);
        myData_lesson_dc = JSON.parse(str_lesson_dc); render_list_lesson_dc();
        /*****************lesson media****************************************************************************************** */
        var str_lesson_media = getRemote(baseUrl + '/lesson_media/json?token='+localStorage.getItem('token')+'&id='+id_lesson);
        myData_lesson_media = JSON.parse(str_lesson_media); render_list_lesson_media();
        /*****************lesson card****************************************************************************************** */
        var str_lesson_card = getRemote(baseUrl + '/lesson_card/json?token='+localStorage.getItem('token')+'&id='+id_lesson);
        myData_lesson_card = JSON.parse(str_lesson_card); render_list_lesson_card();
    });
});
//////////////////////////////////////////////////Lesson document///////////////////////////////////////////////////////////////////////////////////////////////////////
function upload_dc(idh){
    var xhr = new XMLHttpRequest();
    var formData = new FormData($('#fm-dc')[0]);
    $('.overlay').show();
    $.ajax({
        url: baseUrl + '/lesson_dc/add?token='+localStorage.getItem('token')+'&id='+idh,  //server script to process data
        type: 'POST',
        xhr: function() {
            return xhr;
        },
        data: formData,
        success: function(data){
            var result = JSON.parse(data);
            if(result.success == true){
                $('.overlay').hide();
                show_message('success', result.msg); $('.file_attach').ace_file_input('reset_input');
                var str_lesson_dc = getRemote(baseUrl + '/lesson_dc/json?token='+localStorage.getItem('token')+'&id='+result.lesson_id);
                myData_lesson_dc = JSON.parse(str_lesson_dc); render_list_lesson_dc(); render_view_lesson(result.lesson_id);
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

function render_list_lesson_dc(){
    var html = ''; $('#tbody_lesson_dc').empty();
    for(var i = 0; i < myData_lesson_dc.length; i++){
        html += '<tr>';
            html += '<td><a href="#" onclick="view_image('+myData_lesson_dc[i].id+')">'+myData_lesson_dc[i].image+'</a></td>';
            html += '<td>';
                html += '<input type="text" id="order_dc_'+myData_lesson_dc[i].id+'" name="order_dc_'+myData_lesson_dc[i].id+'" class="form-controll" style="width:100%;text-align:center"';
                html += 'onchange="change_lesson_dc('+myData_lesson_dc[i].id+', '+myData_lesson_dc[i].lesson_id+')" onkeypress="validate(event)" value="'+myData_lesson_dc[i].order_dc+'"/>';
            html += '</td>';
            html += '<td style="text-align:center">';
                html += '<a href="javascript:void(0)" onclick="del_lesson_dc('+myData_lesson_dc[i].id+', '+myData_lesson_dc[i].lesson_id+')">';
                    html += '<i class="fa fa-trash" style="color:red"></i>';
                html += '</a>';
            html += '</td>';
        html += '</tr>';
    }
    $('#tbody_lesson_dc').html(html);
}

function del_lesson_dc(idh, lesson_id){
    bootbox.confirm({
        message: "Bạn có chắc chắn muốn xóa file của bài giảng này?",
        buttons:{
            confirm: {
                label: "Đồng ý",
                className: "btn-danger btn-sm"
            },
            cancel: {
                label: "Không đồng ý",
                className: "btn-primary btn-sm"
            }
        },
        callback: function(result){
            if(result){
                $('.overlay').show();
                $.ajax({
                    type: "POST",
                    url: baseUrl + '/lesson_dc/del?token='+localStorage.getItem('token'),
                    data: "id="+idh+'&lesson_id='+lesson_id, // serializes the form's elements.
                    success: function(data){
                        var result = JSON.parse(data);
                        if(result.success == true){
                            $('.overlay').hide();
                            show_message('success', result.msg);
                            var str_lesson_dc = getRemote(baseUrl + '/lesson_dc/json?token='+localStorage.getItem('token')+'&id='+result.lesson_id);
                            myData_lesson_dc = JSON.parse(str_lesson_dc); render_list_lesson_dc(); render_view_lesson(result.lesson_id);
                        }else{
                            $('.overlay').hide();
                            show_message('error', result.msg);
                            return false;
                        }
                    }
                });
            }
        }
    });
}

function change_lesson_dc(idh, lesson_id){
    $('.overlay').show();
    $.ajax({
        type: "POST",
        url: baseUrl + '/lesson_dc/update?token='+localStorage.getItem('token')+'&id='+idh,
        data: "lesson_id="+lesson_id+"&order_dc="+$('#order_dc_'+idh).val(), // serializes the form's elements.
        success: function(data){
            var result = JSON.parse(data);
            if(result.success == true){
                $('.overlay').hide();
                show_message('success', result.msg);
                var str_lesson_dc = getRemote(baseUrl + '/lesson_dc/json?token='+localStorage.getItem('token')+'&id='+result.lesson_id);
                myData_lesson_dc = JSON.parse(str_lesson_dc); render_list_lesson_dc();
                render_view_lesson(result.lesson_id);
            }else{
                $('.overlay').hide();
                show_message('error', result.msg);
                return false;
            }
        }
    });
}
//////////////////////////////////////////////////////////////////Lesson Media////////////////////////////////////////////////////////////////////////////////////////////////////
function upload_media(idh){
    var xhr = new XMLHttpRequest();
    var formData = new FormData($('#fm-media')[0]);
    $('.overlay').show();
    $.ajax({
        url: baseUrl + '/lesson_media/add?token='+localStorage.getItem('token')+'&id='+idh,  //server script to process data
        type: 'POST',
        xhr: function() {
            return xhr;
        },
        data: formData,
        success: function(data){
            var result = JSON.parse(data);
            if(result.success == true){
                $('.overlay').hide();
                show_message('success', result.msg); $('.file_attach').ace_file_input('reset_input');
                var str_lesson_media = getRemote(baseUrl + '/lesson_media/json?token='+localStorage.getItem('token')+'&id='+result.lesson_id);
                myData_lesson_media = JSON.parse(str_lesson_media); render_list_lesson_media(); render_view_lesson(result.lesson_id);
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

function render_list_lesson_media(){
    var html = ''; $('#tbody_lesson_media').empty();
    for(var i = 0; i < myData_lesson_media.length; i++){
        html += '<tr>';
            html += '<td><a href="#" onclick="view_image('+myData_lesson_media[i].id+')">'+myData_lesson_media[i].file+'</a></td>';
            html += '<td>';
                html += '<input type="text" id="order_media_'+myData_lesson_media[i].id+'" name="order_media_'+myData_lesson_media[i].id+'" class="form-controll" style="width:100%;text-align:center"';
                html += 'onchange="change_lesson_media('+myData_lesson_media[i].id+', '+myData_lesson_media[i].lesson_id+')" onkeypress="validate(event)" value="'+myData_lesson_media[i].order_media+'"/>';
            html += '</td>';
            html += '<td style="text-align:center">';
                html += '<a href="javascript:void(0)" onclick="del_lesson_media('+myData_lesson_media[i].id+', '+myData_lesson_media[i].lesson_id+')">';
                    html += '<i class="fa fa-trash" style="color:red"></i>';
                html += '</a>';
            html += '</td>';
        html += '</tr>';
    }
    $('#tbody_lesson_media').html(html);
}

function del_lesson_media(idh, lesson_id){
    bootbox.confirm({
        message: "Bạn có chắc chắn muốn xóa file media của bài giảng này?",
        buttons:{
            confirm: {
                label: "Đồng ý",
                className: "btn-danger btn-sm"
            },
            cancel: {
                label: "Không đồng ý",
                className: "btn-primary btn-sm"
            }
        },
        callback: function(result){
            if(result){
                $('.overlay').show();
                $.ajax({
                    type: "POST",
                    url: baseUrl + '/lesson_media/del?token='+localStorage.getItem('token'),
                    data: "id="+idh+'&lesson_id='+lesson_id, // serializes the form's elements.
                    success: function(data){
                        var result = JSON.parse(data);
                        if(result.success == true){
                            $('.overlay').hide();
                            show_message('success', result.msg);
                            var str_lesson_media = getRemote(baseUrl + '/lesson_media/json?token='+localStorage.getItem('token')+'&id='+result.lesson_id);
                            myData_lesson_media = JSON.parse(str_lesson_media); render_list_lesson_media(); render_view_lesson(result.lesson_id);
                        }else{
                            $('.overlay').hide();
                            show_message('error', result.msg);
                            return false;
                        }
                    }
                });
            }
        }
    });
}

function change_lesson_media(idh, lesson_id){
    $('.overlay').show();
    $.ajax({
        type: "POST",
        url: baseUrl + '/lesson_media/update?token='+localStorage.getItem('token')+'&id='+idh,
        data: "lesson_id="+lesson_id+"&order_media="+$('#order_media_'+idh).val(), // serializes the form's elements.
        success: function(data){
            var result = JSON.parse(data);
            if(result.success == true){
                $('.overlay').hide();
                show_message('success', result.msg);
                var str_lesson_media = getRemote(baseUrl + '/lesson_media/json?token='+localStorage.getItem('token')+'&id='+result.lesson_id);
                myData_lesson_media = JSON.parse(str_lesson_media); render_list_lesson_media();
                render_view_lesson(result.lesson_id);
            }else{
                $('.overlay').hide();
                show_message('error', result.msg);
                return false;
            }
        }
    });
}
////////////////////////////////////////////////////////Lesson flash card//////////////////////////////////////////////////////////////////////////////////////////////
function upload_card(idh){
    var xhr = new XMLHttpRequest();
    var formData = new FormData($('#fm-card')[0]);
    $('.overlay').show();
    $.ajax({
        url: baseUrl + '/lesson_card/add?token='+localStorage.getItem('token')+'&id='+idh,  //server script to process data
        type: 'POST',
        xhr: function() {
            return xhr;
        },
        data: formData,
        success: function(data){
            var result = JSON.parse(data);
            if(result.success == true){
                $('.overlay').hide();
                show_message('success', result.msg); $('.file_attach').ace_file_input('reset_input');
                var str_lesson_card = getRemote(baseUrl + '/lesson_card/json?token='+localStorage.getItem('token')+'&id='+result.lesson_id);
                myData_lesson_card = JSON.parse(str_lesson_card); render_list_lesson_card(); render_view_lesson(result.lesson_id);
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

function render_list_lesson_card(){
    var html = ''; $('#tbody_lesson_card').empty();
    for(var i = 0; i < myData_lesson_card.length; i++){
        html += '<tr>';
            html += '<td><a href="#" onclick="view_image('+myData_lesson_card[i].id+')">'+myData_lesson_card[i].image+'</a></td>';
            html += '<td>';
                html += '<input type="text" id="order_card_'+myData_lesson_card[i].id+'" name="order_media_'+myData_lesson_card[i].id+'" class="form-controll" style="width:100%;text-align:center"';
                html += 'onchange="change_lesson_card('+myData_lesson_card[i].id+', '+myData_lesson_card[i].lesson_id+')" onkeypress="validate(event)" value="'+myData_lesson_card[i].order_card+'"/>';
            html += '</td>';
            html += '<td style="text-align:center">';
                html += '<a href="javascript:void(0)" onclick="del_lesson_card('+myData_lesson_card[i].id+', '+myData_lesson_card[i].lesson_id+')">';
                    html += '<i class="fa fa-trash" style="color:red"></i>';
                html += '</a>';
            html += '</td>';
        html += '</tr>';
    }
    $('#tbody_lesson_card').html(html);
}

function del_lesson_card(idh, lesson_id){
    bootbox.confirm({
        message: "Bạn có chắc chắn muốn xóa file flash card của bài giảng này?",
        buttons:{
            confirm: {
                label: "Đồng ý",
                className: "btn-danger btn-sm"
            },
            cancel: {
                label: "Không đồng ý",
                className: "btn-primary btn-sm"
            }
        },
        callback: function(result){
            if(result){
                $('.overlay').show();
                $.ajax({
                    type: "POST",
                    url: baseUrl + '/lesson_card/del?token='+localStorage.getItem('token'),
                    data: "id="+idh+'&lesson_id='+lesson_id, // serializes the form's elements.
                    success: function(data){
                        var result = JSON.parse(data);
                        if(result.success == true){
                            $('.overlay').hide();
                            show_message('success', result.msg);
                            var str_lesson_card = getRemote(baseUrl + '/lesson_card/json?token='+localStorage.getItem('token')+'&id='+result.lesson_id);
                            myData_lesson_card = JSON.parse(str_lesson_card); render_list_lesson_card(); render_view_lesson(result.lesson_id);
                        }else{
                            $('.overlay').hide();
                            show_message('error', result.msg);
                            return false;
                        }
                    }
                });
            }
        }
    });
}

function change_lesson_card(idh, lesson_id){
    $('.overlay').show();
    $.ajax({
        type: "POST",
        url: baseUrl + '/lesson_card/update?token='+localStorage.getItem('token')+'&id='+idh,
        data: "lesson_id="+lesson_id+"&order_card="+$('#order_card_'+idh).val(), // serializes the form's elements.
        success: function(data){
            var result = JSON.parse(data);
            if(result.success == true){
                $('.overlay').hide();
                show_message('success', result.msg);
                var str_lesson_card = getRemote(baseUrl + '/lesson_card/json?token='+localStorage.getItem('token')+'&id='+result.lesson_id);
                myData_lesson_card = JSON.parse(str_lesson_card); render_list_lesson_card();
                render_view_lesson(result.lesson_id);
            }else{
                $('.overlay').hide();
                show_message('error', result.msg);
                return false;
            }
        }
    });
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function getRemote(remote_url){
    return $.ajax({
        type: 'GET',
        url: remote_url,
        async: false
    }).responseText;
}

function getParameterByName(name, url = window.location.href) {
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function render_view_lesson(lesson_id){
    var height_view = $('.footer').offset().top - $('.page-header').offset().top - 147;
    $('#view_lesson').load(baseUrl + '/lesson/view_lesson?token='+localStorage.getItem('token')+'&id='+btoa(lesson_id));
    setTimeout(() => {
        var fotoramaApi = $('.fotorama').data('fotorama'); fotoramaApi.setOptions({height: height_view});
    }, 200);
}