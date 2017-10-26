<?php

namespace TimeNormalizeTest\Validator;

use TimeNormalize\Validator\Time;

class TimeTest extends \PHPUnit_Framework_TestCase {

    /**
     * @dataProvider dataBad
     */
    public function testBad($time, array $formats = null) {
        $params = [];
        if (is_array($formats)) {
            $params[] = ['formats' => $formats];
        }
        $validator = new Time(...$params);
        $this->assertFalse($validator->isValid($time));
    }

    public static function dataBad() {
        return [
            [''],
            [null],
            [false],
            ['junk', ['']],
            ['junk junk'],
            ['junk am'],
            [':00 am'],
            ['00:0'],
            ['0:0'],
            ['1: am'],
            ['12:34 JM'],
            ['1200'],
            ['12 34 AM'],
            ['1 1 1'],
            ['12 12 12'],
            ['13:00 am'],
            ['23:59 am'],
            ['4:30pm', ['H:i']],
            ['04:30', ['h:i a']],
        ];
    }

    /**
     * @dataProvider dataGood
     */
    public function testGood($time, array $formats = null) {
        $params = [];
        if (is_array($formats)) {
            $params[] = ['formats' => $formats];
        }
        $validator = new Time(...$params);
        $this->assertTrue($validator->isValid($time));
    }

    public static function dataGood() {
        return [
            ['0', ['H']],
            ['00:00', ['H:i']],
            ['00:00 am'],
            ['00:00 AM', ['h:i a', 'H']],
            ['00:00 Am'],
            ['00:00 pm'],
            ['00:00 PM'],
            ['00:00 pM'],
            ['23:59'],
            ['12:34pm', ['H:i', 'h:i a']],
            ['5:55 pm'],
            ['12:00 am'],
            ['12:00 pm'],
            ['1200', ['Hi']],
        ];
    }

}
