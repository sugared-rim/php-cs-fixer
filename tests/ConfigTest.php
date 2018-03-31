<?php

namespace SugaredRim\PhpCsFixer;

class ConfigTest extends \PHPUnit\Framework\TestCase
{
    public function testGetShouldReturnNullOnUnknown()
    {
        $sut = new Config();
        $this->assertSame(null, $sut->{uniqid()});
    }

    public function testSetUnset()
    {
        $sut = new Config();
        $key = uniqid();
        $this->assertFalse(isset($sut->$key));
        $sut->$key = true;
        $this->assertTrue(isset($sut->$key));
        unset($sut->$key);
        $this->assertFalse(isset($sut->$key));
    }
}
