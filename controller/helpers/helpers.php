<?php
namespace src\controller\helpers;
//echo "22222222@2";
class helpers{

    function time_elapsed_string($datetime, $full = false) {
       //2019-10-02 18:00:00
     // print_r(gmdate("Y-m-d H:i:s"));
    // print_r($datetime);
       ///print_r(new \DateTime("now"));

        $now = new \DateTime(gmdate("Y-m-d H:i:s",strtotime("+".$_COOKIE['timezoneOffset']." hour")));

        $ago = new \DateTime($datetime);
        $diff = $now->diff($ago);
       

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        if($now < $ago ){
            return $string ? 'In '.implode(', ', $string)  : 'just now';


        }else{
            return $string ? implode(', ', $string) . ' ago' : 'just now';


        }
    }
    
}
?>