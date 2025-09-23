var count_answer = 0;
function add_target(){
    var index = Math.floor(Math.random() * 99999);
    $('#drag_drop_target').append(`
        <fieldset style="margin-top:10px;" id="fm_target_${index}">
            <legend style="font-weight:normal;font-size:14px;margin-bottom:5px;">
                Ô đích
                <a href="javascript:void(0)" onclick="remove_drag_drop_target(${index})">
                    <i class="ace-icon fa fa-trash"></i> 
                </a>
            </legend>
            <form id="target_${index}" method="post" enctype="multipart/form-data">
                <input type="text" class="form-control" name="target_title_${index}" id="target_title_${index}" value="" 
                placeholder="Nội dung" onchange="change_data(1, ${index}, 'target')" style="margin-bottom:7px;" required=""/>
                <input type="file" class="file_attach" name="file_target_${index}" id="file_target_${index}" style="width:100%;" 
                onchange="change_data(2, ${index}, 'target')"/>
            </form>
        </fieldset>
    `);
    setTimeout(() => {
        $('.file_attach').ace_file_input({
            no_file:'Không có file ...',btn_choose:'Lựa chọn',
            btn_change:'Thay đổi',droppable:false,
            onchange:null,thumbnail:true
        });
    }, 50);
}

function add_answer(){
    var index = Math.floor(Math.random() * 99999);
    $('#drag_drop_answer').append(`
        <div class="col-sm-6" id="item_${index}">
            <fieldset style="margin-top:10px;">
                <legend style="font-weight:normal;font-size:14px;margin-bottom:5px;">
                    Đáp án
                    <a href="javascript:void(0)" onclick="remove_drag_drop_answer(${index})">
                        <i class="ace-icon fa fa-trash"></i> 
                    </a>
                </legend>
                <form id="answer_${index}" method="post" enctype="multipart/form-data">
                    <select class="select2" data-placeholder="Lựa chọn đích..." style="width:100%;" required="" 
                    id="target_${index}" name="target_${index}" data-minimum-results-for-search="Infinity"
                    onchange="change_data_answer(0, ${index}, 'answer')">
                    </select>
                    <input type="text" class="form-control" name="answer_title_${index}" id="answer_title_${index}" value="" required=""
                    placeholder="Nội dung" onchange="change_data_answer(1, ${index}, 'answer')" style="margin-bottom:7px;margin-top:7px;"/>
                    <input type="file" class="file_attach" name="file_answer_${index}" id="file_answer_${index}" style="width:100%;" 
                    onchange="change_data_answer(2, ${index}, 'answer')"/>
                </form>
            </fieldset>
        </div>
    `);
    setTimeout(() => {
        $('.file_attach').ace_file_input({
            no_file:'Không có file ...',btn_choose:'Lựa chọn',
            btn_change:'Thay đổi',droppable:false,
            onchange:null,thumbnail:true
        });
        combo_select_2('#target_'+index, baseUrl + '/drag_drop/combo_target?token='+localStorage.getItem('token')+'&code_question='+$('#code').val(), 0, '');
    }, 50);
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function change_data(type, id_temp, prefix){
    var required = $('#'+prefix+'_'+id_temp+' input, #'+prefix+'_'+id_temp+' textarea, #'+prefix+'_'+id_temp+' select').filter('[required]:visible');
    var allRequired = true;
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }
    });
    if(allRequired){
        var lesson_id = getParameterByName('id'), code_question = $('#code').val();
        save_inline_form('#'+prefix+'_'+id_temp, baseUrl + '/drag_drop/add_target?token='+localStorage.getItem('token')+'&type='+type+'&id_temp='+id_temp+'&code_question='+code_question+'&lesson_id='+atob(lesson_id));
    }else{
        //show_message("error", "Chưa nhập đủ thông tin");
        return false;
    }
}

function change_data_answer(type, id_temp, prefix){
    //console.log($('#target_'+id_temp).val());
    var required = $('#answer_'+id_temp+' input, #answer_'+id_temp+' textarea, #answer_'+id_temp+' select').filter('[required]:visible');
    var allRequired = true;
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }
    });
    if(allRequired && $('#target_'+id_temp).val() != null){
        var lesson_id = getParameterByName('id'), code_question = $('#code').val();
        save_inline_form('#'+prefix+'_'+id_temp, baseUrl + '/drag_drop/add_answer?token='+localStorage.getItem('token')+'&type='+type+'&id_temp='+id_temp+'&code_question='+code_question+'&lesson_id='+atob(lesson_id));
    }else{
        //show_message("error", "Chưa nhập đủ thông tin");
        return false;
    }
}

function remove_drag_drop_answer(id_temp){
    $('#item_'+id_temp).remove();
}

function remove_drag_drop_target(id_temp){
    $('#fm_target_'+id_temp).remove();
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function getParameterByName(name, url = window.location.href) {
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}