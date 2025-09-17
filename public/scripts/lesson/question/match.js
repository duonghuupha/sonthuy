function add_match_answer(){
    var index = Math.floor(Math.random() * 9999);
    $('#table_match_tbody').append(`
        <tr id="row_${index}">
            <td style="width:45%;height:100px">
                <form id="left_title_${index}" method="post" enctype="multipart/form-data">
                    <input type="text" class="form-control" name="answer_left_${index}" id="answer_left_${index}" value="" placeholder="Nội dung" onchange="change_data_match(1, ${index}, 'left_title_')" style="margin-bottom:7px;"/>
                </form>
                <form id="left_file_${index}">
                    <input type="file" class="file_attach" name="file_left_${index}" id="file_left_${index}" style="width:100%;" onchange="change_data_match(2, ${index}, 'left_file_')"/>
                </form>
                </td>
            <td style="width:45%">
                <form id="right_title_${index}" method="post" enctype="multipart/form-data">
                    <input type="text" class="form-control" name="answer_right_${index}" id="answer_right_${index}" value="" placeholder="Nội dung" onchange="change_data_match(3, ${index}, 'right_title_')" style="margin-bottom:7px;"/>
                </form>
                <form id="right_file_${index}">
                    <input type="file" class="file_attach" name="file_right_${index}" id="file_right_${index}" style="width:100%;" onchange="change_data_match(4, ${index}, 'right_file_')"/>
                </form>
                </td>
            <td style="width:5%;text-align:center">
                <a href="javascript:void(0)" onclick="remove_match_answer(${index})" title="Xóa" style="color:red">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
            </td>
        </tr>
    `);
    setTimeout(() => {
        $('.file_attach').ace_file_input({
            no_file:'Không có file ...',btn_choose:'Lựa chọn',
            btn_change:'Thay đổi',droppable:false,
            onchange:null,thumbnail:true
        });
    }, 50);
}

function change_data_match(type, idh, id_form){
    var lesson_id = getParameterByName('id'), code_question = $('#code').val();
    upload_file_match('#'+id_form+idh, baseUrl + '/match/add_item?token='+localStorage.getItem('token')+'&type='+type+'&id_temp='+idh+'&code_question='+code_question+'&lesson_id='+atob(lesson_id));
}

function remove_match_answer(idh){
    $('#row_'+idh).remove();
}

function cancel_match(){
    $('#code').val();
    $('#')
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function upload_file_match(id_form, post_url){
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
////////////////////////////////////////////////////////////////////////////////////////////////////////////
function getParameterByName(name, url = window.location.href) {
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}