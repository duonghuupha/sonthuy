$(function(){
    $('#block_one').load(baseUrl + '/dashboard/block_one?token='+localStorage.getItem('token'));
    $('#block_two').load(baseUrl + '/dashboard/block_two?token='+localStorage.getItem('token')+'&id=1');
    $('#block_three').load(baseUrl + '/dashboard/block_three?token='+localStorage.getItem('token')+'&id=1');
    $('#block_four').load(baseUrl + '/dashboard/block_four?token='+localStorage.getItem('token')+'&id=1');
    //////////////////// Block six/////////////////////////////////////////////////////////////////////////////
    var gwdth = $('#block_six').width();
    $('#block_six').jqGrid({
        url: baseUrl + '/dashboard/block_six?token='+localStorage.getItem('token'),
        datatype: "json",
        mtype: "GET",
        colModel: [
            {label: 'Mã hồ sơ', name: 'code', width: 100, align: "center"},
            {label: 'Danh mục', name: 'work_cate', width: 150, align: "center"},
            {label: 'Tên hồ sơ', name: 'title', width: 300, align: "left"},
        ],
        viewrecords: true, height:200, width: gwdth, rowNum: 10, rownumbers: true,
        pager: "#block_six_pager", rowList:[10]
    });
});

function reload_block_two(idh){
    $('#block_two').load(baseUrl + '/dashboard/block_two?token='+localStorage.getItem('token')+'&id='+idh);
}

function reload_block_three(idh){
    $('#block_three').load(baseUrl + '/dashboard/block_three?token='+localStorage.getItem('token')+'&id='+idh);
}