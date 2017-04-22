<?php

namespace Palette;

class Validate
{
    /**
     * Validate hex string.
     *
     * @param string $hex hex value
     *
     * @return string|bool validated hex string|false
     */
    public static function hex($hex)
    {
        // complete patterns like #ffffff or #fff
        if (preg_match('/^#([0-9a-fA-F]{6})$/', $hex)
            || preg_match('/^#([0-9a-fA-F]{3})$/', $hex)) {
            // remove #
            $hex = substr($hex, 1);
        }

        // complete patterns without # like ffffff or 000000
        if (preg_match('/^([0-9a-fA-F]{6})$/', $hex)) {
            return $hex;
        }

        // short patterns without # like fff or 000
        if (preg_match('/^([0-9a-f]{3})$/', $hex)) {
            // Spread to 6 digits
            return substr($hex, 0, 1).substr($hex, 0, 1).substr($hex, 1, 1).substr($hex, 1, 1).substr($hex, 2, 1).substr($hex, 2, 1);
        }

        return false;
    }
}
