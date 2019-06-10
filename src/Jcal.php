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
        $str = 'l ' . $today->format('y l d F') . " l\n";
        $str .= ' Sh  Ye   Do  Se  Ch  Pa  Jo' . "\n";
        $startFirstDayinWeek = $startOfMonth->format('N');
        $numSpace = ($startFirstDayinWeek > 5) ? ($startFirstDayinWeek - 6) : ($startFirstDayinWeek + 1);
        for ($i = 0; $i < $numSpace; $i++) {
            $str .= '       ';
        }

        for ($currentDay = clone $startOfMonth; $currentDay <= $endOfMonth; $currentDay->addDays(1)) {
            if ($currentDay->day == $today->day) {
                $str .= " " . "[" . $currentDay->format('d') . "](http://t.me/jcal2bot/)" . "  ";
            } else {
                $str .= "`" . sprintf("%-3s", $currentDay->format('d')) . "`";
            }

            if ((($currentDay->format('N')) % 5) == 0) {
                $str .= "\n";
            }
        }
        return $str;
    }

    public static function get3()
    {
        $today = new Jalali(null, 'Asia/Tehran');
        $pastMonth = (clone $today)->subMonths(1);
        $nextMonth = (clone $today)->addMonths(1);

        $str = self::getOneMonth($pastMonth);
        $str .= "\n\n";
        $str .= self::getDefault();
        $str .= "\n";
        $str .= self::getOneMonth($nextMonth);

        return $str;
    }

    public static function getOneMonth($date)
    {
        $startOfMonth = (clone $date)->startOfMonth();
        $endOfMonth = (clone $date)->endOfMonth();
        $str = 'l ' . $startOfMonth->format('y F') . " l\n";
        $str .= 'Sh  Ye   Do  Se  Ch  Pa  Jo' . "\n";
        $startFirstDayinWeek = $startOfMonth->format('N');
        $numSpace = ($startFirstDayinWeek > 5) ? ($startFirstDayinWeek - 6) : ($startFirstDayinWeek + 1);
        for ($i = 0; $i < $numSpace; $i++) {
            $str .= '       ';
        }

        for ($currentDay = clone $startOfMonth; $currentDay <= $endOfMonth; $currentDay->addDays(1)) {
            $str .= "`" . sprintf("%-3s", $currentDay->format('d')) . "`";

            if ((($currentDay->format('N')) % 5) == 0) {
                $str .= "\n";
            }
        }
        return $str;
    }
}
