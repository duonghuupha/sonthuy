$(function(){
    
});

function load_lesson(idh){
    let html = ''; $('.lesson_dc').empty(); 
    var height_view = $(window).height() - 100;
    var data = getRemote(baseUrl + '/slides/json_lesson?token='+localStorage.getItem('token')+'&id='+idh);
    data = JSON.parse(data);
    for(i in data){
        html += '<img src="'+baseUrl+'/public/lesson/'+idh+'/dc/'+data[i].image+'"/>';
    }
    $('.lesson_dc').html(html);
    setTimeout(() => {
        $('.lesson_dc').fotorama({nav: 'thumbs', allowfullscreen: true});
        var fotoramaApi = $('.lesson_dc').data('fotorama'); fotoramaApi.setOptions({height: height_view});
    }, 100);
}

function getRemote(remote_url){
    return $.ajax({
        type: 'GET',
        url: remote_url,
        async: false
    }).responseText;
}