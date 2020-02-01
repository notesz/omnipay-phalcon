<?php

namespace Skeleton\Library;

/**
 * Helper.
 *
 * @copyright Copyright (c) 2020 innobotics (https://innobotics.eu)
 * @author Norbert Lakatos <norbert@innobotics.eu>
 */
class Helper
{

    /**
     * Get client ip.
     *
     * @return string
     */
    public static function getClientIp()
    {
        return
            getenv('HTTP_CLIENT_IP')? :
                getenv('HTTP_X_FORWARDED_FOR')? :
                    getenv('HTTP_X_FORWARDED')? :
                        getenv('HTTP_FORWARDED_FOR')? :
                            getenv('HTTP_FORWARDED')? :
                                getenv('REMOTE_ADDR');
    }

    /**
     * Get timeago.
     *
     * @param $datetime
     * @param $language
     *
     * @return string
     */
    public static function getTimeAgo($datetime, $language = 'hu')
    {
        $timeAgo = new \Westsworld\TimeAgo(null, $language);

        return $timeAgo->inWords($datetime);
    }

    /**
     * Get datetime.
     * 2018-01-10 12:30:00 -> 2018. január 10. 12:30
     *
     * @param $datetime
     *
     * @return strin
     */
    public static function getDateTime($datetime)
    {
        $year = \substr($datetime, 0, 4);

        $month = \substr($datetime, 5, 2);

        $day = \substr($datetime, 8, 2);
        $day = ((\substr($day, 0, 1) == 0) ? \substr($day, 1, 1) : $day);

        $time = \substr($datetime, 11, 5);

        $months = [
            '01' => 'január',
            '02' => 'február',
            '03' => 'március',
            '04' => 'április',
            '05' => 'május',
            '06' => 'június',
            '07' => 'július',
            '08' => 'augusztus',
            '09' => 'szeptember',
            '10' => 'október',
            '11' => 'november',
            '12' => 'december',
        ];

        return $year . '. ' . $months[$month] . ' ' . $day . '. ' . $time;
    }

    /**
     * Debugger
     *
     * @param $content
     *
     * @return void
     */
    public function dump($content)
    {
        echo (new \Phalcon\Debug\Dump())->variable($content);

        die();
    }

}
