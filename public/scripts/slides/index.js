$(function(){
    var height_view = $(window).height() - 100;
    $('#result_search_lesson').load(baseUrl + '/slides/json_lesson?token='+localStorage.getItem('token')+'&q=');
    setTimeout(() => {
        var fotoramaApi = $('.fotorama').data('fotorama'); fotoramaApi.setOptions({height: height_view});
    }, 100);
});

function load_lesson(idh){
    window.location.href = baseUrl + '/slides?token='+localStorage.getItem('token')+'&id='+idh;
}

function search_lesson(){
    var value = $('#keyword').val();
    if(value.length != 0){
        var keyword = value.replaceAll(" ", "$", 'g');
    }else{
        var keyword = '';
    }
    $('#result_search_lesson').load(baseUrl + '/slides/json_lesson?token='+localStorage.getItem('token')+'&q='+keyword);
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function open_media(idh){
    $('#form-detail').load(baseUrl + '/slides/media?token='+localStorage.getItem('token')+'&id='+idh);
    $('.modal-dialog').css("width", "50%"); $('.main-media').empty();
    $('#modal-lesson-extra').modal('show');
}

function play_media(type, lesson_id, file){
    var html = '';
    if(type == 1){ // video
        html += '<video height="350" style="border:1px solid #307ECC" controls autoplay>';
            html += '<source src="'+baseUrl+'/public/lesson/'+lesson_id+'/media/'+file+'" type="video/mp4">';
            html += 'Your browser does not support the video tag.';
        html += '</video>';
    }else{ // audio
        html += '<audio controls autoplay>';
            html += '<source src="'+baseUrl+'/public/lesson/'+lesson_id+'/media/'+file+'" type="audio/mpeg">';
            html += 'Your browser does not support the audio element.';
        html += '</audio>';
    }
    $('.main-media').html(html);
}

function close_media(){
    $('video, audio').each(function(){
        this.pause();
    });
    $('#modal-lesson-extra').modal('hide');
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function open_flashcard(idh){
    $('#form-detail').load(baseUrl + '/slides/flashcard?token='+localStorage.getItem('token')+'&id='+idh);
    $('.modal-dialog').css("width", "50%");
    $('#modal-lesson-extra').modal('show');
    setTimeout(() => {
        $('.flash_card').fotorama({
            height: 500,
            allowfullscreen: true,
            nav: 'thumbs'
        });
    }, 100);
}

function close_flash_card(){
    $('#modal-lesson-extra').modal('hide');
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function open_question(idh){
    $('#form-detail').load(baseUrl + '/slides/question?token='+localStorage.getItem('token')+'&id='+idh);
    $('.modal-dialog').css("width", "90%"); $('#content_question').empty();
    $('#modal-lesson-extra').modal('show');
}

function view_question(idh, type){
    var html = ''; $('#content_question').empty();
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
    $('#content_question').html(html); $(".question-list button").removeClass("active"); $('.btn_'+idh).addClass('active');
}

function close_question(){
    $('#modal-lesson-extra').modal('hide');
}