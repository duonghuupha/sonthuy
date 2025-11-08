function import_file(){
    $('#modal-student-import').modal('show');
    combo_select_2('#class_id_imp', baseUrl + '/other/combo_class', 0, '');
    setTimeout(() => {
        render_imported_students();
    }, 200);
}

function render_imported_students(){
    var gwdth_imp = $('#list_student_imp').width(); console.log(gwdth_imp);
    $('#list_student_imp').jqGrid({
        url: '',
        datatype: "json",
        mtype: "GET",
        colModel: [
            {label: 'Mã học sinh', name: 'code', width: 120, align:"center"},
            {label: 'Họ và tên', name: 'fullname', width: 200},
            {label: 'Giới tính', name: 'gender', width: 100, align:"center", formatter: format_gender},
            {label: 'Lớp học', name: 'class_title', width: 100},
            {label: '&nbsp', name: 'id', hidden: true, key: true},
            {label: '&nbsp', name: 'gender', hidden: true},
            {label: '&nbsp', name: 'class_id', hidden: true}
        ],
        viewrecords: false, height:400, width: gwdth_imp, rowNum: 20, rownumbers: true,
        pager: "#student_imp_pager", rowList:[10,20,30],
        loadComplete : function() {
            var table = this;
            setTimeout(function(){
                updatePagerIcons(table);
            }, 0);
        }
    });
}

function format_gender(cellvalue, options, rowObject){
    if(cellvalue == 1){
        return 'Nam';
    }else if(cellvalue == 2){
        return 'Nữ';
    }else{
        return 'Khác';
    }
}

function update_import(){
    var xhr = new XMLHttpRequest();
    var formData = new FormData($('#fm-import')[0]);
    $('.overlay').show();
    $.ajax({
        url: baseUrl + '/students/import?token='+localStorage.getItem('token'),  //server script to process data
        type: 'POST',
        xhr: function() {
            return xhr;
        },
        data: formData,
        success: function(data){
            var result = JSON.parse(data);
            if(result.success == true){
                $('.overlay').hide();
                show_message('success', result.msg); $('.file_attach').ace_file_input('reset_input');
                $('#list_student_imp').trigger('reloadGrid');
            }else{
                $('.overlay').hide();
                show_message('error', result.msg);
                return false;
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
}