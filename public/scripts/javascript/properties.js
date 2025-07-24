$(function(){
    $('.select2').select2(); // Select box
    $('.date-picker').datepicker({autoclose: true,todayHighlight: true}); // Datebox
    //Filebox
    $('.file_attach').ace_file_input({
        no_file:'Không có file ...',btn_choose:'Lựa chọn',
        btn_change:'Thay đổi',droppable:false,
        onchange:null,thumbnail:true
    });
    $('.overlay').hide(); // loading
    $("input[data-type='currency']").on({ // Format currency onkeypress input
        keyup: function() {formatCurrency($(this));}
    });
    $("input[data_type='currency']").on({ // Format currency onkeypress input
        keyup: function() {formatCurrency($(this));}
    });
    ////////////////////////////////////////////////////////////////////////////////////////////////
    /*document.onkeydown = function(e){
        if((e.ctrlKey && 
            (e.keyCode === 85 ||
            e.keyCode === 117)) || 
            e.keyCode === 123 ||
            (e.ctrlKey && e.shiftKey && e.keyCode == 73)){
            console.log('not allowed');
            return false;
        }else{
            return true;
        }
    }
    document.addEventListener("contextmenu", function(e){
        e.preventDefault();
    }, false);*/
});

/**
 * Display notifycation
 * @param {*} icon 
 * @param {*} msg 
 */
function show_message(icon, msg){
    $.toast({
        heading: 'Thông báo',
        text: msg,
        showHideTransition: 'fade',
        icon: icon,
        position: 'top-right'
    })
}

/**
 * Format number
 * @param {*} n 
 * @returns 
 */
function formatNumber(n) {
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}

/**
 * 
 * @param {*} input 
 * @param {*} blur 
 * @returns 
 */
function formatCurrency(input, blur) {
    var input_val = input.val();
    if (input_val === "") { return; }
    var original_len = input_val.length;
    var caret_pos = input.prop("selectionStart");
    if (input_val.indexOf(".") >= 0) {
        var decimal_pos = input_val.indexOf(".");
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);
        left_side = formatNumber(left_side);
        right_side = formatNumber(right_side);
        if (blur === "blur") {
            right_side += "00";
        }
        right_side = right_side.substring(0, 2);
        input_val = left_side + "." + right_side;
    } else {
        input_val = formatNumber(input_val);
        input_val = input_val;
        if (blur === "blur") {
            input_val += ".00";
        }
    }
    input.val(input_val);
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}

/**
 * 
 * @param {*} evt 
 */
function validate(evt) {
    var theEvent = evt || window.event;
    // Handle paste
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
        // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    var regex = /[0-9]|\./;
    if (!regex.test(key)) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
    }
}

/**
 * 
 * @param {*} amount 
 * @returns 
 */
function CurrencyFormatted(amount){
	return amount.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}

/**
 * 
 * @param {*} table 
 */
function updatePagerIcons(table) {
    var replacement = 
    {
        'ui-icon-seek-first' : 'ace-icon fa fa-angle-double-left bigger-140',
        'ui-icon-seek-prev' : 'ace-icon fa fa-angle-left bigger-140',
        'ui-icon-seek-next' : 'ace-icon fa fa-angle-right bigger-140',
        'ui-icon-seek-end' : 'ace-icon fa fa-angle-double-right bigger-140'
    };
    $('.ui-pg-table:not(.navtable) > tbody > tr > .ui-pg-button > .ui-icon').each(function(){
        var icon = $(this);
        var $class = $.trim(icon.attr('class').replace('ui-icon', ''));
        
        if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
    })
}

/**
 * 
 * @param {*} id 
 * @param {*} url_data 
 * @param {*} selected 
 * @param {*} title_selected 
 */
function combo_select_2(id, url_data, selected, title_selected){
    $(id).select2({
        ajax: {
            url: url_data,
            dataType: 'json',
            type: 'GET',
            data: function (params) {
                var queryParameters = {
                    q: params.term
                }
                return queryParameters;
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.title,
                            id: item.id,
                            disabled: item.disabled
                        }
                    })
                };
            }
        }
    });
    if(selected != 0){
        var $option = $('<option selected>'+title_selected+'</option>').val(selected);
        $(id).append($option).trigger('change');
    }
}

/**
 * 
 * @param {*} id 
 * @param {*} url_data 
 * @param {*} array_object 
 */
function combo_select_2_multiple(id, url_data, array_object){
    $(id).select2({
        multiple: true,
        ajax: {
            url: url_data,
            dataType: 'json',
            type: 'GET',
            data: function (params) {
                var queryParameters = {
                    q: params.term
                }
                return queryParameters;
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.title,
                            id: item.id,
                            disabled: item.disabled
                        }
                    })
                };
            }
        }
    });
    if(array_object.length != 0){
        for(const item of array_object){
            var $option = $('<option selected>'+item.title+'</option>').val(item.idh);
            $(id).append($option).trigger('change');
        }
    }
}

/**
 * 
 * @param {*} id_select 
 * @param {*} url_data 
 * @param {*} selected 
 * @param {*} title_selected 
 */
function combo_select_2_format(id_select, url_data, selected, title_selected){
    $(id_select).select2({
        ajax: {
            url: url_data,
            type: 'POST',
            dataType: 'json',
            data: function (params) {
                var queryParameters = {
                    q: params.term
                }
                return queryParameters;
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.title,
                            id: item.id,
                            content: item.content
                        };
                    })
                };
            }
        },
        templateResult: format_content
    });
    if(selected != 0){
        var $option = $('<option selected>'+title_selected+'</option>').val(selected);
        $(id_select).append($option).trigger('change');
    }
}

/**
 * 
 * @param {*} row 
 * @returns 
 */
function format_content(row){
    console.log(Object.keys(row).length);
    if(Object.keys(row).length >= 3){
        var $strdata = $(
            '<div>'+row.text+'</div><div style="color:gray">'+row.content+'</div>'
        );
    }else{
        var $strdata = '';
    }
    return $strdata;
}

/**
 * 
 * @param {*} email 
 * @returns 
 */
function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

/**
 * 
 * @param {*} str 
 * @returns 
 */
function removeVietnameseTones(str) {
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a"); 
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e"); 
    str = str.replace(/ì|í|ị|ỉ|ĩ/g,"i"); 
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o"); 
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u"); 
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y"); 
    str = str.replace(/đ/g,"d");
    str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
    str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
    str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
    str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
    str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
    str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
    str = str.replace(/Đ/g, "D");
    // Some system encode vietnamese combining accent as individual utf-8 characters
    // Một vài bộ encode coi các dấu mũ, dấu chữ như một kí tự riêng biệt nên thêm hai dòng này
    str = str.replace(/\u0300|\u0301|\u0303|\u0309|\u0323/g, ""); // ̀ ́ ̃ ̉ ̣  huyền, sắc, ngã, hỏi, nặng
    str = str.replace(/\u02C6|\u0306|\u031B/g, ""); // ˆ ̆ ̛  Â, Ê, Ă, Ơ, Ư
    // Remove extra spaces
    // Bỏ các khoảng trắng liền nhau
    str = str.replace(/ + /g," ");
    str = str.trim();
    // Remove punctuations
    // Bỏ dấu câu, kí tự đặc biệt
    str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g," ");
    str = str.toLowerCase(); str = str.split(" ").join("");
    return str;
}

/**
 * 
 * @param {*} $str 
 */
function return_format_date($str){
    let today = new Date($str), ngay = today.getDate(), thang = (today.getMonth() + 1), nam = today.getFullYear();
    thang = (thang < 10) ? '0'+thang : thang;
    ngay = (ngay < 10) ? '0'+ngay : ngay;
    return ngay+'-'+thang+'-'+nam;
}

function reset_form(id_form){
    $(id_form)[0].reset(); $('.select2').val(null).trigger('change.select2'); $('.file_attach').ace_file_input('reset_input');
}