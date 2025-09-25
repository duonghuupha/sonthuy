var url;
$(function(){
    var gwdth = $('#list_vocab').width(), fwdth = $('.full').width();
    $('#list_vocab').jqGrid({
        url: baseUrl + '/vocab/json?token='+localStorage.getItem('token'),
        datatype: "json",
        mtype: "GET",
        colModel: [
            {label: 'Mã nhân sự', name: 'code', width: 120, align:"center"},
            {label: 'Họ và tên', name: 'fullname', width: 200},
            {label: 'Ngày sinh', name: 'birthday', width: 150, align:"center"},
            {label: 'Điện thoại', name: 'phone', width: 150, align:"center"},
            {label: 'Trình độ', name: 'level', width: 150, align:"center"},
            {label: 'Email', name: 'email', width: 200,},
            {label: 'Địa chỉ', name: 'address', width: 350,},
            {label: '&nbsp', name: 'id', hidden: true, key: true},
            {label: '&nbsp', name: 'gender', hidden: true},
            {label: '&nbsp', name: 'image', hidden: true}
        ],
        viewrecords: true, height:200, width: gwdth, rowNum: 20, rownumbers: true,
        height:($('.footer').offset().top - $('#danh_sach_cau_hoi').offset().top - 147),
        pager: "#vocab_pager", rowList:[10,20,30],
        loadComplete : function() {
            var table = this;
            setTimeout(function(){
                updatePagerIcons(table);
            }, 0);
        }
    });
});

function add_question(){
    reset_form('#fm');
    var rowKey = $('#list_cate').jqGrid('getGridParam',"selrow");
    if(rowKey == null){
        show_message("error", "Vui lòng chọn danh mục từ vựng");
        return false;
    }else{
        $('#cate_id').val(rowKey);
        $('#modal-form').modal('show');
    }
}

function edit(){

}

function del(){

}

function change(){

}

function save(){

}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
