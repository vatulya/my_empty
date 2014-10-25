<?php

use Codeception\Util\Stub as StubUtil;

require_once APPLICATION_PATH . 'config/class.php';

class ConfigCest
{

    const FULL_CLASS_NAME = '\Config';

    public function _before(UnitTester $I)
    {
        $I->clear();
    }

    public function _after(UnitTester $I)
    {
        $I->verifyStubs();
    }

    public function testLoad(UnitTester $I)
    {
        $config = ['some data', 'some data 2'];
        $stub = StubUtil::makeEmptyExcept(static::FULL_CLASS_NAME, 'load');
        $stub->load($config);

        $I->assertEquals($config, $I->getProtectedProperty($stub, 'config'), 'check if config array loaded correctly');

        $I->assertTrue(
            $I->seeExceptionThrown('Exception', function() use ($stub) {
                $stub->load(['try to rewrite config']);
            })
            , 'check if Config throws exception on rewrite config'
        );
    }

    public function testGet(UnitTester $I)
    {
        $config = [
            'key' => 'value',
            'key_array' => [
                'subkey' => 'subvalue',
            ],
        ];
        Config::getInstance()->load($config);

        $I->assertEquals('value', Config::get('key'), 'check real get method');
        $I->assertEquals('subvalue', Config::get(['key_array', 'subkey']), 'check real get method for sub array');
    }

}