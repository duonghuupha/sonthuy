var url;
$(function(){
    var gwdth = $('#list_lesson').width(), fwdth = $('.full').width();
    $('#list_lesson').jqGrid({
        url: baseUrl + '/lesson/json?token='+localStorage.getItem('token'),
        datatype: "json",
        mtype: "GET",
        colModel: [
            {label: 'Mã bài giảng', name: 'code', width: 120, align:"center"},
            {label: 'Danh mục', name: 'cate_title', width: 120, align:"center"},
            {label: 'Tên bài giảng', name: 'title', width: 200},
            {label: 'Mô tả', name: 'content', width: 300},
            {label: 'Trạng thái', name: 'status', width: 100, align: "center", formatter: format_trangthai},
            {label: 'Cập nhật lần cuối', name: 'create_at', width: 150, align:"center"},
            {label: '&nbsp', name: 'id', hidden: true, key: true},
            {label: '&nbsp', name: 'cate_id', hidden: true}
        ],
        viewrecords: true, height:200, width: gwdth, rowNum: 20, rownumbers: true,
        height:($('.footer').offset().top - $('.page-header').offset().top - 147),
        pager: "#lesson_pager", rowList:[10,20,30],
        loadComplete : function() {
            var table = this;
            setTimeout(function(){
                updatePagerIcons(table);
            }, 0);
        },
        ondblClickRow: function(rowId){
            window.location.href = baseUrl + '/lesson/detail?token='+localStorage.getItem('token')+'&id='+btoa(rowId);
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
//////////////////////////////////////////////////////////////////////////////////////////////////
function refresh_code(){
    var number = Math.floor(Math.random() * 999999999);
    $('#code').val(number);
}

function add(){
    reset_form('#fm');
    var number = Math.floor(Math.random() * 999999999); $('#refreshcode').show();
    $('#code').val(number); render_tree_lesson_cate();
    $('#modal-lesson').modal('show');
    url = baseUrl + '/lesson/add?token='+localStorage.getItem('token');
    /****************************************************************************** */
    $('#lesson_cate_tree').on('changed.jstree', function (e, data) {
        $('#cate_id').val(data.node.id);
    });
}

function update(){
     reset_form('#fm');
    var rowKey = $('#list_lesson').jqGrid('getGridParam',"selrow");
    if(rowKey == null){
        show_message("error", "Vui lòng chọn lớp học cần cập nhật");
        return false;
    }else{
        var row = $('#list_lesson').jqGrid("getRowData", rowKey);
        $('#code').val(row.code); $('#title').val(row.title); $('#content').val(row.content)
        $('#modal-lesson').modal('show'); render_tree_lesson_cate(); $('#cate_id').val(row.cate_id);
        url = baseUrl + '/lesson/update?token='+localStorage.getItem('token')+"&id="+row.id;
        /****************************************************************************** */
        $('#lesson_cate_tree').on('ready.jstree', function(){
            $('#lesson_cate_tree').jstree('select_node', row.cate_id);
        });
        $('#lesson_cate_tree').on('changed.jstree', function (e, data) {
            $('#cate_id').val(data.node.id);
        });
    }
}

function change(status, id){
    var str_data = "token=" + localStorage.getItem('token') + "&id=" + id + "&status=" + status;
    del_data(str_data, "Bạn có chắc chắn muốn thay đổi trạng thái bài giảng này?", baseUrl + '/lesson/change', '#list_lesson', baseUrl + '/lesson/json?token=' + localStorage.getItem('token'));
}

function del(){
    var rowKey = $('#list_lesson').jqGrid('getGridParam',"selrow");
    if(rowKey == null){
        show_message("error", "Vui lòng chọn nhân sự cần xóa");
        return false;
    }else{
        var row = $('#list_lesson').jqGrid("getRowData", rowKey);
        var str_data = "token=" + localStorage.getItem('token') + "&id=" + row.id;
        del_data(str_data, "Bạn có chắc chắn muốn xóa bài giảng này không?", baseUrl + '/lesson/del', '#list_lesson', baseUrl + '/lesson/json?token=' + localStorage.getItem('token'));
    }
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
        save_form_modal('#fm', url, '#modal-lesson', '#list_lesson',  baseUrl+'/lesson/json?token='+localStorage.getItem('token')); 
    }else{
        show_message("error", "Chưa điền đủ thông tin");
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////////
function render_tree_lesson_cate(){
    $.ajax({
        url: baseUrl + '/lesson/json_lesson_cate?token=' + localStorage.getItem('token'),
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#lesson_cate_tree').jstree({
                'core': {
                    'data': data
                }
            })
            .bind("loaded.jstree", function(event, data){
                $(this).jstree("open_all");
            });
        },
        error: function(xhr, status, error) {
            alert("Lỗi tải dữ liệu: " + error);
        }
    });
}