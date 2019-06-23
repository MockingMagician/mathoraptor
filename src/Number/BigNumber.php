<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/mathoraptor/blob/master/LICENSE.md Apache License 2.0
 * @link https://github.com/MockingMagician/mathoraptor/blob/master/README.md
 */

namespace MockingMagician\Mathoraptor\Number;

use MockingMagician\Mathoraptor\Exceptions\ArgumentNotMatchPatternException;
use MockingMagician\Mathoraptor\Exceptions\ParseNumberException;
use MockingMagician\Mathoraptor\Helpers\Parser;

class BigNumber
{
    /** @var string */
    protected $number;

    /**
     * BigNumber constructor.
     *
     * @param string $number
     *
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     */
    protected function __construct(string $number)
    {
        $this->number = Parser::parseNumber($number);
    }

    /**
     * @codeCoverageIgnore
     */
    public function __debugInfo()
    {
        return [
            'number' => $this->number,
        ];
    }

    /**
     * @codeCoverageIgnore
     */
    public function __toString()
    {
        $string = \json_encode($this->__debugInfo());

        return $string ? $string : '';
    }

    /**
     * @param string $string
     *
     * @throws ParseNumberException
     * @throws ArgumentNotMatchPatternException
     *
     * @return BigNumber
     */
    public static function fromString(string $string): self
    {
        return new self($string);
    }
}
