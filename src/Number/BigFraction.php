<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/mathoraptor/blob/master/LICENSE.md Apache License 2.0
 * @link https://github.com/MockingMagician/mathoraptor/blob/master/README.md
 */

namespace MockingMagician\Mathoraptor\Number;

class BigFraction
{
    private $numerator;
    private $denominator;

    public function __construct(BigInteger $numerator, BigInteger $denominator)
    {
        $this->numerator = $numerator;
        $this->denominator = $denominator;
    }
}
