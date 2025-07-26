var url = '';
$(function(){
    var gwdth = $('#list_teacher').width(), fwdth = $('.haft').width();
    $('#list_class').jqGrid({
        url: baseUrl + '/class_room/json?token='+localStorage.getItem('token'),
        datatype: "json",
        mtype: "GET",
        colModel: [
            {label: 'Mã lớp học', name: 'code', width: 120, align:"center"},
            {label: 'Tên lớp học', name: 'title', width: 200, align: "center"},
            {label: 'Ngày bắt đầu', name: 'bat_dau', width: 150, align:"center"},
            {label: 'Thời gian dự kiến', name: 'phone', width: 150, align:"center", formatter: format_time_out},
            {label: 'Ngày kết thúc', name: 'ket_thuc', width: 150, align:"center"},
            {label: 'Mô tả lớp học', name: 'content', width: 350},
            {label: 'Trạng thái', name: 'status', width: 100, align: "center", formatter: format_trangthai},
            {label: '&nbsp', name: 'id', hidden: true, key: true},
            {label: '&nbsp', name: 'date_start', hidden: true},
            {label: '&nbsp', name: 'date_end', hidden: true}
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
    $('.input-mask-date').mask('99-99-9999');
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

function format_time_out(cellvalue, options, rowObject){
    var week = weeksBetween(rowObject.date_start, rowObject.date_end);
    return Math.round(week)+' tuần';
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function refresh_code(){
    if($('#code').val().length == 0){
        show_message("error", "Mã lớp học chưa được tạo, hoặc đã trùng trong hệ thống");
    }else{
        var number = Math.floor(Math.random() * 999999999);
        $('#code').val(number);
    }
}

function add(){
    reset_form('#fm');
    var number = Math.floor(Math.random() * 999999999);
    $('#code').val(number);
    url = baseUrl + '/class_room/add?token='+localStorage.getItem('token');
}

function update(){
    reset_form('#fm');
    var rowKey = $('#list_class').jqGrid('getGridParam',"selrow");
    if(rowKey == null){
        show_message("error", "Vui lòng chọn lớp học cần cập nhật");
        return false;
    }else{
        var row = $('#list_class').jqGrid("getRowData", rowKey);
        $('#code').val(row.code); $('#title').val(row.title); $('#date_start').val(row.bat_dau);
        $('#date_end').val(row.ket_thuc); $('#content').val(row.content);
        $('#modal-teacher').modal('show');
        url = baseUrl + '/class_room/update?token=' + localStorage.getItem('token') + '&id=' + row.id;
    }
}

function del(){
    var rowKey = $('#list_class').jqGrid('getGridParam',"selrow");
    if(rowKey == null){
        show_message("error", "Vui lòng chọn nhân sự cần xóa");
        return false;
    }else{
        var row = $('#list_class').jqGrid("getRowData", rowKey);
        var str_data = "token=" + localStorage.getItem('token') + "&id=" + row.id;
        del_data(str_data, "Bạn có chắc chắn muốn xóa nhân sự này không?", baseUrl + '/class_room/del', '#list_class', baseUrl + '/class_room/json?token=' + localStorage.getItem('token'));
    }
}

function change(status, id){
    var str_data = "token=" + localStorage.getItem('token') + "&id=" + id + "&status=" + status;
    del_data(str_data, "Bạn có chắc chắn muốn thay đổi trạng thái lớp học này không?", baseUrl + '/class_room/change', '#list_class', baseUrl + '/class_room/json?token=' + localStorage.getItem('token'));
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
        save_form_reset_form('#fm', url, '#list_class', baseUrl+'/class_room/json?token='+localStorage.getItem('token'));
    }else{
        show_message("error", "Chưa điền đủ thông tin");
    }
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function canel_form(){
    reset_form('#fm');
}

function set_date_end(val){
    var val_date = val.split('-');
    var date = new Date(val_date[2], val_date[1] - 1, val_date[0]);
    let daysToAdd = 50 * 7;
    date.setDate(date.getDate() + daysToAdd);
    let resultDate = date.toISOString().split('T')[0];
    $('#date_end').val(resultDate.split('-').reverse().join('-'));
}

function weeksBetween(date1, date2) {
    // Chuyển cả hai về đối tượng Date
    let d1 = new Date(date1);
    let d2 = new Date(date2);

    // Tính chênh lệch thời gian (mili-giây)
    let diffInMs = Math.abs(d2 - d1);

    // Một tuần = 7 ngày * 24 giờ * 60 phút * 60 giây * 1000 mili-giây
    let msPerWeek = 7 * 24 * 60 * 60 * 1000;

    // Trả về số tuần (có thể là số lẻ)
    return diffInMs / msPerWeek;
}