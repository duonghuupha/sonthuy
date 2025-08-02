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

    }
    $('#play_media').html(html);
}