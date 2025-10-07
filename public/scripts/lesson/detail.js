var myData_lesson_dc = [], myData_lesson_media = [], myData_lesson_card = [];
$(function(){
    var id_glgobal = getParameterByName('id'); render_view_lesson(atob(id_glgobal));
    $('#accordion').on('show.bs.collapse', function(e){
        var str_value = e.target.id;
        if(str_value == 'collapseTwo'){
            setTimeout(() => {
                render_list_lesson_dc(atob(id_glgobal));
            }, 50);
        }else if(str_value == 'collapseThree'){
            setTimeout(() => {
                render_list_lesson_media(atob(id_glgobal));
            }, 50);
        }else if(str_value == 'collapseFour'){
            setTimeout(() => {
                render_list_lesson_card(atob(id_glgobal));
            }, 50);
        }
    });
});
//////////////////////////////////////////////////Lesson document///////////////////////////////////////////////////////////////////////////////////////////////////////
function render_list_lesson_dc(idh){
    var gwdth = $('#list_lesson_dc').width(), fwdth = $('.full').width();
    $('#list_lesson_dc').jqGrid({
        url: baseUrl + '/lesson_dc/json?token='+localStorage.getItem('token')+'&id='+idh,
        datatype: "json",
        mtype: "GET",
        colModel: [
            {label: 'Tên file', name: 'image', width: 220, align:"left", formatter: format_link_dc},
            {label: 'Thứ tự', name: 'order_dc', width: 50, align:"center"},
            {label: '#', name: 'action', width: 50, align:"center", formatter: format_button_dc},
            {label: '&nbsp', name: 'id', hidden: true, key: true},
            {label: '&nbsp', name: 'lesson_id', hidden: true}
        ],
        viewrecords: false, height:150, width: gwdth, rowNum: 20, rownumbers: true,
        pager: "#lesson_dc_pager", rowList:[10,20,30],
        loadComplete : function() {
            var table = this;
            setTimeout(function(){
                updatePagerIcons(table);
            }, 0);
        }
    });
}

function format_button_dc(cellvalue, options, rowObject){
    var html = '';
    html += '<a href="javascript:void(0)" onclick="del_lesson_dc('+rowObject.id+', '+rowObject.lesson_id+')">'; 
        html += '<i class="ace-icon fa fa-trash" style="color:red"></i>';
    html += '</a>';
    return html;
}

function format_link_dc(cellvalue, options, rowObject){
    var html = '';
    html += '<a href="javascript:void(0)" onclick="view_image_dc('+rowObject.id+', '+rowObject.lesson_id+', \''+cellvalue+'\', '+rowObject.order_dc+')">'+cellvalue+'</a>';
    return html;
}

//////////////////////////////////////////////////////////////////Lesson Media////////////////////////////////////////////////////////////////////////////////////////////////////
function render_list_lesson_media(idh){
    var gwdth_media = $('#list_lesson_media').width(), fwdth = $('.full').width();
    $('#list_lesson_media').jqGrid({
        url: baseUrl + '/lesson_media/json?token='+localStorage.getItem('token')+'&id='+idh,
        datatype: "json",
        mtype: "GET",
        colModel: [
            {label: 'Tên file', name: 'file', width: 220, align:"left", formatter: format_link_media},
            {label: 'Thứ tự', name: 'order_media', width: 50, align:"center"},
            {label: '#', name: 'action', width: 50, align:"center", formatter: format_button_media},
            {label: '&nbsp', name: 'id', hidden: true, key: true},
            {label: '&nbsp', name: 'lesson_id', hidden: true}
        ],
        viewrecords: false, height:150, width: gwdth_media, rowNum: 20, rownumbers: true,
        pager: "#lesson_media_pager", rowList:[10,20,30],
        loadComplete : function() {
            var table = this;
            setTimeout(function(){
                updatePagerIcons(table);
            }, 0);
        }
    });
}

function format_button_media(cellvalue, options, rowObject){
    var html = '';
    html += '<a href="javascript:void(0)" onclick="del_lesson_media('+rowObject.id+', '+rowObject.lesson_id+')">'; 
        html += '<i class="ace-icon fa fa-trash" style="color:red"></i>';
    html += '</a>';
    return html;
}

function format_link_media(cellvalue, options, rowObject){
    var html = '';
    html += '<a href="javascript:void(0)" onclick="view_lesson_media('+rowObject.id+', '+rowObject.lesson_id+', \''+cellvalue+'\', '+rowObject.order_media+')">'+cellvalue+'</a>';
    return html;
}
////////////////////////////////////////////////////////Lesson flash card//////////////////////////////////////////////////////////////////////////////////////////////
function render_list_lesson_card(idh){
    var gwdth_media = $('#list_lesson_card').width(), fwdth = $('.full').width();
    $('#list_lesson_card').jqGrid({
        url: baseUrl + '/lesson_card/json?token='+localStorage.getItem('token')+'&id='+idh,
        datatype: "json",
        mtype: "GET",
        colModel: [
            {label: 'Tên file', name: 'image', width: 220, align:"left", formatter: format_link_card},
            {label: 'Thứ tự', name: 'order_card', width: 50, align:"center"},
            {label: '#', name: 'action', width: 50, align:"center", formatter: format_button_card},
            {label: '&nbsp', name: 'id', hidden: true, key: true},
            {label: '&nbsp', name: 'lesson_id', hidden: true}
        ],
        viewrecords: false, height:150, width: gwdth_media, rowNum: 20, rownumbers: true,
        pager: "#lesson_card_pager", rowList:[10,20,30],
        loadComplete : function() {
            var table = this;
            setTimeout(function(){
                updatePagerIcons(table);
            }, 0);
        }
    });
}

function format_button_card(cellvalue, options, rowObject){
    var html = '';
    html += '<a href="javascript:void(0)" onclick="del_lesson_card('+rowObject.id+', '+rowObject.lesson_id+')">'; 
        html += '<i class="ace-icon fa fa-trash" style="color:red"></i>';
    html += '</a>';
    return html;
}

function format_link_card(cellvalue, options, rowObject){
    var html = '';
    html += '<a href="javascript:void(0)" onclick="view_image_card('+rowObject.id+', '+rowObject.lesson_id+', \''+cellvalue+'\', '+rowObject.order_card+')">'+cellvalue+'</a>';
    return html;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function getRemote(remote_url){
    return $.ajax({
        type: 'GET',
        url: remote_url,
        async: false
    }).responseText;
}

function getParameterByName(name, url = window.location.href) {
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function render_view_lesson(lesson_id){
    var height_view = $('.footer').offset().top - $('.page-header').offset().top - 147;
    $('#view_lesson').load(baseUrl + '/lesson/view_lesson?token='+localStorage.getItem('token')+'&id='+btoa(lesson_id));
    setTimeout(() => {
        var fotoramaApi = $('.fotorama').data('fotorama'); fotoramaApi.setOptions({height: height_view});
    }, 200);
}