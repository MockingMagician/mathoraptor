<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/mathoraptor/blob/master/LICENSE.md Apache License 2.0
 * @link https://github.com/MockingMagician/mathoraptor/blob/master/README.md
 */

namespace MockingMagician\Mathoraptor\Number;

use MockingMagician\Mathoraptor\Exceptions\ArgumentNotMatchPatternException;
use MockingMagician\Mathoraptor\Exceptions\ParseIntegerException;
use MockingMagician\Mathoraptor\Exceptions\ParseNumberException;
use MockingMagician\Mathoraptor\Helpers\Constants;

class BigInteger extends BigNumber
{
    /**
     * BigInteger constructor.
     *
     * @param string $number
     *
     * @throws ArgumentNotMatchPatternException
     * @throws ParseIntegerException
     * @throws ParseNumberException
     */
    protected function __construct(string $number)
    {
        parent::__construct($number);
        if (!\preg_match(Constants::INTEGER_PATTERN, $this->number)) {
            throw new ParseIntegerException($this->number);
        }
    }
}
