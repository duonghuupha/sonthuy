<?php
class Convert{
     /**
     * Convert dinh danh ngay thang
     **/
    function convertDate($text) {
		if ($text != '') {
			list ( $date, $month, $year ) = explode ( "-", $text );
			$text = $year . '-' . $month . '-' . $date;
		}
		return $text;
	}

    /**
     * Convert dinh danh ngay thang import
     **/
    function convertDate_Import($text) {
		if ($text != '') {
			list ( $date, $month, $year ) = explode ( "/", $text );
			$text = $year . '-' . $month . '-' . $date;
		}
		return $text;
	}

    /**
     * Convert ten file
     */
    function convert_file($txtname, $tiento){
        $extension = @end(explode(".", $txtname));
  		$prod = time();
  		$newfilename = $prod.'_'.$tiento.".".$extension;
        return $newfilename;
    }
    
    function weekOfMonth($date) {
        // estract date parts
        list($y, $m, $d) = explode('-', date('Y-m-d', strtotime($date)));
        
        // current week, min 1
        $w = 1;
        
        // for each day since the start of the month
        for ($i = 1; $i < $d; ++$i) {
            // if that day was a sunday and is not the first day of month
            if ($i > 1 && date('w', strtotime("$y-$m-$i")) == 0) {
                // increment current week
                ++$w;
            }
        }
        
        // now return
        return $w;
    }

    function generateBarcode($data) {
        $PNG_TEMP_DIR = DIR_UPLOAD.'/barcode/';
        $PNG_WEB_DIR = DIR_UPLOAD.'/barcode/';
        $SKU = $data["sku"];
        $filename = $PNG_TEMP_DIR.$SKU.'.png';
        if(file_exists($filename)){
            return $filename;
        }else{
            $productData = $SKU;
            $barcode = new \Com\Tecnick\Barcode\Barcode();
            $bobj = $barcode->getBarcodeObj('C128B', "{$productData}", 450, 70, 'black', array(0, 0, 0, 0));
            $imageData = $bobj->getPngData();
            file_put_contents($filename, $imageData);
            return $filename;
        }
    }

    function vn2latin($cs, $tolower = false){
        /*Mảng chứa tất cả ký tự có dấu trong Tiếng Việt*/
        $marTViet=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
            "ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề",
            "ế","ệ","ể","ễ",
            "ì","í","ị","ỉ","ĩ",
            "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ",
            "ờ","ớ","ợ","ở","ỡ",
            "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
            "ỳ","ý","ỵ","ỷ","ỹ",
            "đ",
            "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă",
            "Ằ","Ắ","Ặ","Ẳ","Ẵ",
            "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
            "Ì","Í","Ị","Ỉ","Ĩ",
            "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ",
            "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
            "Ỳ","Ý","Ỵ","Ỷ","Ỹ",
            "Đ"," ","$","%","?","&",'"',',',':',"/");
        /*Mảng chứa tất cả ký tự không dấu tương ứng với mảng $marTViet bên trên*/
        $marKoDau=array("a","a","a","a","a","a","a","a","a","a","a",
            "a","a","a","a","a","a",
            "e","e","e","e","e","e","e","e","e","e","e",
            "i","i","i","i","i",
            "o","o","o","o","o","o","o","o","o","o","o","o",
            "o","o","o","o","o",
            "u","u","u","u","u","u","u","u","u","u","u",
            "y","y","y","y","y",
            "d",
            "A","A","A","A","A","A","A","A","A","A","A","A",
            "A","A","A","A","A",
            "E","E","E","E","E","E","E","E","E","E","E",
            "I","I","I","I","I",
            "O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O",
            "U","U","U","U","U","U","U","U","U","U","U",
            "Y","Y","Y","Y","Y",
            "D","-","-","-","-","-","-","-",'',"");

        if ($tolower) {
            return strtolower(str_replace($marTViet,$marKoDau,$cs));
        }
        return str_replace($marTViet,$marKoDau,$cs);
    }
    function vn2latin_no_space($cs, $tolower = false){
        /*Mảng chứa tất cả ký tự có dấu trong Tiếng Việt*/
        $marTViet=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
            "ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề",
            "ế","ệ","ể","ễ",
            "ì","í","ị","ỉ","ĩ",
            "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ",
            "ờ","ớ","ợ","ở","ỡ",
            "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
            "ỳ","ý","ỵ","ỷ","ỹ",
            "đ",
            "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă",
            "Ằ","Ắ","Ặ","Ẳ","Ẵ",
            "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
            "Ì","Í","Ị","Ỉ","Ĩ",
            "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ",
            "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
            "Ỳ","Ý","Ỵ","Ỷ","Ỹ",
            "Đ"," ","$","%","?","&",'"',',',':',"/");
        /*Mảng chứa tất cả ký tự không dấu tương ứng với mảng $marTViet bên trên*/
        $marKoDau=array("a","a","a","a","a","a","a","a","a","a","a",
            "a","a","a","a","a","a",
            "e","e","e","e","e","e","e","e","e","e","e",
            "i","i","i","i","i",
            "o","o","o","o","o","o","o","o","o","o","o","o",
            "o","o","o","o","o",
            "u","u","u","u","u","u","u","u","u","u","u",
            "y","y","y","y","y",
            "d",
            "A","A","A","A","A","A","A","A","A","A","A","A",
            "A","A","A","A","A",
            "E","E","E","E","E","E","E","E","E","E","E",
            "I","I","I","I","I",
            "O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O",
            "U","U","U","U","U","U","U","U","U","U","U",
            "Y","Y","Y","Y","Y",
            "D","","","","","","","",'',"");

        if ($tolower) {
            return strtolower(str_replace($marTViet,$marKoDau,$cs));
        }
        return str_replace($marTViet,$marKoDau,$cs);
    }

    function cut($str, $len){
        $str = trim($str);
        if (strlen($str) <= $len) return $str;
        $str = substr($str, 0, $len);
        if ($str != "") {
            if (!substr_count($str, " ")) return $str." ...";
            while (strlen($str) && ($str[strlen($str) - 1] != " ")) $str = substr($str, 0, -1);
            $str = substr($str, 0, -1)." ...";
        }
        return $str;
    }

    function convert_size_file($bytes){
        $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "TB",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "GB",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "MB",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "KB",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "B",
                "VALUE" => 1
            ),
        );

        foreach($arBytes as $arItem){
            if($bytes >= $arItem["VALUE"]){
                $result = $bytes / $arItem["VALUE"];
                $result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
                break;
            }
        }
        return $result;
    }

    function return_day_text($text){
        if($text == 'Mon'){
            $string = 'Thứ hai';
        }elseif($text == 'Tue'){
            $string = 'Thứ ba';
        }elseif($text == 'Wed'){
            $string = 'Thứ tư';
        }elseif($text == 'Thu'){
            $string = 'Thứ năm';
        }elseif($text == 'Fri'){
            $string = 'Thứ sáu';
        }elseif($text == 'Sat'){
            $string = 'Thứ bảy';
        }elseif($text == 'Sun'){
            $string = 'Chủ nhật';
        }
        return $string;
    }

    function getStartAndEndDate($week, $year){
        $dto = new DateTime();
        $dto->setISOdate($year, $week);
        $ret['week_start'] = $dto->format('Y-m-d');
        $dto->modify('+6 days');
        $ret['week_end'] = $dto->format('Y-m-d');
        return $ret;
    }

    function return_day_number_text($text){
        if($text == 'Mon'){
            $string = 2;
        }elseif($text == 'Tue'){
            $string = 3;
        }elseif($text == 'Wed'){
            $string = 4;
        }elseif($text == 'Thu'){
            $string = 5;
        }elseif($text == 'Fri'){
            $string = 6;
        }elseif($text == 'Sat'){
            $string = 7;
        }
        return $string;
    }

    function return_day_number_text_sort($text){
        if($text == 'Mon'){
            $string = 'T2';
        }elseif($text == 'Tue'){
            $string = 'T3';
        }elseif($text == 'Wed'){
            $string = 'T4';
        }elseif($text == 'Thu'){
            $string = 'T5';
        }elseif($text == 'Fri'){
            $string = 'T6';
        }elseif($text == 'Sat'){
            $string = 'T7';
        }elseif($text){
            $string = 'CN';
        }
        return $string;
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function return_role_functions_static($userid, $roles, $event){
        $sql = new Model();
        $url = $_REQUEST['url']; $url = explode("/", $url);
        $check_role = $sql->check_functions_role($userid, $roles, $url[0]);
        if($check_role != 0 || $userid == 1){
            if($roles == 1){ // them moi
                $html = '
                <button type="button" class="btn btn-primary btn-sm" onclick="'.$event.'">
                    <i class="fa fa-plus"></i>
                    Thêm mới
                </button>
                ';
            }elseif($roles == 4){ // nhap du lieu tu file
                $html = '
                <button type="button" class="btn btn-info btn-sm" onclick="'.$event.'">
                    <i class="fa fa-file-excel-o"></i>
                    Nhập từ file
                </button>
                ';
            }elseif($roles == 2 && ($url[0] == 'students' || $url[0] == 'admission')){ // sua - chi su dung cho module quan ly hoc sinh
                $html = '
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle" aria-expanded="false">
                        Thao tác
                        <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="javascript:void(0)" onclick="edit_info()">
                                <i class="ace-icon fa fa-pencil"></i>
                                Cập nhật thông tin
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" onclick="edit_address()">
                                <i class="ace-icon fa fa-pencil"></i>
                                Cập nhật địa chỉ
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" onclick="edit_relation()">
                            <i class="ace-icon fa fa-pencil"></i>
                                Cập nhật thông tin phụ huynh
                            </a>
                        </li>
                    </ul>
                </div>
                ';
            }elseif($roles == 3 && ($url[0] == 'students' || $url[0] == 'admission')){
                $html = '
                <button type="button" class="btn btn-danger btn-sm" onclick="'.$event.'">
                    <i class="ace-icon fa fa-trash"></i>
                    Xóa
                </button>
                ';
            }elseif($roles == 6){ // Dang ky truoc van ban
                $html = '
                <button type="button" class="btn btn-success btn-sm" onclick="'.$event.'">
                    <i class="fa fa-pencil"></i>
                    Đăng ký văn bản
                </button>
                ';
            }elseif($roles == 5){ // Xuat du lieu
                $html = '
                <button type="button" class="btn btn-primary btn-sm" onclick="'.$event.'">
                    <i class="fa fa-cloud-download"></i>
                    Xuất dữ liệu
                </button>
                ';
            }
        }else{
            $html = '';
        }
        return $html;
    }
}
?>
