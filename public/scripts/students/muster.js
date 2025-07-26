var url = '';
const monthYearDisplay = document.getElementById("month-year");
const calendarBody = document.getElementById("calendar-body");
const eventInfo = document.getElementById("event-info");

const today = new Date();
let currentMonth = today.getMonth();
let currentYear = today.getFullYear();

const monthNames = [
    "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4",
    "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8",
    "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"
];
$(function(){
    combo_select_2('#class_id', baseUrl + '/other/combo_class', 0, '');
    $('#class_id').on('select2:select', function (e) {
        //console.log(e.params.data.id);
        set_list_student(e.params.data.id);
    });
    var gwdth = $('#list_student').width(), fwdth = $('.full').width();
    $('#list_student').jqGrid({
        url: baseUrl + '/muster/json_student?token='+localStorage.getItem('token'),
        datatype: "json",
        mtype: "GET",
        colModel: [
            {label: 'Mã học sinh', name: 'code', width: 120, align:"center"},
            {label: 'Họ và tên', name: 'fullname', width: 200},
            {label: 'Giới tính', name: 'gender', width: 100, align:"center", formatter: format_gender},
            {label: 'Ngày sinh', name: 'birthday', width: 150, align:"center"},
            {label: 'Lớp học', name: 'class_title', width: 100},
            {label: '&nbsp', name: 'id', hidden: true, key: true},
        ],
        viewrecords: true, height:200, width: gwdth, rowNum: 100, rownumbers: true,
        height:($('.footer').offset().top - $('#form_search_muster').offset().top - 173),
        pager: "#student_pager", rowList:[10,20,30],
        loadComplete : function() {
            var table = this;
            setTimeout(function(){
                updatePagerIcons(table);
            }, 0);
        },
        ondblClickRow: function(rowId){
            add_muster(rowId, $('#class_id').val());
        }
    });
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    var gwdth_muster = $('#list_student_muster').width(), fwdth = $('.full').width();
    $('#list_student_muster').jqGrid({
        url: baseUrl + '/muster/json_student_muster?token='+localStorage.getItem('token'),
        datatype: "json",
        mtype: "GET",
        colModel: [
            {label: 'Mã học sinh', name: 'code', width: 120, align:"center"},
            {label: 'Họ và tên', name: 'fullname', width: 200},
            {label: 'Giới tính', name: 'gender', width: 100, align:"center", formatter: format_gender},
            {label: 'Ngày sinh', name: 'birthday', width: 150, align:"center"},
            {label: 'Lớp học', name: 'class_title', width: 100},
            {label: '&nbsp', name: 'id', hidden: true, key: true},
        ],
        viewrecords: true, height:200, width: gwdth_muster, rowNum: 100, rownumbers: true,
        height:($('.footer').offset().top - $('#form_search_muster').offset().top - 173),
        pager: "#student_muster_pager", rowList:[10,20,30],
        loadComplete : function() {
            var table = this;
            setTimeout(function(){
                updatePagerIcons(table);
            }, 0);
        },
        ondblClickRow: function(rowId){
            del_muster(rowId, $('#class_id').val());
        }
    });
});

function format_gender(cellvalue, options, rowObject){
    if(cellvalue == 1){
        return 'Nam';
    }else if(cellvalue == 2){
        return 'Nữ';
    }else{
        return 'Khác';
    }
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////
function set_list_student(){
    var val = $('#class_id').val();
    $('#list_student').jqGrid('setGridParam',{postData: {"class_id": val}}).trigger('reloadGrid');
    $('#list_student_muster').jqGrid('setGridParam',{postData: {"class_id": val}}).trigger('reloadGrid');
}

function add_muster(idh, class_idh){
    if(class_idh == '' || class_idh == null){
        show_message('error', 'Vui lòng chọn lớp học để điểm danh');
    }else{
        $('.overlay').show();
        $.ajax({
            type: "POST",
            url: baseUrl + '/muster/add?token='+localStorage.getItem('token'),
            data: "student_id="+idh+'&class_id='+class_idh, // serializes the form's elements.
            success: function(data){
                var result = JSON.parse(data);
                if(result.success == true){
                    $('.overlay').hide();
                    show_message('success', result.msg);
                    $('#list_student_muster').trigger('reloadGrid');$('#list_student').trigger('reloadGrid');
                }else{
                    $('.overlay').hide();
                    show_message('error', result.msg);
                    return false;
                }
            }
        });
    }
}

function del_muster(idh, class_idh){
    if(class_idh == '' || class_idh == null){
        show_message('error', 'Vui lòng chọn lớp học để điểm danh');
    }else{
        $('.overlay').show();
        $.ajax({
            type: "POST",
            url: baseUrl + '/muster/del?token='+localStorage.getItem('token'),
            data: "student_id="+idh+'&class_id='+class_idh, // serializes the form's elements.
            success: function(data){
                var result = JSON.parse(data);
                if(result.success == true){
                    $('.overlay').hide();
                    show_message('success', result.msg);
                    $('#list_student_muster').trigger('reloadGrid');$('#list_student').trigger('reloadGrid');
                }else{
                    $('.overlay').hide();
                    show_message('error', result.msg);
                    return false;
                }
            }
        });
    }
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function manager_muster(){
    render_calendar();
    $('#modal-muster').modal('show'); combo_select_2('#class_id_total', baseUrl + '/other/combo_class', 0, '');
    setTimeout(() => {
        var height_muster = $('#modal-muster').height();
        render_list_muster(height_muster); 
        $('#class_id_total').on('select2:select', function (e) {
            reload_grid_muster(e.params.data.id);
        });
    }, 200);
}

function render_list_muster(height_muster){
    var gwdth_muster = $('#list_muster_total').width();
    $('#list_muster_total').jqGrid({
        url: baseUrl + '/muster/json_muster_total?token='+localStorage.getItem('token'),
        datatype: "json",
        mtype: "GET",
        colModel: [
            {label: 'Mã học sinh', name: 'code', width: 120, align:"center"},
            {label: 'Họ và tên', name: 'fullname', width: 200},
            {label: 'Giới tính', name: 'gender', width: 100, align:"center", formatter: format_gender},
            {label: 'Ngày sinh', name: 'birthday', width: 150, align:"center"},
            {label: 'Lớp học', name: 'class_title', width: 100},
            {label: '&nbsp', name: 'id', hidden: true, key: true},
        ],
        viewrecords: true, height:(height_muster - 320), width: gwdth_muster, rowNum: 100, rownumbers: true,
        pager: "#muster_total_pager", rowList:[10,20,30],
        loadComplete : function() {
            var table = this;
            setTimeout(function(){
                updatePagerIcons(table);
            }, 0);
        }
    });
}

function reload_grid_muster(class_id, date_muster = new Date().toISOString().split('T')[0]){
    //console.log(date_muster);
    $('#list_muster_total').jqGrid('setGridParam',{
        postData: {"class_id": class_id, "date_muster": date_muster}
    }).trigger('reloadGrid');
}
/**************************************************************************************************************************************************/
function render_calendar(){
    updateCalendar();
}

function updateCalendar() {
    const firstDay = new Date(currentYear, currentMonth, 1).getDay();
    const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
    monthYearDisplay.textContent = `${monthNames[currentMonth]} ${currentYear}`;
    calendarBody.innerHTML = "";
    let date = 1;
    for (let i = 0; i < 6; i++) {
        const row = document.createElement("tr");
        for (let j = 0; j < 7; j++) {
            const cell = document.createElement("td");
            if (i === 0 && j < firstDay) {
                cell.innerHTML = "";
            } else if (date > daysInMonth) {
                cell.innerHTML = "";
            } else {
                cell.textContent = date;
                const dateStr = `${currentYear}-${String(currentMonth + 1).padStart(2, "0")}-${String(date).padStart(2, "0")}`;
                if (dateStr === getTodayString()) {
                    cell.classList.add("today");
                }
                // Thêm sự kiện khi click vào ô ngày
                cell.addEventListener("click", () => {
                   var class_id = $('#class_id_total').val();
                     if(class_id == '' || class_id == null){
                        show_message('error', 'Vui lòng chọn lớp học để xem điểm danh');
                    }else{  
                        reload_grid_muster(class_id, dateStr);
                    }
                });
                date++;
            }
            row.appendChild(cell);
        }
        calendarBody.appendChild(row);
        if (date > daysInMonth) break;
    }
}

function changeMonth(offset) {
    currentMonth += offset;
    if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
    } else if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
    }
    updateCalendar();
}

function getTodayString() {
    const d = new Date();
    return `${d.getFullYear()}-${String(d.getMonth() + 1).padStart(2, "0")}-${String(d.getDate()).padStart(2, "0")}`;
}