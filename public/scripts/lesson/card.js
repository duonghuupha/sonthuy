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
                $('#list_lesson_card').trigger('reloadGrid'); render_view_lesson(idh);
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
                            $('.overlay').hide(); show_message('success', result.msg);
                            $('#list_lesson_card').trigger('reloadGrid'); render_view_lesson(lesson_id);
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
                $('.overlay').hide(); show_message('success', result.msg); $('#modal-lesson').modal('hide');
                $('#list_lesson_card').trigger('reloadGrid'); render_view_lesson(lesson_id);
            }else{
                $('.overlay').hide();
                show_message('error', result.msg);
                return false;
            }
        }
    });
}

function view_image_card(idh, lesson_id, str_image, order_card){
    $('#document_lesson').empty();
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
                                    <input type="text" id="order_card_${idh}" name="order_card_${idh}" style="width:100%" placeholder="Thứ tự dữ liệu"
                                    onkeypress="validate(event)" value="${order_card}"/>
                                </div>
                            </div>
                        </div>    
                        <div class="col-xs-12 text-center">
                            <img src="${baseUrl}/public/lesson/${lesson_id}/card/${str_image}" style="height:300px;"/>
                        </div>    
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    Đóng
                </button>
                <button class="btn btn-sm btn-primary pull-right" onclick="change_lesson_card(${idh}, ${lesson_id})">
                    <i class="ace-icon fa fa-save"></i>
                    Ghi dữ liệu
                </button>
            </div>
        </div>
    `);
    $('#modal-lesson').modal('show');
}