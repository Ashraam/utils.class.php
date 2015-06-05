<?php
class Utils {
	
	public static function get_ip() {
		if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
			$ip = $_SERVER['HTTP_CLIENT_IP'];  
		} elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
		} else {  
			$ip = $_SERVER['REMOTE_ADDR'];  
		}  
		return $ip;
	}
	
	public static function detect_mobile($useragent) {
		if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) {
			return true;
		} else {
			return false;
		}
	}
	
	public static function detect_bot($useragent) {
		if(preg_match('/bot|crawl|slurp|spider/i', $useragent)) {
			return true;
		} else {
			return false;
		}
	}
	
	/****************************************************************
	INPUTS
	****************************************************************/
	public static function is_email($email) {
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return true;
		} else {
			return false;
		}
	}
	
	public static function is_url($url) {
		if(preg_match('%^(?:(?:https?|ftp)://)(?:\S+(?::\S*)?@|\d{1,3}(?:\.\d{1,3}){3}|(?:(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)(?:\.(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)*(?:\.[a-z\x{00a1}-\x{ffff}]{2,6}))(?::\d+)?(?:[^\s]*)?$%iu', $url)) {
			return true;
		} else {
			return false;
		}
	}
	
	public static function clean_input($input) {
		$search = array(
			'@<script[^>]*?>.*?</script>@si',
			'@<[\/\!]*?[^<>]*?>@si',
			'@<style[^>]*?>.*?</style>@siU',
			'@<![\s\S]*?--[ \t\n\r]*>@'
		);
		$output = preg_replace($search, '', $input);
		return $output;
	}
	
	public static function rewrite($label) {
		$search = array ('@[éèêëÊË]@i','@[àâäÂÄ]@i','@[îïÎÏ]@i','@[ûùüÛÜ]@i','@[ôöÔÖ]@i','@[ç]@i','@[^a-zA-Z0-9]@');
		$replace = array ('e','a','i','u','o','c',' ');
		$label =  preg_replace($search, $replace, $label);
		$label = trim($label);
		$label = strtolower($label);
		$label = str_replace(" ",'-',$label);
		$label = preg_replace('#\-+#','-',$label);
		$label = preg_replace('#([-]+)#','-',$label);
		$label= trim($label,'-');
		$label = str_replace("--",'-',$label);
		return $label;
	}
	
	public static function isNull($str) {
		if(strlen(trim($str)) > 0) {
			return $str;
		} else {
			return NULL;
		}
	}
	
	/****************************************************************
	DATES
	****************************************************************/
	public static function date_exists($d, $m, $y) {
		if(checkdate($m, $d, $y)) {
			return true;
		} else {
			return false;
		}
	}
	
	public static function format_date_fr($date, $separateur='-') {
		list($y, $m, $d) = explode($separateur, $date);
		if(self::date_exists($d, $m, $y)) {
			$n = date('d/m/Y', mktime(0,0,0,$m,$d,$y));
			return $n;
		} else {
			return false;
		}
	}
	
	public static function format_date_en($date, $separateur='/') {
		list($d, $m, $y) = explode($separateur, $date);
		if(self::date_exists($d, $m, $y)) {
			$n = date('Y-m-d', mktime(0,0,0,$m,$d,$y));
			return $n;
		} else {
			return false;
		}
	}
	
	public static function date_difference($date1, $date2) {
		$d1 = strtotime($date1);
		$d2 = strtotime($date2);
		$diff = $d2-$d1;
		
		$secondsInAMinute 	= 60;
		$secondsInAnHour  	= 60 * $secondsInAMinute;
		$secondsInADay    	= 24 * $secondsInAnHour;
		$secondsInAMonth 	= 30 * $secondsInADay;
		$secondsInAYear 	= 12 * $secondsInAMonth;
		
		if(preg_match('/^[0-9]+$/', $diff)) {
			$years = floor($diff / $secondsInAYear);

			$monthSeconds = $diff % $secondsInAYear;
			$months = floor($monthSeconds / $secondsInAMonth);

			$daySeconds = $monthSeconds % $secondsInAMonth;
			$days = floor($daySeconds / $secondsInADay);
		
			$hourSeconds = $daySeconds % $secondsInADay;
			$hours = floor($hourSeconds / $secondsInAnHour);
		
			$minuteSeconds = $hourSeconds % $secondsInAnHour;
			$minutes = floor($minuteSeconds / $secondsInAMinute);
		
			$remainingSeconds = $minuteSeconds % $secondsInAMinute;
			$seconds = ceil($remainingSeconds);
		
			$obj = array(
				'years' => (int) $years,
				'months' => (int) $months,
				'days' => (int) $days,
				'hours' => (int) $hours,
				'minutes' => (int) $minutes,
				'seconds' => (int) $seconds
			);
			return $obj;
		} else {
			return false;
		}
	}
	
}
?>
