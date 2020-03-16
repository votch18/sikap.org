<?php 

/**
 * Util System Library Extension
 * Compilation of mostly my mostly used functions
 *
 * @author		Julious Mark de Leon
 * @link		https://linkedin.com/in/votch18
 */

class util
{
	protected 	$ci;
	
	function __construct()
    {
        // Assign the CodeIgniter super-object
        $this->ci =& get_instance();
    }

    public static function generate_random_code($length = 20) {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

	function blend_hex($from = '#ff0000', $to = '#008000', $pos) 
    { 
        // 1. Grab RGB from each colour 
        list($fr, $fg, $fb) = sscanf($from, '%2x%2x%2x'); 
        list($tr, $tg, $tb) = sscanf($to, '%2x%2x%2x'); 
        
        // 2. Calculate colour based on frational position 
        $r = (int) ($fr - (($fr - $tr) * $pos)); 
        $g = (int) ($fg - (($fg - $tg) * $pos)); 
        $b = (int) ($fb - (($fb - $tb) * $pos)); 
        
        // 3. Format to 6-char HEX colour string 
        return sprintf('%02x%02x%02x', $r, $g, $b); 
    }  

     /**
      * @param $caps boolean
      * @param $length integer
      * @return random characters 
      */
    public static function generateRandomCodeCapital($caps = FALSE, $length = 4) {     
        return ($caps === FALSE) ? substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length) : substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
     
    }

    /**
     * @param $value mixed
     * @param $decimal integer
     * @return 
     */
    public static function number_format($value, $decimal = 2){
        return number_format((float)$value, $decimal, '.', ',');
    }
	    
    /**
     * @param $value string
     * @param $format string {'Y/m/d h:m A', 'Y/m/d', etc.}
     * @return formated date string
     */
    public static function date_format($value, $format = 'Y-m-d'){
        return date_format(new DateTime($value), $format);
    }

    /**
     * @param $value string
     * @return string 
     */
    public static function get_chat_time($time, $date){
      
        $seconds = floor($time);
        $minutes = floor($seconds / 60);
        $hours = floor($minutes / 60);
        $days = floor($hours / 24);
        $months = floor($days / 30);
        $years = floor($months / 12);

        if ( $years > 0) {
           return date_format(new DateTime($date), 'M d, Y').' at '.date_format(new DateTime($date), 'h:s A');
        } else if ( $months > 0 ) {
            return date_format(new DateTime($date), 'M d, Y').' at '.date_format(new DateTime($date), 'h:s A');
        } else if ( $days > 0 ) {
            return ($days == 1) ? '1 day ago' : $days.' days ago';
        } else if ( $hours > 0 ) {
            return ($hours == 1) ? '1 hour ago' : $hours.' hours ago';
        } else if ( $minutes > 0 ) {
            return ($minutes == 1) ? '1 minute ago' : $minutes.' minutes ago';
        } else {
            return ($seconds == 1) ? '1 second ago' : $seconds.' seconds ago';
        }

    }

    /**
     * convert number to words
     * @param $number mixed
     * @return string
     */
    public static function NumbertoWords($number){

        //get whole number
        $wholenumber = floor($number);

        //get decimal number and convert to words
        $decimal = $number - $wholenumber;
        $decimal = ($decimal > 0 ? 'and '.floor($decimal * 100).'/100 Centavos' : '');

        $formater = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        return  $formater->format($wholenumber).' Pesos '.$decimal;   // outpout : five hundred sixty-six thousand five hundred sixty
    }

    /**
     * get ip address of client/visitor
     * @return ipaddress
     */
    public static function getIpAddress(){
        // Get real visitor IP behind CloudFlare network
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP)){
            $ip = $client;
        } elseif(filter_var($forward, FILTER_VALIDATE_IP)){
            $ip = $forward;
        }else{
            $ip = $remote;
        }

        return $ip;
    }

    /**
     * get browser name of client/visitor
     * @return string
     */
    public static function getBrowserName()
    {
        $user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        
        //add space to so that strpos won't return 0
        $user_agent = " ".$user_agent;

        if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
        elseif (strpos($user_agent, 'Edge')) return 'Microsoft Edge';
        elseif (strpos($user_agent, 'Chrome')) return 'Google Chrome';
        elseif (strpos($user_agent, 'Safari')) return 'Safari';
        elseif (strpos($user_agent, 'Firefox')) return 'Mozilla Firefox';
        elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';
        
        return 'Other';
    }

	
}

?>