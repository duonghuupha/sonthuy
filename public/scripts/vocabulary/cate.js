var url_cate; var lastSelection; let id_edit = 0;
$(function(){
    $('#save_row').hide(); $('#del_row').show(); $('#cancel_row').hide(); $('#add_row').show();
    var gwdth_cate = $('#list_cate').width();
    $('#list_cate').jqGrid({
        url: baseUrl + '/vocab_cate/json?token='+localStorage.getItem('token'),
        datatype: "json",
        editurl: 'vocab_cate',
        mtype: "GET",
        colModel: [
            {label: 'Tiêu đề', name: 'title', width: 200, editable: true, edittype: 'text'},
            {label: 'Trạng thái', name: 'status', width: 70, align: 'center', formatter: format_trangthai},
            {label: '&nbsp', name: 'id', hidden: true}
        ],
        viewrecords: false, height:300, width: gwdth_cate, rowNum: 10, rownumbers: true,
        height:($('.footer').offset().top - $('#btn_cate').offset().top - 127),
        pager: "#cate_pager", rowList:[10,20,30], ondblClickRow: editRow,
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
        html += '<a href="javascript:void(0)" onclick="change_cate(0, '+rowObject.id+')">';
            html += '<img src="'+baseUrl+'/styles/assets/images/publish.png"/>';
        html += '</a>';
    }else{
        html += '<a href="javascript:void(0)" onclick="change_cate(1, '+rowObject.id+')">';
            html += '<img src="'+baseUrl+'/styles/assets/images/unpublish.png"/>';
        html += '</a>';
    }
    return html;
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function add_cate(){
    var parameters = {rowID: "new_row"};
    $('#save_row').show(); $('#del_row').hide(); $('#cancel_row').show(); $('#add_row').hide();
    $('#list_cate').jqGrid('addRow', parameters); $('#save_row').attr('onclick', 'save_cate(0, 0)');
    $('#cancel_row').attr('onclick', 'cancel_cate(0)');
}

function cancel_cate(type){
    if(type == 0){
        var rowId = $('#list_cate').jqGrid('getGridParam', 'selrow');
        $('#list_cate').jqGrid('delRowData', rowId);
        $('#save_row').hide(); $('#del_row').show(); $('#cancel_row').hide(); $('#add_row').show();
        lastSelection = null;
    }else{
        $('#save_row').hide(); $('#del_row').show(); $('#cancel_row').hide(); $('#add_row').show();
        $('#list_cate').trigger('reloadGrid'); lastSelection = null;
    }
}

function del_cate(){
    var rowId = $('#list_cate').jqGrid('getGridParam', 'selrow');
    if(rowId){
        data_str = "id="+rowId+"&token="+localStorage.getItem('token');
        del_data(data_str, "Bạn có chắc chắn muốn xóa bản ghi này?", baseUrl + '/vocab_cate/del', '#list_cate', baseUrl + '/vocab_cate/json?token='+localStorage.getItem('token'));
    }else{
        show_message("error", "Không có bản ghi nào được chọn");
    }
}


function save_cate(type, idh){
    if(type == 0 && idh == 0){
        var title = $('#new_row_title').val();
        post_url = baseUrl + '/vocab_cate/add?token='+localStorage.getItem('token')
    }else{
        var title = $('#'+idh+'_title').val();
        post_url = baseUrl + '/vocab_cate/update?token='+localStorage.getItem('token')+'&id='+idh;
    }
    if(title.length > 0){
        $('.overlay').show();
        $.ajax({
            type: "POST",
            url: post_url,
            data: "title="+title, // serializes the form's elements.
            success: function(data){
                var result = JSON.parse(data);
                if(result.success == true){
                    $('.overlay').hide();
                    show_message('success', result.msg); lastSelection = null;
                    $('#save_row').hide(); $('#del_row').show(); $('#cancel_row').hide(); $('#add_row').show();
                    $('#list_cate').trigger('reloadGrid');
                }else{
                    $('.overlay').hide();
                    show_message('error', result.msg);
                    return false;
                }
            }
        });
    }else{
        show_message("error", "Chưa nhập đủ thông tin");
    }
}

function change_cate(status, idh){
    data_str = "id="+idh+"&status="+status+"&token="+localStorage.getItem('token');
    del_data(data_str, "Bạn có chắc chắn muốn cập nhật trạng thái cho bản ghi này?", baseUrl + '/vocab_cate/change', '#list_cate', baseUrl + '/vocab_cate/json?token='+localStorage.getItem('token'));
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function editRow(id) {
    id_edit = id;
    if (id && id !== lastSelection) {
        var grid = $("#list_cate");
        grid.jqGrid('restoreRow',lastSelection);
        grid.jqGrid('editRow',id, {keys:true});
        lastSelection = id;
        $('#save_row').show(); $('#del_row').hide(); $('#cancel_row').show(); $('#add_row').hide();
        $('#save_row').attr('onclick', 'save_cate(1, '+id+')'); $('#cancel_row').attr('onclick', 'cancel_cate(1)');
    }
}