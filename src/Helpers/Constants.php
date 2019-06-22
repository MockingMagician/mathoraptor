<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/mathoraptor/blob/master/LICENSE.md Apache License 2.0
 * @link https://github.com/MockingMagician/mathoraptor/blob/master/README.md
 */

namespace MockingMagician\Mathoraptor\Helpers;

final class Constants
{
    public const INTEGER_PATTERN = '/^([+-]?)(\d+)$/i';
    public const NUMBER_PATTERN = '/^([+-]?)(\d+)(?:\.(\d+))?(?:e([+-]?)(\d+))?$/i';
    public const EXPONENT_PATTERN = '/^([+-]?)(\d+)(?:\.(\d+))?(?:e([+-]?)(\d+))$/i';
    public const TRIM_LEFT_NUMBER_PATTERN = '/^[ \t\n\r\x0B]*0*(\d+\.?\d*(e\d+)?).*$/i';
    public const TRIM_LEFT_NUMBER_REPLACEMENT = '$1$2'; //
    public const TRIM_RIGHT_NUMBER_PATTERN = '/^([+-]?)(\d+)(?:\.0*|(\.[1-9]+)0*)(e[+-]?\d+)?$/i';
    public const TRIM_RIGHT_NUMBER_REPLACEMENT = '$1$2$3$4';
}
