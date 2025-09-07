var url;
$(function(){
    var gwdth_cate = $('#list_cate').width();
    $("#list_cate").jqGrid({
        url: "getTreeData.php",
        datatype: "json",
        colModel: [
            { name: "id", key: true, hidden: true },
            { name: "code", label: "Mã danh mục", width: 150, align: "center" },
            { name: "title", label: "Tiêu đề danh mục", width: 200},
            { name: "conent", label: "Mô tả danh mục", width: 300},
            { name: "status", label: "Trạng thái", width: 80, align: "center" },
            { name: "level", hidden: true },
            { name: "parent", hidden: true },
            { name: "isLeaf", hidden: true },
            { name: "expanded", hidden: true }
        ],
        treeGrid: true, treeGridModel: "adjacency", ExpandColumn: "name", ExpandAll: true,
        loadonce: true,height: 300, width: gwdth_cate, rowNum: 1000, viewrecords: false, rownumbers: true,
        height:($('.footer').offset().top - $('.page-header').offset().top - 147),
        pager: "#cate_pager", rowList:[10,20,30],
        jsonReader: {
            repeatitems: false,
            root: "rows"
        },
        loadComplete : function() {
            var table = this;
            setTimeout(function(){
                updatePagerIcons(table);
            }, 0);
        }
    });
});

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
    $('#code').val(number);
    url = baseUrl + '/test_cate/add?token='+localStorage.getItem('token');
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
