<?php

require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Palette\Convert;

class TestHexConvert extends TestCase
{
    public $hex_array = [
        '#00ff00',
        '00ff00',
        '#0f0',
        '0f0'
    ];

    public function test_hex_to_hsla()
    {
        // target hsla
        $hsla = [
            'h' => 120,
            's' => 1.0,
            'l' => 0.5,
            'a' => 1.0
        ];

        foreach ($this->hex_array as $hex) {
            $this->assertEquals($hsla, Convert::hex_to_hsla($hex));
        }
    }

    public function test_hex_to_rgba()
    {
        // target rgba
        $rgba = [
            'r' => 0,
            'g' => 255,
            'b' => 0,
            'a' => 1.0
        ];

        foreach ($this->hex_array as $hex) {
            $this->assertEquals($rgba, Convert::hex_to_rgba($hex));
        }
    }
}
