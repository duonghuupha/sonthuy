function add_target(){
    var index = Math.floor(Math.random() * 99999);
    var str = {'id': index, 'title': '', 'file': '', 'file_old': '', 'id_temp': index};
    myData_drag_drop_target.push(str);
    render_drag_drop_target();
}

function add_answer(){
    var index = Math.floor(Math.random() * 99999);
    var str = {'id': index, 'title': '', 'file': '', 'file_old': '', 'target_id': 0};
    myData_drag_drop_answer.push(str);
    remove_drag_drop_answer();
}

function render_drag_drop_target(){
    var html = ''; $('#drag_drop_target').empty();
    for(i in myData_drag_drop_target){
        count_target = parseInt(i)+1;
        html += `
        <fieldset style="margin-top:10px;" id="fm_target_${myData_drag_drop_target[i].id}">
            <legend style="font-weight:normal;font-size:14px;margin-bottom:5px;">
                Ô đích số ${count_target}
                <a href="javascript:void(0)" onclick="remove_drag_drop_target(${myData_drag_drop_target[i].id})">
                    <i class="ace-icon fa fa-trash"></i> 
                </a>
            </legend>
            <input type="text" class="form-control" name="target_title_${myData_drag_drop_target[i].id}" id="target_title_${myData_drag_drop_target[i].id}" 
            value="${myData_drag_drop_target[i].title}" placeholder="Nội dung" onchange="change_data_target(1, ${myData_drag_drop_target[i].id})" style="margin-bottom:7px;"/>

            <input type="file" class="file_attach" name="file_target_${myData_drag_drop_target[i].id}" id="file_target_${myData_drag_drop_target[i].id}" style="width:100%;" 
            onchange="change_data_target(2, ${myData_drag_drop_target[i].id})"/>
        </fieldset>
        `;
    }
    $('#drag_drop_target').html(html);
    setTimeout(() => {
        $('.file_attach').ace_file_input({
            no_file:'Không có file ...',btn_choose:'Lựa chọn',
            btn_change:'Thay đổi',droppable:false,
            onchange:null,thumbnail:true
        });
    }, 50);
}

function render_drag_drop_answer(){
    var html = '', option = ''; $('#drag_drop_answer').empty();
    for(i in myData_drag_drop_answer){
        count_answer = parseInt(i)+1;
        html += `
        <div class="col-sm-6" id="item_${myData_drag_drop_answer[i].id}">
            <fieldset style="margin-top:10px;">
                <legend style="font-weight:normal;font-size:14px;margin-bottom:5px;">
                    Đáp án số ${count_answer}
                    <a href="javascript:void(0)" onclick="remove_drag_drop_answer(${myData_drag_drop_answer[i].id})">
                        <i class="ace-icon fa fa-trash"></i> 
                    </a>
                </legend>
                <form id="answer_${myData_drag_drop_answer[i].id}" method="post" enctype="multipart/form-data">
                    <select class="select2" data-placeholder="Lựa chọn đích..." style="width:100%;"
                    id="target_combo_${myData_drag_drop_answer[i].id}" name="target_combo_${myData_drag_drop_answer[i].id}" data-minimum-results-for-search="Infinity"
                    onchange="change_data_answer(0, ${myData_drag_drop_answer[i].id})">
                        <option value="">--Lựa chọn đich--</option>
                        ${
                            myData_drag_drop_target.map(o => `<option value="${o.id_temp}" ${o.id_temp == myData_drag_drop_answer[i].target_id ? 'selected' : ''}>${o.title}</option>`).join('')
                        }
                    </select>

                    <input type="text" class="form-control" name="answer_title_${myData_drag_drop_answer[i].id}" id="answer_title_${myData_drag_drop_answer[i].id}" 
                    value="${myData_drag_drop_answer[i].title}" placeholder="Nội dung" onchange="change_data_answer(1, ${myData_drag_drop_answer[i].id})" 
                    style="margin-bottom:7px;margin-top:7px;"/>

                    <input type="file" class="file_attach" name="file_answer_${myData_drag_drop_answer[i].id}" id="file_answer_${myData_drag_drop_answer[i].id}" style="width:100%;" 
                    onchange="change_data_answer(2, ${myData_drag_drop_answer[i].id})"/>
                </form>
            </fieldset>
        </div>
        `;
    }
    $('#drag_drop_answer').html(html);
    setTimeout(() => {
        $('.file_attach').ace_file_input({
            no_file:'Không có file ...',btn_choose:'Lựa chọn',
            btn_change:'Thay đổi',droppable:false,
            onchange:null,thumbnail:true
        });
    }, 50);
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function change_data_target(type, idh){
    var objIndex = myData_drag_drop_target.findIndex(item => item.id == idh);
    if(type == 1){ // title
        myData_drag_drop_target[objIndex].title = $('#target_title_'+idh).val();
    }else{ // file
        var file = $('#file_target_'+idh)[0].files[0]; var formData = new FormData();
        formData.append('file', file);
        $.ajax({
            url: baseUrl + '/drag_drop/upload_file?token='+localStorage.getItem('token')+'&type=vocab',
            type: 'POST', data: formData, contentType: false, processData: false,
            success: function(data) {
                var result = JSON.parse(data);
                if(result.success){
                    myData_drag_drop_target[objIndex].file = result.file;
                }else{
                    show_message("error", "Tải file không thành công");
                    return;
                }
            }
        });
    }
}

function change_data_answer(type, idh){
    var objIndex = myData_drag_drop_answer.findIndex(item => item.id == idh);
    if(type == 0){ // target_id
        myData_drag_drop_answer[objIndex].target_id = $('#target_combo_'+idh).val();
    }else if(type == 1){ // title
        myData_drag_drop_answer[objIndex].title = $('#answer_title_'+idh).val();
    }else{ // file
        var file = $('#file_answer_'+idh)[0].files[0]; var formData = new FormData();
        formData.append('file', file);
        $.ajax({
            url: baseUrl + '/drag_drop/upload_file?token='+localStorage.getItem('token')+'&type=vocab',
            type: 'POST', data: formData, contentType: false, processData: false,
            success: function(data) {
                var result = JSON.parse(data);
                if(result.success){
                    myData_drag_drop_answer[objIndex].file = result.file;
                }else{
                    show_message("error", "Tải file không thành công");
                    return;
                }
            }
        });
    }
    //console.log(myData_drag_drop_answer);
}

function remove_drag_drop_answer(idh){
    myData_drag_drop_answer = myData_drag_drop_answer.filter(item => item.id != idh);
    render_drag_drop_answer();
}

function remove_drag_drop_target(idh){
    myData_drag_drop_target = myData_drag_drop_target.filter(item => item.id != idh);
    render_drag_drop_target();
}