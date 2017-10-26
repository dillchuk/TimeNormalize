<?php

namespace TimeNormalizeTest\Filter;

use TimeNormalize\Filter\Time;

class TimeTest extends \PHPUnit_Framework_TestCase {

    /**
     * @dataProvider dataBad
     */
    public function testBad($options, $time) {
        $filter = new Time(...$options);
        $this->assertSame($time, $filter->filter($time));
    }

    public static function dataBad() {
        return [
            [['H:i', ['h:i a']], '12:34'],
            [[], null],
            [['Hi'], false],
            [['Hi'], 'junk'],
            [['Hi'], 'junk junk'],
            [['Hi'], 'junk am'],
            [[':i a'], ':00 am'],
            [['Hi'], '00:0'],
            [['Hi'], '0:0'],
            [['Hi'], '1: am'],
            [['Hi'], '12:34 JM'],
            [['Hi'], '12 34 AM'],
            [['Hi'], '1 1 1'],
            [['Hi'], '12 12 12'],
            [['Hi'], '13:00 am'],
            [['Hi'], '23:59 am'],
        ];
    }

    /**
     * @dataProvider dataGood
     */
    public function testGood($options, $time, $expected) {
        $filter = new Time(...$options);
        $this->assertEquals($expected, $filter->filter($time));
    }

    public static function dataGood() {
        return [
            [['H', ['h a']], '12:34 am', '00'],
            [['h:i a', ['H:i']], '12:34', '12:34 pm'],
            [['Hi'], '0', '0000'],
            [['H:i'], '0', '00:00'],
            [['H:i'], '00:00', '00:00'],
            [['H a'], '12:34', '12 pm'],
            [['h:i a'], '00:00 am', '12:00 am'],
            [['H:i'], '00:00 AM', '00:00'],
            [['H:i'], '00:00 Am', '00:00'],
            [['H:i'], '00:00 pm', '12:00'],
            [['H:i'], '00:00 PM', '12:00'],
            [['h:i a'], '00:00 PM', '12:00 pm'],
            [['H:i'], '00:00 pM', '12:00'],
            [['H:i'], '5:15am', '05:15'],
            [['h:ia'], '5:15am', '05:15am'],
            [['H:i'], '23:59', '23:59'],
            [[], '1234', '12:34'],
            [[], '0056', '00:56'],
            [['h:i a'], '12:34pm', '12:34 pm'],
            [['H:i'], '5:55 pm', '17:55'],
            [['h:i a'], '12:00 am', '12:00 am'],
            [['H:i'], '12:00 pm', '12:00'],
            [[], '2400', '00:00'], // strange case
        ];
    }

}
