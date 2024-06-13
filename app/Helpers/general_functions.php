<?php

function dateForHumans( $date )
{
	Carbon\Carbon::setLocale('ar');
	$date  = Carbon\Carbon::parse( $date );
	return $date->diffForHumans() ;
}

function diffInDays( $start_date , $end_date )
{

	$start  = Carbon\Carbon::parse( $start_date );
	$end  = Carbon\Carbon::parse($end_date);
	return $start->diff($end)->days ;
}

function formatCourseDate( $date)
{
	return Carbon\Carbon::parse(str_replace("-", " ", $date))->format('d/m/Y');
}


function FormateDate( $date)
{
	return Carbon\Carbon::parse($date)->format('Y-m-d');
}

function FormateDateTimeZone( $date)
{
	return Carbon\Carbon::parse($date)->format('Y-m-d');
}

function getTimeFromDateTime( $datetime )
{
	return Carbon\Carbon::parse(str_replace("-", " ", $datetime))->format('H:m');
}

function isActiveTap( $route )
{
	if (request()->is('admin/'.$route.'/*') or request()->is('admin/'.$route)) {
		return "m-menu__item--active";
	}else{
		return "" ;
	}
}


function isActiveLi( $route )
{
	if (request()->is($route.'/*') or request()->is($route)) {
		return "activeLi";
	}else{
		return "" ;
	}
}

function dayName ($date )
{
	Carbon\Carbon::setlocale(LC_TIME, 'en');
	return Carbon\Carbon::parse( $date )->formatLocalized('%A');
}

function translateTimePeriod( $time )
{
	return strtr(strtolower($time), array('am' => 'صباحاً' , 'pm' => 'مساءاً') );
}

function getTimePeriod( $time )
{
	return Carbon\Carbon::parse( $time )->format('A');
}

function viewerType( $type )
{
	return strtr(strtolower($type), array('mobile' => 'الهاتف   فقط' , 'web' => ' الكومبيوتر  فقط' , 'both' => ' الهاتف او الكومبيوتر') );
}


function translateAttendanceType( $type )
{
	return strtr($type, array('all' => 'الكل' , 'men' => 'رجال فقط' ,'women' => 'نساء فقط', 'children' => 'اطفال فقط' ) );
}
function translateWeekDays( $day )
{
	return strtr(strtolower($day),
		array('saturday' => 'السبت' , 'sunday' => 'الأحد' ,'monday' => 'الأثنين', 'tuesday' => 'الثلاثاء' , 'wednesday'=> 'الاربعاء' ,
			'thursday' => 'الخميس' ,'friday' => 'الجمعة' ) );
}

function decodeEmoticons($src) {
	$replaced = preg_replace("/\\\\u([0-9A-F]{1,4})/i", "&#x$1;", $src);
	$result = mb_convert_encoding($replaced, "UTF-16", "HTML-ENTITIES");
	$result = mb_convert_encoding($result, 'utf-8', 'utf-16');
	return $result;
}



function arTOen($string) {
	return strtr($string, array('۰'=>'0', '۱'=>'1', '۲'=>'2', '۳'=>'3', '۴'=>'4', '۵'=>'5', '۶'=>'6', '۷'=>'7', '۸'=>'8', '۹'=>'9', '٠'=>'0', '١'=>'1', '٢'=>'2', '٣'=>'3', '٤'=>'4', '٥'=>'5', '٦'=>'6', '٧'=>'7', '٨'=>'8', '٩'=>'9'));
}

function getIP() {
	foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
		if (array_key_exists($key, $_SERVER) === true) {
			foreach (explode(',', $_SERVER[$key]) as $ip) {
				if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
					return $ip;
				}
			}
		}
	}
}



function isActiveTapFront( $route )
{
	if (request()->is($route.'/*') or request()->is($route)) {
		//return "current-menu-ancestor";
		return "activeitem";
	}else{
		return "" ;
	}
}

function HeadColor()
{
	if (strpos(Request()->server("REQUEST_URI"), 'user') || strpos(Request()->server("REQUEST_URI"), 'join')) {
		//return "current-menu-ancestor";
		return "bg_tint_dark";
	}else{
		return "bg_tint_dark" ;
	}
}

function arabicDate($time)
{
    $months = ["Jan" => "يناير", "Feb" => "فبراير", "Mar" => "مارس", "Apr" => "أبريل", "May" => "مايو", "Jun" => "يونيو", "Jul" => "يوليو", "Aug" => "أغسطس", "Sep" => "سبتمبر", "Oct" => "أكتوبر", "Nov" => "نوفمبر", "Dec" => "ديسمبر"];
    $days = ["Sat" => "السبت", "Sun" => "الأحد", "Mon" => "الإثنين", "Tue" => "الثلاثاء", "Wed" => "الأربعاء", "Thu" => "الخميس", "Fri" => "الجمعة"];
    $am_pm = ['AM' => 'صباحاً', 'PM' => 'مساءً'];
	
    $day = $days[date('D', strtotime($time))];
    $month = $months[date('M', strtotime($time))];
    $am_pm = $am_pm[date('A', strtotime($time))];
    // $date = $day . ' ' . date('d', strtotime($time)) . ' - ' . $month . ' - ' . date('Y', strtotime($time)) . '   ' . date('h:i', strtotime($time)) . ' ' . $am_pm;
    $date = date('d', strtotime($time)) . ' ' . $month . ' ' . date('Y', strtotime($time));
    $numbers_ar = ["٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩"];
    $numbers_en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

    //return str_replace($numbers_en, $numbers_ar, $date);
    return $date;
}

function arabicDay($time)
{
    $months = ["Jan" => "يناير", "Feb" => "فبراير", "Mar" => "مارس", "Apr" => "أبريل", "May" => "مايو", "Jun" => "يونيو", "Jul" => "يوليو", "Aug" => "أغسطس", "Sep" => "سبتمبر", "Oct" => "أكتوبر", "Nov" => "نوفمبر", "Dec" => "ديسمبر"];
    $days = ["Sat" => "السبت", "Sun" => "الأحد", "Mon" => "الإثنين", "Tue" => "الثلاثاء", "Wed" => "الأربعاء", "Thu" => "الخميس", "Fri" => "الجمعة"];
    $am_pm = ['AM' => 'صباحاً', 'PM' => 'مساءً'];
	
    $day = $days[date('D', strtotime($time))];
    $month = $months[date('M', strtotime($time))];
    $am_pm = $am_pm[date('A', strtotime($time))];
    // $date = $day . ' ' . date('d', strtotime($time)) . ' - ' . $month . ' - ' . date('Y', strtotime($time)) . '   ' . date('h:i', strtotime($time)) . ' ' . $am_pm;
    $date = date('d', strtotime($time)) . ' ' . $month . ' ' . date('Y', strtotime($time));
    $numbers_ar = ["٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩"];
    $numbers_en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

    //return str_replace($numbers_en, $numbers_ar, $date);
    return $day;
}

function arabictime($time,$timezone=null)
{
	$time = \Carbon\Carbon::parse($time)->setTimezone($timezone);
    $months = ["Jan" => "يناير", "Feb" => "فبراير", "Mar" => "مارس", "Apr" => "أبريل", "May" => "مايو", "Jun" => "يونيو", "Jul" => "يوليو", "Aug" => "أغسطس", "Sep" => "سبتمبر", "Oct" => "أكتوبر", "Nov" => "نوفمبر", "Dec" => "ديسمبر"];
    $days = ["Sat" => "السبت", "Sun" => "الأحد", "Mon" => "الإثنين", "Tue" => "الثلاثاء", "Wed" => "الأربعاء", "Thu" => "الخميس", "Fri" => "الجمعة"];
    $am_pm = ['AM' => 'ص', 'PM' => 'م'];
	
    $day = $days[date('D', strtotime($time))];
    $month = $months[date('M', strtotime($time))];
    $am_pm = $am_pm[date('A', strtotime($time))];
    $date = date('h:i', strtotime($time)) . ' ' . $am_pm;
   
    //return str_replace($numbers_en, $numbers_ar, $date);
    return $date;
}