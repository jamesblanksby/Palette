# Palette

> A simple color manipulation library.

# Installation

Using [Composer](https://getcomposer.org/):

```sh
$ composer require jamesblanksby/palette
```

# API
## Color Manipulation
- <a href="#--paletteset_colorcolor">`set_color([$color])`</a>
- <a href="#--palettehuemixed-color">`hue([mixed $color])`</a>
- <a href="#--palettesaturationmixed-color">`saturation([mixed $color])`</a>
- <a href="#--paletteluminositymixed-color">`luminosity([mixed $color])`</a>
- <a href="#--palettehue_rotateint-degrees--mixed-color">`hue_rotate(int $degrees [, mixed $color])`</a>
- <a href="#--palettelightenfloat-value--mixed-color">`lighten(float $value [, mixed $color])`</a>
- <a href="#--palettedarkenfloat-value--mixed-color">`darken(float $value [, mixed $color])`</a>
- <a href="#--palettesaturatefloat-value--mixed-color">`saturate(float $value [, mixed $color])`</a>
- <a href="#--palettedesaturatefloat-value--mixed-color">`desaturate(float $value [, mixed $color])`</a>
- <a href="#--palettegrayscalemixed-color">`grayscale([mixed $color])`</a>
- <a href="#--palettecomplementmixed-color">`complement([mixed $color])`</a>
- <a href="#--paletteinvertmixed-color">`invert([mixed $color])`</a>

## Color Conversion
- <a href="#--converthex_to_hslastring-hex">`hex_to_hsla(string $hex)`</a>
- <a href="#--converthex_to_rgbastring-hex">`hex_to_rgba(string $hex)`</a>
- <a href="#--convertrgba_to_hslastring-rgba">`rgba_to_hsla(string $rgba)`</a>
- <a href="#--convertrgba_to_hexstring-rgba">`rgba_to_hex(string $rgba [, boolean $prefix])`</a>
- <a href="#--converthsla_to_rgbastring-hsla">`hsla_to_rgba(string $hsla)`</a>
- <a href="#--converthsla_to_hexstring-hex">`hsla_to_hex(string $hex [, boolean $prefix])`</a>

## Color Validation
- <a href="#--validatehexstring-hex">`hex(string $hex)`</a>


# Color Manipulation

### - `Palette::set_color([$color])`
Set color value globally.

#### Parameters
- `$color`: Allowed color values: _(optional)_
    - Empty: will default to black `#000000`
    - Hexadecimal color: `#fff`, `#fffffff`, `fff` & `fffffff`
    - RGB(A) string: `rgb(255, 255, 255)` or `rgba(255,255, 255, 1)`
    - RGB(A) comma seperated values: `Palette::set_color($r, $g, $b [, $a])`
    - HSL(A) string: `hsl(360, 100%, 100%)` or `hsla(360, 100%, 100%, 1)`
    - <a href="https://www.w3.org/TR/css3-color/#svg-color" target="_blank">HTML color code in lowercase</a>

#### Returns
- `$this`

<hr>

### - `Palette::hue([mixed $color])`
Returns the hue component of a color.

#### Parameters
- `$color`: See `set_color()` documentation _(optional)_

#### Returns
- The hue component, between 0deg and 360deg

<hr>

### - `Palette::saturation([mixed $color])`
Returns the saturation component of a color.

#### Parameters
- `$color`: See `set_color()` documentation _(optional)_

#### Returns
- The saturation component, between 0 and 1

<hr>

### - `Palette::luminosity([mixed $color])`
Returns the luminosity component of a color.

#### Parameters
- `$color`: See `set_color()` documentation _(optional)_

#### Returns
- The luminosity component, between 0 and 1

<hr>

### - `Palette::hue_rotate(int $degrees [, mixed $color])`
Changes the hue of a color.

#### Parameters
- `$degrees`: The number of degrees to rotate the hue
- `$color`: See `set_color()` documentation _(optional)_

#### Returns
- Hue rotated color value in the same format it was entered

<hr>

### - `Palette::lighten(float $value [, mixed $color])`
Makes a color lighter.

#### Parameters
- `$value`: The amount to increase the lightness by, between 0 and 1
- `$color`: See `set_color()` documentation _(optional)_

#### Returns
- Lightened color value in the same format it was entered

<hr>

### - `Palette::darken(float $value [, mixed $color])`
Makes a color darker.

#### Parameters
- `$value`: The amount to decrease the lightness by, between 0 and 1
- `$color`: See `set_color()` documentation _(optional)_

#### Returns
- Darkened color value in the same format it was entered

<hr>

### - `Palette::saturate(float $value [, mixed $color])`
Makes a color more saturated.

#### Parameters
- `$value`: The amount to increase the saturation by, between 0 and 1
- `$color`: See `set_color()` documentation _(optional)_

#### Returns
- Saturated color value in the same format it was entered

<hr>

### - `Palette::desaturate(float $value [, mixed $color])`
Makes a color less saturated.

#### Parameters
- `$value`: The amount to decrease the saturation by, between 0 and 1
- `$color`: See `set_color()` documentation _(optional)_

#### Returns
- Desaturated color value in the same format it was entered

<hr>

### - `Palette::grayscale([mixed $color])`
Converts a color to grayscale. This is identical to `desaturate(1 [, mixed $color)`.

#### Parameters
- `$color`: See `set_color()` documentation _(optional)_

#### Returns
- Grayscale color value in the same format it was entered

<hr>

### - `Palette::complement([mixed $color])`
Returns the complement of a color. This is identical to `hue_rotate(180 [, mixed $color)`.

#### Parameters
- `$color`: See `set_color()` documentation _(optional)_

#### Returns
- Complementary color value in the same format it was entered

<hr>

### - `Palette::invert([mixed $color])`
Returns the inverse (negative) of a color.

#### Parameters
- `$color`: See `set_color()` documentation _(optional)_

#### Returns
- Inverse color value in the same format it was entered


# Color Conversion

### - `Convert::hex_to_hsla(string $hex)`
Converts hexadecimal color into a HSLA array

#### Parameters
- `$hex`: Hexadecimal color (`#fff`, `#fffffff`, `fff` & `fffffff`)

#### Returns
- HSLA array of color values:
    - `h`: Hue degree on the color wheel
    - `s`: Saturation percentage value between 0 and 1
    - `l`: Luminosity percentage value between 0 and 1
    - `a`: Alpha percentage value between 0 and 1

<hr>

### - `Convert::hex_to_rgba(string $hex)`
Converts hexadecimal color into a RGBA array

#### Parameters
- `$hex`: Hexadecimal color (`#fff`, `#fffffff`, `fff` & `fffffff`)

#### Returns
- RGBA array of color values:
    - `r`: Red color intensity
    - `g`: Green color intensity
    - `b`: Blue color intensity
    - `a`: Alpha percentage value between 0 and 1

<hr>

### - `Convert::rgba_to_hsla(string $rgba)`
Converts RGBA array into a HSLA array

#### Parameters
- `$rgba`: RGBA array of color values:
    - `r`: Red color intensity
    - `g`: Green color intensity
    - `b`: Blue color intensity
    - `a`: Alpha percentage value between 0 and 1 _(optional)_

#### Returns
- HSLA array of color values:
    - `h`: Hue degree on the color wheel
    - `s`: Saturation percentage value between 0 and 1
    - `l`: Luminosity percentage value between 0 and 1
    - `a`: Alpha percentage value between 0 and 1

<hr>

### - `Convert::rgba_to_hex(string $rgba [, $prefix = true])`
Converts RGBA array into a hexadecimal color

#### Parameters
- `$rgba`: RGBA array of color values:
    - `r`: Red color intensity
    - `g`: Green color intensity
    - `b`: Blue color intensity
    - `a`: Alpha percentage value between 0 and 1 _(optional)_
- `$prefix`: Flag to set whether value should be prefixed with a hash _(optional)_

#### Returns
- Hexadecimal color string

<hr>

### - `Convert::hsla_to_rgba(string $hsla)`
Converts HSLA array into a RGBA array

#### Parameters
- `$hsla`: HSLA array of color values:
    - `h`: Hue degree on the color wheel
    - `s`: Saturation percentage value between 0 and 1
    - `l`: Luminosity percentage value between 0 and 1
    - `a`: Alpha percentage value between 0 and 1

#### Returns
- RGBA array of color values:
    - `r`: Red color intensity
    - `g`: Green color intensity
    - `b`: Blue color intensity
    - `a`: Alpha percentage value between 0 and 1

<hr>

### - `Convert::hsla_to_hex(string $hex [, boolean $prefix = true])`
Converts HSLA array into a hexadecimal color

#### Parameters
- `$hex`: HSLA array of color values:
    - `h`: Hue degree on the color wheel
    - `s`: Saturation percentage value between 0 and 1
    - `l`: Luminosity percentage value between 0 and 1
    - `a`: Alpha percentage value between 0 and 1
- `$prefix`: Flag to set whether value should be prefixed with a hash _(optional)_

#### Returns
- Hexadecimal color string


# Color Validation

### - `Validate::hex(string $hex)`
Validates a hexadecimal color string

#### Parameters
- `$hex`: Hexadecimal color string

#### Returns
- Hexadecimal color string without preceding hash, false on invalid input
