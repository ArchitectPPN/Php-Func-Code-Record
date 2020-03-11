<?php
    date_default_timezone_set('America/New_York');
//    //  获取每年3月份的第一个周末:
//    $time = time();
//    $year = 2019;
//    $day = 1;
//    // 获取每年3.1号是周几, 然后推算出第二个周末是几号
//    $week = date("w",strtotime($year . '-03-' . $day));
//    echo '今天:' . $week . "\n";
//    $twoWeekDay = [
//        7, 13, 12, 11, 10, 9, 8
//    ];
//    $day += $twoWeekDay[$week];
//    echo $year . "-03-" . $day . "\n";
//
//    $num2 = 1;
//    // 获取11月份的第一个周末
//    $weekDay = date("w",strtotime($year . '-11-' . $num2));
//    $firstWeekDay = [
//        0, 6, 5, 4, 3, 2, 1
//    ];
//    $num2 += $firstWeekDay[$weekDay];
//    echo $year . "-11-" . $num2 . "\n";

    function isDstTime($nowTime)
    {
        // 当前年份
        $year = date('Y', time());
        // 每个月份的1号
        $day = 1;
        // 判断当前日期为周几
        $week = date("w",strtotime($year . '-03-' . $day));
        // 根据今天周几往后推几天, 即为3月份的第二个周末
        $twoWeekDay = [
            7, 13, 12, 11, 10, 9, 8
        ];
        $threeMonth = $day + $twoWeekDay[$week];
        // 具体的日期时间戳
        $startTime = strtotime($year . '-03-' . $threeMonth . "02:00:00");
        $weekDay = date("w",strtotime($year . '-11-' . $day));
        $firstWeekDay = [
            0, 6, 5, 4, 3, 2, 1
        ];
        $elevenMonth = $day + $firstWeekDay[$weekDay];
        // 具体的日期时间戳

        $endTime = strtotime($year . '-11-' . $elevenMonth . "02:00:00");
        if($startTime < $nowTime &&  $nowTime < $endTime) {
            return true;
        } else {
            return false;
        }
    }

