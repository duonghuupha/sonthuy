function view_media(lesson_id){
    $('#modal-lesson-media').modal('show');
    setTimeout(() => {
        var height = $(window).height() - 300;
        $('#height-lesson-media').css({'height': height});
    }, 200);
}

function play_media(type, lesson_id, str_file){
    var html = '', height = $(window).height() - 330;
    if(type == 1){ // chay file video
        html += '<video height="'+height+'" style="border:1px solid #307ECC" controls autoplay>';
            html += '<source src="'+baseUrl+'/public/lesson/'+lesson_id+'/media/'+str_file+'" type="video/mp4">';
            html += 'Your browser does not support the video tag.';
        html += '</video>';
    }else{ // chay file am thanh
        html += '<audio controls autoplay height="'+height+'" style="border:1px solid #307ECC">';
            html += '<source src="'+baseUrl+'/public/lesson/'+lesson_id+'/media/'+str_file+'" type="audio/mp3">';
            html += 'Your browser does not support the video tag.';
        html += '</audio>';
    }
    $('#play_media').html(html);
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function view_flash_card(lesson_id){
    $('#modal-lesson-card').modal('show'); var height_body = $(window).height() - 200;
    $('.flash_card').fotorama({
            height: (height_body - 100),
            allowfullscreen: true,
            nav: 'thumbs'
        });
    setTimeout(() => {
        $('#height-lesson-card').css({'height': height_body});
    }, 200);
}

function close_modal_media_view_lesson(){
    $('video, audio').each(function(){
        this.pause();
    });
    $('#modal-lesson-media').modal('hide');
}