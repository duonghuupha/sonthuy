var url = baseUrl + '/class_room/add?token='+localStorage.getItem('token');
$(function(){
    var gwdth = $('#list_teacher').width(), fwdth = $('.haft').width();
    $('#list_class').jqGrid({
        url: baseUrl + '/class_room/json?token='+localStorage.getItem('token'),
        datatype: "json",
        mtype: "GET",
        colModel: [
            {label: 'Mã lớp học', name: 'code', width: 120, align:"center"},
            {label: 'Tên lớp học', name: 'fullname', width: 200},
            {label: 'Ngày bắt đầu', name: 'birthday', width: 150, align:"center"},
            {label: 'Ngày kết thúc', name: 'phone', width: 150, align:"center"},
            {label: 'Thời gian dự kiến', name: 'phone', width: 150, align:"center"},
            {label: 'Mô tả lớp học', name: 'level', width: 350},
            {label: 'Trạng thái', name: 'status', width: 100, align: "center", formatter: format_trangthai},
            {label: '&nbsp', name: 'id', hidden: true, key: true}
        ],
        viewrecords: true, height:200, width: fwdth, rowNum: 20, rownumbers: true,
        height:($('.footer').offset().top - $('.page-header').offset().top - 147),
        pager: "#class_pager", rowList:[10,20,30],
        loadComplete : function() {
            var table = this;
            setTimeout(function(){
                updatePagerIcons(table);
            }, 0);
        }
    });
});

function format_trangthai(cellvalue, options, rowObject){
    var html = '';
    if(cellvalue == 1){
        html += '<a href="javascript:void(0)" onclick="change(0, '+rowObject.id+')">';
            html += '<img src="'+baseUrl+'/styles/assets/images/publish.png"/>';
        html += '</a>';
    }else{
        html += '<a href="javascript:void(0)" onclick="change(1, '+rowObject.id+')">';
            html += '<img src="'+baseUrl+'/styles/assets/images/unpublish.png"/>';
        html += '</a>';
    }
    return html;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function add(){

}

function update(){

}

function del(){

}

function change(){

}

function save(){
    var required = $('#fm input, #fm textarea, #fm select').filter('[required]:visible');
    var allRequired = true;
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }
    });
    if(allRequired){
        save_form_reset_form('#fm', url, '#list_teacher', baseUrl+'/teacher/json?token='+localStorage.getItem('token'));
    }else{
        show_message("error", "Chưa điền đủ thông tin");
    }
}