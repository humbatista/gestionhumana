<?php
/*
#Example:
get_date_spanish(time(), true, 'month'); # return Enero
get_date_spanish(time(), true, 'month_mini'); # return ENE
get_date_spanish(time(), true, 'Y'); # return 2007
get_date_spanish(time());#return 06 de septiempre, 12:31 hs
*/


#Power by nicolaspar 2007 - especific proyect
function get_date_spanish( $time, $part = false, $formatDate = '' ){
    #Declare n compatible arrays
    $month = array("","enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");#n
    $month_execute = "n"; #format for array month

    $month_mini = array("","ENE", "FEB", "MAR", "ABR", "MAY", "JUN", "JUL", "AGO", "SEP", "OCT" , "NOV", "DIC");#n
    $month_mini_execute = "n"; #format for array month

    $day = array("domingo","lunes","martes","miércoles","jueves","viernes","sábado"); #w
    $day_execute = "w";
    
    $day_mini = array("DOM","LUN","MAR","MIE","JUE","VIE","SAB"); #w
    $day_mini_execute = "w";

/*
Other examples:
    Whether it's a leap year
    $leapyear = array("Este año febrero tendrá 28 días"."Si, estamos en un año bisiesto, un día más para trabajar!"); #l
     $leapyear_execute = "L";
*/

    #Content array exception print "HOY", position content the name array. Duplicate value and key for optimization in comparative
    $print_hoy = array("month"=>"month", "month_mini"=>"month_mini");

    if( $part === false ){
        return date("d", $time) . " de " . $month[date("n",$time)] . ", ". date("h:i a",$time);
    }elseif( $part === true ){
        if( ! empty( $print_hoy[$formatDate] ) && date("d-m-Y", $time ) == date("d-m-Y") ) return "HOY"; #Exception HOY
        if( ! empty( ${$formatDate} ) && !empty( ${$formatDate}[date(${$formatDate.'_execute'},$time)] ) ) return ${$formatDate}[date(${$formatDate.'_execute'},$time)];
        else return date($formatDate, $time);
    }else{
        return date("d-m-Y H:i", $time);
    }
}
	function time_since($original) {
    // array of time period chunks
    $chunks = array(
        array(60 * 60 * 24 * 365 , 'a&ntilde;o'),
        array(60 * 60 * 24 * 30 , 'mes'),
        array(60 * 60 * 24 * 7, 'semana'),
        array(60 * 60 * 24 , 'd&iacute;a'),
        array(60 * 60 , 'hora'),
        array(60 , 'minuto'),
    );
    
    $today = time(); /* Current unix time  */
    $since = $today - $original;
	
	if($since > 604800) {
		$print = date("M jS", $original);
	
		if($since > 31536000) {
				$print .= ", " . date("Y", $original);
			}

		return $print;

	}
    
    // $j saves performing the count function each time around the loop
    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
        
        $seconds = $chunks[$i][0];
        $name = $chunks[$i][1];
        
        // finding the biggest chunk (if the chunk fits, break)
        if (($count = floor($since / $seconds)) != 0) {
            // DEBUG print "<!-- It's $name -->\n";
            break;
        }
    }

    if ($name=="mes"){
		$print = ($count == 1) ? '1 '.$name : "$count {$name}es";
    }else{
		$print = ($count == 1) ? '1 '.$name : "$count {$name}s";
	}
	
	return "Sesion iniciada hace $print";
}
?>