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
                $('#list_lesson_media').trigger('reloadGrid'); render_view_lesson(idh);
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
                            $('.overlay').hide(); show_message('success', result.msg);
                            render_view_lesson(lesson_id); $('#list_lesson_media').trigger('reloadGrid');
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
                $('.overlay').hide(); show_message('success', result.msg); $('#modal-lesson').modal('hide');
                render_view_lesson(lesson_id); $('#list_lesson_media').trigger('reloadGrid');
                $('video, audio').each(function(){this.pause();});
            }else{
                $('.overlay').hide();
                show_message('error', result.msg);
                return false;
            }
        }
    });
}

function view_lesson_media(idh, lesson_id, str_file, order_media){
    $('#document_lesson').empty(); let content = '';
    if(str_file.split('.').pop().toLowerCase() == 'mp3'){
        content = `
            <audio controls class="img_responsive" style="max-height:200px">
                <source src="${baseUrl}/public/lesson/${lesson_id}/media/${str_file}" type="audio/${str_file.split('.').pop().toLowerCase()}">
                Trình duyệt của bạn không hỗ trợ thẻ audio.
            </audio>
        `;
    }else if(str_file.split('.').pop().toLowerCase() == 'mp4'){
        content = `
            <video controls class="img_responsive" style="max-height:200px">
                <source src="${baseUrl}/public/lesson/${lesson_id}/media/${str_file}" type="video/${str_file.split('.').pop().toLowerCase()}">
                Trình duyệt của bạn không hỗ trợ thẻ video.
            </video>
        `;
    }
    $('#document_lesson').append(`
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    Chi tiết tư liệu
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="fm-dc-edit" method="post" enctype="multipart/form-data">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="form-field-username">Thứ tự dữ liệu</label>
                                <div>
                                    <input type="text" id="order_media_${idh}" name="order_media_${idh}" style="width:100%" placeholder="Thứ tự dữ liệu"
                                    onkeypress="validate(event)" value="${order_media}"/>
                                </div>
                            </div>
                        </div>    
                        <div class="col-xs-12 text-center">${content}</div>    
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger pull-left" onclick="close_lesson_media()">
                    <i class="ace-icon fa fa-times"></i>
                    Đóng
                </button>
                <button class="btn btn-sm btn-primary pull-right" onclick="change_lesson_media(${idh}, ${lesson_id})">
                    <i class="ace-icon fa fa-save"></i>
                    Ghi dữ liệu
                </button>
            </div>
        </div>
    `);
    $('#modal-lesson').modal('show');
}

function close_lesson_media(){
    $('video, audio').each(function(){
        this.pause();
    });
    $('#modal-lesson').modal('hide');
}