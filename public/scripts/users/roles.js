var url = baseUrl + '/roles/add?token='+localStorage.getItem('token');
$(function(){
    var gwdth = $('#list_roles').width(), fwdth = $('.full').width();
    $('#list_roles').jqGrid({
        url: baseUrl + '/roles/json?token='+localStorage.getItem('token'),
        datatype: "json",
        mtype: "GET",
        colModel: [
            {label: 'Danh mục cha', name: 'parent', width: 150, formatter: format_parent},
            {label: 'Tiêu đề', name: 'title', width: 250},
            {label: 'Controller', name: 'link', width: 150},
            {label: 'Action', name: 'chuc_nang', width: 250,cellattr: function(rowId, tv, rawObject, dm, rdata){
                return 'style="white-space:  normal;"';
            }},
            {label: 'Thứ tự', name: 'order_position', width: 150, align: "center"},
            {label: 'Icon', name: 'icon_display', width: 150, align: "center", formatter: format_icon},
            {label: 'Trạng thái', name: 'status', width: 80, align: "center", formatter: format_trangthai},
            {label: '&nbsp', name: 'id', width: 70, align: "center", formatter: format_button_roles},
            {label: 'parent_id', name: 'parent_id', hidden:true},
            {label: 'icon', name: 'icon', hidden:true},
            {label: 'function', name: 'functions', hidden:true},
            {label: 'id', name: 'id', hidden:true}
        ],
        viewrecords: true, height:200, width: gwdth, rowNum: 20, rownumbers: true,
        height:($('.footer').offset().top - $('.page-header').offset().top - 147),
        pager: "#roles_pager", rowList:[10,20,30],
        loadComplete : function() {
            var table = this;
            setTimeout(function(){
                updatePagerIcons(table);
            }, 0);
        }
    });
    combo_select_2('#parent_id', baseUrl + '/other/combo_roles_parent', 0, '');
    combo_select_2('#link', baseUrl + '/other/combo_role_link', 0, '');
});

function format_button_roles(cellvalue, options, rowObject){
    //console.log(rowObject.code);
    var html = '';
    html += '<div class="hidden-sm hidden-xs action-buttons">';
        html += '<a class="green" href="javascript:void(0)" onclick="edit('+cellvalue+')" title="Chỉnh sửa">';
            html += '<i class="ace-icon fa fa-pencil bigger-130"></i>';
        html += '</a>';
        html += '<a class="red" href="javascript:void(0)" onclick="del('+cellvalue+')" title="Xóa dữ liệu">';
            html += '<i class="ace-icon fa fa-trash-o bigger-130"></i>';
        html += '</a>';
    html += '</div>';
    return html;
}

function format_icon(cellvalue, options, rowObject){
    return '<i class="ace-icon fa fa-'+cellvalue+' bigger-130"></i>';
}

function format_parent(cellvalue, options, rowObject){
    if(rowObject.parent_id == 0){
        return '<b><i>'+cellvalue+'</i></b>';
    }else{
        return cellvalue;
    }
}

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

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function edit(idh){
    var grid = $('#list_roles');
    jQuery('#list_roles').jqGrid("setSelection", idh);
    var row = grid.jqGrid("getRowData", idh);
    if(row){
        url = baseUrl + '/roles/update?token='+localStorage.getItem('token')+'&id='+idh;
        combo_select_2('#parent_id', baseUrl + '/other/combo_roles_parent', row.parent_id, row.parent);
        combo_select_2('#link', baseUrl + '/other/combo_role_link', row.link, row.link);
        if(row.functions.length > 0){
            $('#functions').val(row.functions.split(",")).trigger('change');
        }
        $('#title').val(row.title); $('#order').val(row.order_position); $('#icon').val(row.icon);
    }else{
        show_message("error", "Không có bản ghi nào được chọn");
    }
}

function del(idh){
    var data_str = "id="+idh+"&token="+localStorage.getItem('token');
    del_data(data_str, "Bạn có chắc chắn muốn xóa bản ghi này?", baseUrl + '/roles/del', '#list_roles', baseUrl + '/roles/json?token='+localStorage.getItem('token'));
}

function change(status, idh){
    var data_str = "token="+localStorage.getItem('token')+"&id="+idh+"&status="+status;
    del_data(data_str, "Bạn có chắc chắn muốn thay đổi trạng thái bản ghi này?", baseUrl + '/roles/change', '#list_roles', baseUrl + '/roles/json?token='+localStorage.getItem('token'));
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
        save_reject('#fm', url, baseUrl + '/roles?token='+localStorage.getItem('token'));
    }else{
        show_message("error", "Chưa điền đủ thông tin");
    }
}

function view_page_role(pages){
    page = pages;
    $('#list_roles').load(baseUrl + '/roles/content?page='+page+'&q='+keyword);
}

function search(){
    
}