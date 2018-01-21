<?php

require __DIR__.'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Palette\Convert;

class TestRgbaConvert extends TestCase
{
    public $rgba_array = [
        ['r' => 0, 'g' => 255, 'b' => 255, 'a' => 1.0],
        ['r' => 0, 'g' => 0,   'b' => 255, 'a' => 1.0],
        ['r' => 0, 'g' => 128, 'b' => 0,   'a' => 1.0],
    ];

    public function test_rgba_to_hsla()
    {
        // target hsla
        $hsla_array = [
            ['h' => 180, 's' => 1, 'l' => 0.5,  'a' => 1.0],
            ['h' => 240, 's' => 1, 'l' => 0.5,  'a' => 1.0],
            ['h' => 120, 's' => 1, 'l' => 0.25, 'a' => 1.0],
        ];

        foreach ($this->rgba_array as $index => $rgba) {
            $this->assertEquals($hsla_array[$index], Convert::rgba_to_hsla($rgba));
        }
    }

    public function test_rgba_to_hex()
    {
        // target hex
        $hex_array = [
            '#00ffff',
            '#0000ff',
            '#008000'
        ];

        foreach ($this->rgba_array as $index => $rgba) {
            $this->assertEquals($hex_array[$index], Convert::rgba_to_hex($rgba));
        }
    }

    public function test_rgba_to_hex_without_prefix()
    {
        // target hex
        $hex_array = [
            '00ffff',
            '0000ff',
            '008000'
        ];

        foreach ($this->rgba_array as $index => $rgba) {
            $this->assertEquals($hex_array[$index], Convert::rgba_to_hex($rgba, false));
        }
    }
}
