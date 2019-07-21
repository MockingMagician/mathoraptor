<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/mathoraptor/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/MockingMagician/mathoraptor/blob/master/README.md
 */

namespace MockingMagician\Mathoraptor\Helpers;

/**
 * Class Constants.
 */
final class Constants
{
    public const PARSE_NUMBER_PATTERN = '#^(?:[^\d+-]*)([+-]?)([\d]+)(?:\.([\d]+))?(?:e([+-]?)([\d]+))?(?:[^\d+-]*)$#';
    public const SIGN_PATTERN = '#^[+-]$#';
    public const ONE_OR_MORE_DIGIT_PATTERN = '#^\d+$#';

    public const INTEGER_PATTERN = '#^[+-]?\d+$#i';
    public const FLOAT_PATTERN = '#^[+-]?\d+$#i';

    public const NUMBER_PATTERN = '/^([+-]?)(\d+)(?:\.(\d+))?(?:e([+-]?)(\d+))?$/i';
    public const EXPONENT_PATTERN = '/^([+-]?)(\d+)(?:\.(\d+))?(?:e([+-]?)(\d+))$/i';
    public const TRIM_LEFT_NUMBER_PATTERN = '/^[ \t\n\r\x0B]*([+-]?)0*(\d+\.?\d*(e[+-]?\d+)?).*$/i';
    public const TRIM_LEFT_NUMBER_REPLACEMENT = '$1$2';
    public const TRIM_RIGHT_NUMBER_PATTERN = '/^([+-]?)(\d+)(?:\.0*|(\.\d+?)0*)(e[+-]?\d+)?$/i';
    public const TRIM_RIGHT_NUMBER_REPLACEMENT = '$1$2$3$4';
}
