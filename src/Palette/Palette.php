<?php

namespace Palette;

class Palette
{
    private $hsla;
    private $format;

    /**
     * Set color value.
     *
     * @param mixed $color Color value
     * 
     * Allowed values:
     *     Empty (will default to black #000000)
     *     Hexadecimal color: long/short with/without #
     *     RGB(A) string
     *     RGB(A) comma seperated values
     *     HSL(A) string
     *     HTML color code in lowercase
     *     
     * @return object
     */
    public function set_color()
    {
        $args = func_get_args();

        // empty constructor - default to black #000000
        if (empty($args)) {
            $format = 'hex';
            $hex = '000000';

            $hsla = Convert::hex_to_hsla($hex);
        }
        // seperated rgb(a) values
        elseif (in_array(func_num_args(), [3, 4])) {
            $format = 'rgba';
            $rgba = [
                'r' => $args[0],
                'g' => $args[1],
                'b' => $args[2],
                'a' => (isset($args[3]) ? $args[3] : 1),
            ];

            $hsla = Convert::rgba_to_hsla($rgba);
        }
        // hex string
        elseif (Validate::hex($args[0]) !== false) {
            $format = 'hex';
            $hex = Validate::hex($args[0]);

            $hsla = Convert::hex_to_hsla($hex);
        }
        // rgb(a) string
        elseif (stripos($args[0], 'rgb') === 0) {
            $format = 'rgba';
            $rgba = self::parse_rgba_string($args[0]);

            // @TODO check if valid rgba
            // https://www.w3schools.com/colors/colors_rgb.asp

            $hsla = Convert::rgba_to_hsla($rgba);
        }
        // hsl(a) string
        elseif (stripos($args[0], 'hsl') === 0) {
            $format = 'hsla';
            $hsla = self::parse_hsla_string($args[0]);

            // @TODO check if valid hsla
            // https://www.w3schools.com/colors/colors_hsl.asp
        }
        // html color name
        elseif (array_key_exists($args[0], ColorNames::$list)) {
            $format = 'hex';
            $hex = ColorNames::$list[$args[0]];

            $hsla = Convert::hex_to_hsla($hex);
        }
        // invalid color
        else {
            throw new \Exception('Invalid color value');
        }

        $this->hsla = $hsla;
        $this->format = $format;

        return $this;
    }

    /**
     * Returns the hue component of a color.
     *
     * @param string $color
     *
     * @return int hue value of color
     */
    public function hue($color = null)
    {
        $this->color_input($color);

        return $this->hsla['h'];
    }

    /**
     * Returns the saturation component of a color.
     *
     * @param string $color
     *
     * @return int saturation value of color
     */
    public function saturation($color = null)
    {
        $this->color_input($color);

        return $this->hsla['s'];
    }

    /**
     * Returns the luminosity component of a color.
     *
     * @param string $color
     *
     * @return int luminosity value of color
     */
    public function luminosity($color = null)
    {
        $this->color_input($color);

        return $this->hsla['l'];
    }

    /**
     * Returns a color with the hue rotated along the color wheel by that amount.
     *
     * @param int   $degrees hue value between -360 & 360
     * @param mixed $color   Color value
     *
     * @return mixed Hue rotated color value
     */
    public function hue_rotate($degrees, $color = null)
    {
        $this->color_input($color);

        $hsla = $this->hsla;
        $hue = $hsla['h'];
        $hue = ($hue + $degrees);

        $hsla['h'] = $hue < 0 ? ($hue + 360) : ($hue % 360);

        return $this->return_format($hsla);
    }

    /**
     * Makes a color lighter.
     *
     * @param float $value Percentage value to lighten between 0 and 1
     * @param mixed $color Color value
     *
     * @return mixed Lightened color value
     */
    public function lighten($value, $color = null)
    {
        // prevent negative value
        $value = abs($value);

        $this->color_input($color);

        $hsla = $this->hsla;
        $lum = $hsla['l'];
        $lum += $value;

        $hsla['l'] = $lum > 1 ? 1 : $lum;

        return $this->return_format($hsla);
    }

    /**
     * Makes a color darker.
     *
     * @param float $value Percentage value to darken between 0 and 1
     * @param mixed $color Color value
     *
     * @return mixed Darkened color value
     */
    public function darken($value, $color = null)
    {
        // prevent negative value
        $value = abs($value);

        $this->color_input($color);

        $hsla = $this->hsla;
        $lum = $hsla['l'];
        $lum -= $value;

        $hsla['l'] = $lum < 0 ? 0 : $lum;

        return $this->return_format($hsla);
    }

    /**
     * Makes a color more saturated.
     *
     * @param float $value Percentage value to saturate between 0 and 1
     * @param mixed $color Color value
     *
     * @return mixed Saturated color value
     */
    public function saturate($value, $color = null)
    {
        // prevent negative value
        $value = abs($value);

        $this->color_input($color);

        $hsla = $this->hsla;
        $sat = $hsla['s'];
        $sat += $value;

        $hsla['s'] = $sat > 1 ? 1 : $sat;

        return $this->return_format($hsla);
    }

    /**
     * Makes a color less saturated.
     *
     * @param float $value Percentage value to desaturate between 0 and 1
     * @param mixed $color Color value
     *
     * @return mixed Desaturated color value
     */
    public function desaturate($value, $color = null)
    {
        // prevent negative value
        $value = abs($value);

        $this->color_input($color);

        $hsla = $this->hsla;
        $sat = $hsla['s'];
        $sat -= $value;

        $hsla['s'] = $sat < 0 ? 0 : $sat;

        return $this->return_format($hsla);
    }

    /**
     * Converts a color to grayscale. This is identical to `desaturate(1, $color)`.
     *
     * @param mixed $color Color value
     *
     * @return mixed Grayscale color value
     */
    public function grayscale($color = null)
    {
        $this->color_input($color);

        $hsla = $this->hsla;
        $hsla['s'] = 0;

        return $this->return_format($hsla);
    }

    /**
     * Returns the complement of a color. This is identical to hue_rotate(180, $color).
     *
     * @param mixed $color Color value
     *
     * @return mixed Complementary color value
     */
    public function complement($color = null)
    {
        $this->color_input($color);

        $hsla = $this->hsla;
        $hue = $hsla['h'];
        $hue = ($hue + 180);

        $hsla['h'] = $hue < 0 ? ($hue + 360) : ($hue % 360);

        return $this->return_format($hsla);
    }

    /**
     * Returns the inverse (negative) of a color.
     *
     * @param mixed $color Color value
     *
     * @return mixed Inverse color value
     */
    public function invert($color = null)
    {
        $this->color_input($color);

        $hsla = $this->hsla;

        $rgba = Convert::hsla_to_rgba($hsla);

        $rgba['r'] = 255 - $rgba['r'];
        $rgba['g'] = 255 - $rgba['g'];
        $rgba['b'] = 255 - $rgba['b'];

        $hsla = Convert::rgba_to_hsla($rgba);

        return $this->return_format($hsla);
    }

    /**
     * Take function provided color and set it globally.
     *
     * @param mixed $color Color value
     */
    private function color_input($color)
    {
        // use color if passed
        if (isset($color)) {
            $this->set_color($color);
        }
        // if no color value then set default
        elseif (!isset($this->hsla)) {
            $this->set_color();
        }
    }

    /**
     * Parse string into rgba array.
     *
     * @param string $string rgba string
     *
     * @return array Array of rgba values
     */
    public static function parse_rgba_string($string)
    {
        $s = trim(str_replace(' ', '', $string));

        if (stripos($s, 'rgba') === 0) {
            $res = sscanf($s, 'rgba(%d, %d, %d, %f)');
        } else {
            $res = sscanf($s, 'rgb(%d, %d, %d)');
            // manually add in alpha channel
            $res[] = 1;
        }

        return array_combine(['r', 'g', 'b', 'a'], $res);
    }

    /**
     * Parse string into hsla array.
     *
     * @param string $string hsla string
     *
     * @return array Array of hsla values
     */
    public static function parse_hsla_string($string)
    {
        $s = trim(str_replace(' ', '', $string));

        if (stripos($s, 'hsla') === 0) {
            $res = sscanf($s, 'hsla(%d, %d%%, %d%%, %f');
        } else {
            $res = sscanf($s, 'hsl(%d, %d%%, %d%%');
            // manually add in alpha channel
            $res[] = 1;
        }

        // convert percentage to decimal
        $res[1] /= 100;
        $res[2] /= 100;

        return array_combine(['h', 's', 'l', 'a'], $res);
    }

    /**
     * Returns color value in the format it was initially entered.
     *
     * @param array $hsla hsla values
     *
     * @return mixed
     */
    private function return_format($hsla)
    {
        switch ($this->format) {
            case 'hex' :
                return Convert::hsla_to_hex($hsla);
                break;
            case 'rgba' :
                return Convert::hsla_to_rgba($hsla);
                break;
            default :
                return $hsla;
                break;
        }
    }
}
