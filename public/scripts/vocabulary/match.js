function add_match_answer(){
    var index = Math.floor(Math.random() * 9999);
    var str = {'id': index, 'answer_a': '', 'file_a': '', 'answer_b': '', 'file_b': '', 'file_a_old': '', 'file_b_old': ''};
    myData_match.push(str);
    render_data_match();
}

function render_data_match(){
    var html = ''; $('#table_match_tbody').empty();
    for(i in myData_match){
        html += `
            <tr id="row_${myData_match[i].id}">
                <td style="width:45%;height:100px">
                    <input type="text" class="form-control" name="answer_left_${myData_match[i].id}" id="answer_left_${myData_match[i].id}" 
                    value="${myData_match[i].answer_a}" placeholder="Nội dung" onchange="change_data_match(1, ${myData_match[i].id})" style="margin-bottom:7px;"/>

                    <input type="file" class="file_attach" name="file_left_${myData_match[i].id}" id="file_left_${myData_match[i].id}" style="width:100%;" 
                    onchange="change_data_match(2, ${myData_match[i].id})"/>
                </td>
                <td style="width:45%">
                    <input type="text" class="form-control" name="answer_right_${myData_match[i].id}" id="answer_right_${myData_match[i].id}" value="${myData_match[i].answer_b}" 
                    placeholder="Nội dung" onchange="change_data_match(3, ${myData_match[i].id})" style="margin-bottom:7px;"/>

                    <input type="file" class="file_attach" name="file_right_${myData_match[i].id}" id="file_right_${myData_match[i].id}" style="width:100%;" 
                    onchange="change_data_match(4, ${myData_match[i].id})"/>
                </td>
                <td style="width:5%;text-align:center">
                    <a href="javascript:void(0)" onclick="remove_match_answer(${myData_match[i].id})" title="Xóa" style="color:red">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
        `;
    }
    $('#table_match_tbody').html(html);
    setTimeout(() => {
        $('.file_attach').ace_file_input({
            no_file:'Không có file ...',btn_choose:'Lựa chọn',
            btn_change:'Thay đổi',droppable:false,
            onchange:null,thumbnail:true
        });
    }, 50);
}

function change_data_match(type, idh_temp){
    var objIndex = myData_match.findIndex(item => item.id == idh_temp);
    if(type == 1){ // title a
        myData_match[objIndex].answer_a = $('#answer_left_'+idh_temp).val();
    }else if(type == 2){ // file a
        var file = $('#file_left_'+idh_temp)[0].files[0]; var formData = new FormData();
        formData.append('file', file);
        $.ajax({
            url: baseUrl + '/match/upload_file?token='+localStorage.getItem('token')+'&type=vocab',
            type: 'POST', data: formData, contentType: false, processData: false,
            success: function(data) {
                var result = JSON.parse(data);
                if(result.success){
                    myData_match[objIndex].file_a = result.file;
                }else{
                    show_message("error", "Tải file không thành công");
                    return;
                }
            }
        });
    }else if(type == 3){ // title b
        myData_match[objIndex].answer_b = $('#answer_right_'+idh_temp).val();
    }else{ // file b
        var file = $('#file_right_'+idh_temp)[0].files[0]; var formData = new FormData();
        formData.append('file', file);
        $.ajax({
            url: baseUrl + '/match/upload_file?token='+localStorage.getItem('token')+'&type=vocab',
            type: 'POST', data: formData, contentType: false, processData: false,
            success: function(data) {
                var result = JSON.parse(data);
                if(result.success){
                    myData_match[objIndex].file_b = result.file;
                }else{
                    show_message("error", "Tải file không thành công");
                    return;
                }
            }
        });
    }
    //console.log(myData_match);
}

function remove_match_answer(idh){
    myData_match = myData_match.filter(item => item.id != idh);
    render_data_match();
}