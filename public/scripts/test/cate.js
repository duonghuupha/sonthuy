var url;
$(function(){
    var gwdth_cate = $('#list_cate').width();
    $("#list_cate").jqGrid({
        url: baseUrl + '/test_cate/json?token='+localStorage.getItem('token'),
        datatype: "json",
        colModel: [
            {label: "Tiêu đề danh mục", name: "name", width: 150},
            {label: "Mô tả danh mục", name: "content", width: 300, cellattr: function(rowId, tv, rawObject, dm, rdata){
                return 'style="white-space:  normal;"';
            }},
            {label: "Mã danh mục", name: "code", width: 150, align: "center" },
            {label: "Trạng thái", name: "status", width: 80, align: "center", formatter: format_trangthai},
            {label: "level", name: "level", hidden: true },
            {label: "parent", name: "parent", hidden: true },
            {label: "isLeaf", name: "isLeaf", hidden: true },
            {label: "expanded", name: "expanded", hidden: true },
            {label: "id", name: "id", key: true, hidden: true },
            {label: "Danh mục cha", name: "parent_title", hidden: true}
        ],
        treeGrid: true, treeGridModel: "adjacency", ExpandColumn: "name", ExpandColClick: true,
        height: "auto", rowNum: 1000, loadonce: true, rownumbers: false, width: gwdth_cate,
        height:($('.footer').offset().top - $('.page-header').offset().top - 147),
        pager: "#cate_pager", rowList:[10,20,30],
        loadComplete : function() {
            var table = this;
            setTimeout(function(){
                updatePagerIcons_tree_grid(table);
                console.log(table);
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

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function refresh_code(){
    if($('#code').val().length == 0){
        show_message("error", "Mã danh Mục chưa được tạo, hoặc đã trùng trong hệ thống");
    }else{
        var number = Math.floor(Math.random() * 999999999);
        $('#code').val(number);
    }
}

function add(){
    reset_form('#fm');
    var number = Math.floor(Math.random() * 999999999);
    $('#code').val(number); combo_select_2('#parent_id', baseUrl+'/other/combo_test_cate', 0, '');
    url = baseUrl + '/test_cate/add?token='+localStorage.getItem('token');
}

function update(){
    reset_form('#fm');
    var rowKey = $('#list_cate').jqGrid('getGridParam',"selrow");
    if(rowKey == null){
        show_message("error", "Vui lòng chọn bản ghi cần cập nhật");
        return false;
    }else{
        var row = $('#list_cate').jqGrid("getRowData", rowKey);
        $('#code').val(row.code); $('#title').val(row.title); $('#content').val(row.content);
        combo_select_2('#parent_id', baseUrl+'/other/combo_test_cate', row.parent, row.parent_title);
        url = baseUrl + '/test_cate/update?token=' + localStorage.getItem('token') + '&id=' + row.id;
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
        save_reject('#fm', url, baseUrl+'/test_cate?token='+localStorage.getItem('token')); 
    }else{
        show_message("error", "Chưa điền đủ thông tin");
    }
}
