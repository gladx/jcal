<?php
namespace App;

use Date\Jalali;

class Jcal
{
    public static function getDefault()
    {
        $today = new Jalali(null, 'Asia/Tehran');
        $startOfMonth = (new Jalali(null, 'Asia/Tehran'))->startOfMonth();
        $endOfMonth = (new Jalali(null, 'Asia/Tehran'))->endOfMonth();
        $str = 'l ' . $today-> format('y l d F') . " l\n";
        $str .= 'Sh Ye Do Se Ch Pa Jo'."\n";
        $startFirstDayinWeek = $startOfMonth->format('N');
        for ($i = 0; $i <= $startFirstDayinWeek; $i++) {
            $str .= '     ';
        }

        for ($currentDay = clone $startOfMonth; $currentDay <= $endOfMonth; $currentDay->addDays(1)) {
            if($currentDay->day == $today->day) {
                $num = "*" . $currentDay->format('d') . "*";
                $str .=  sprintf("%-5s", $num);
            } else {
                $str .= sprintf("%-3s",$currentDay->format('d'));
            }

            if((($currentDay->format('N')) % 5) == 0) {
                $str .= "\n";
            } 
        }
        return $str;
    }
}