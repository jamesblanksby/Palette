<?php

namespace Palette;

class Convert
{
    /**
     * Convert hex to hsla.
     *
     * @param string $hex hex value
     *
     * @return array hsla values
     */
    public static function hex_to_hsla($hex)
    {
        // validate hex input
        $hex = Validate::hex($hex);
        $hex = $hex !== false ? $hex : '#000000';

        $rgba = self::hex_to_rgba($hex);

        return self::rgba_to_hsla($rgba);
    }

    /**
     * Convert hex to rgba.
     *
     * @param string $hex hex value
     *
     * @return array rgba values
     */
    public static function hex_to_rgba($hex)
    {
        // validate hex input
        $hex = Validate::hex($hex);
        $hex = $hex !== false ? $hex : '#000000';

        // split input by color
        $hex = str_split($hex, 2);

        // convert hex color values to rgba
        $rgba = [
            'r' => (hexdec($hex[0])),
            'g' => (hexdec($hex[1])),
            'b' => (hexdec($hex[2])),
            'a' => (float) 1,
        ];

        return $rgba;
    }

    /**
     * Convert rgb(a) to hsla.
     *
     * @param array $rgba rgb(a) values
     *
     * @return array hsla values
     */
    public static function rgba_to_hsla($rgba)
    {
        $r = $rgba['r'] / 255;
        $g = $rgba['g'] / 255;
        $b = $rgba['b'] / 255;
        $a = isset($rgba['a']) ? $rgba['a'] : 1;

        // determine lowest & highest value and chroma
        $max = max($r, $g, $b);
        $min = min($r, $g, $b);

        $diff = $max - $min;
        $add = $max + $min;

        // calculate hue
        if ($min == $max) {
            $hue = 0;
        } elseif ($r == $max) {
            $hue = ((60 * ($g - $b) / $diff) + 360) % 360;
        } elseif ($g == $max) {
            $hue = (60 * ($b - $r) / $diff) + 120;
        } else {
            $hue = (60 * ($r - $g) / $diff) + 240;
        }

        // calculate luminosity 
        $lum = .5 * $add;

        // calculate saturation
        if ($lum == 0) {
            $sat = 0;
        } elseif ($lum == 1) {
            $sat = 1;
        } elseif ($lum <= .5) {
            $sat = $diff / $add;
        } else {
            $sat = $diff / (2 - $add);
        }

        $h = (int) round($hue);
        $s = round($sat, 2);
        $l = round($lum, 2);

        $hsla = [
            'h' => $h,
            's' => $s,
            'l' => $l,
            'a' => $a,
        ];

        return $hsla;
    }

    /**
     * Convert rgb(a) to hex.
     *
     * @param array $rgba rgb(a) values
     *
     * @return string returns hex string with # prefix
     */
    public static function rgba_to_hex($rgba)
    {
        return sprintf('#%02x%02x%02x', $rgba['r'], $rgba['g'], $rgba['b']);
    }

    /**
     * Convert hsl(s) to rgba.
     *
     * @param array $hsla hsl(a) values
     *
     * @return array rgba values       
     */
    public static function hsla_to_rgba($hsla)
    {
        $hue = $hsla['h'] / 360;
        $sat = $hsla['s'];
        $lum = $hsla['l'];
        $a = isset($hsla['a']) ? $hsla['a'] : 1;

        if ($lum <= .5) {
            $q = $lum * (1 + $sat);
        } else {
            $q = $lum + $sat - ($lum * $sat);
        }

        $p = 2 * $lum - $q;

        $r = $hue + (1 / 3);
        $g = $hue;
        $b = $hue - (1 / 3);

        $r = round(self::hue_to_rgb($p, $q, $r) * 255);
        $g = round(self::hue_to_rgb($p, $q, $g) * 255);
        $b = round(self::hue_to_rgb($p, $q, $b) * 255);

        $rgba = [
            'r' => $r,
            'g' => $g,
            'b' => $b,
            'a' => $a,
        ];

        return $rgba;
    }

    /**
     * Convert hsl(a) to hex.
     *
     * @param array $hsla hsl(a) values
     *
     * @return string returns hex string with # prefix
     */
    public static function hsla_to_hex($hsla)
    {
        $rgba = self::hsla_to_rgba($hsla);

        $hex = self::rgba_to_hex($rgba);

        return $hex;
    }

    /**
     * Converts hsla hue to rgb.
     *
     * @return int
     */
    private static function hue_to_rgb($p, $q, $h)
    {
        if ($h < 0) {
            $h += 1;
        }
        if ($h > 1) {
            $h -= 1;
        }

        if (($h * 6) < 1) {
            return $p + ($q - $p) * $h * 6;
        } elseif (($h * 2) < 1) {
            return $q;
        } elseif (($h * 3) < 2) {
            return $p + ($q - $p) * ((2 / 3) - $h) * 6;
        } else {
            return $p;
        }
    }
}
