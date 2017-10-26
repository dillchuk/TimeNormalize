<?php

namespace TimeNormalizeTest;

use TimeNormalize\Module;

class ModuleTest extends \PHPUnit_Framework_TestCase {

    public function testConfig() {
        $module = new Module;
        $config = $module->getConfig();
        $this->assertTrue(isset($config['validators']));
        $this->assertTrue(isset($config['filters']));
    }

}
