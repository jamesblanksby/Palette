<?php

require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Palette\Convert;

class TestHslaConvert extends TestCase
{
    public $hsla_array = [
        ['h' => 180, 's' => 1, 'l' => 0.5,  'a' => 1.0],
        ['h' => 240, 's' => 1, 'l' => 0.5,  'a' => 1.0],
        ['h' => 120, 's' => 1, 'l' => 0.25, 'a' => 1.0],
    ];

    public function test_hsla_to_rgba()
    {
        // target rgba
        $rgba_array = [
            ['r' => 0, 'g' => 255, 'b' => 255, 'a' => 1.0],
            ['r' => 0, 'g' => 0,   'b' => 255, 'a' => 1.0],
            ['r' => 0, 'g' => 128, 'b' => 0,   'a' => 1.0],
        ];

        foreach ($this->hsla_array as $index => $hsla) {
            $this->assertEquals($rgba_array[$index], Convert::hsla_to_rgba($hsla));
        }
    }

    public function test_hsla_to_hex()
    {
        // target hex
        $hex_array = [
            '#00ffff',
            '#0000ff',
            '#008000'
        ];

        foreach ($this->hsla_array as $index => $hsla) {
            $this->assertEquals($hex_array[$index], Convert::hsla_to_hex($hsla));
        }
    }

    public function test_hsla_to_hex_without_prefix()
    {
        // target hex
        $hex_array = [
            '00ffff',
            '0000ff',
            '008000'
        ];
        
        foreach ($this->hsla_array as $index => $hsla) {
            $this->assertEquals($hex_array[$index], Convert::hsla_to_hex($hsla, false));
        }
    }
}
