<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/mathoraptor/blob/master/LICENSE.md Apache License 2.0
 * @link https://github.com/MockingMagician/mathoraptor/blob/master/README.md
 */

namespace MockingMagician\Mathoraptor\Number;

use MockingMagician\Mathoraptor\Exceptions\ParseNumberException;
use MockingMagician\Mathoraptor\Helpers\Constants;

class BigNumber
{
    /** @var string */
    private $sign;
    /** @var string */
    private $integerPart;
    /** @var string */
    private $decimalPart;
    /** @var string */
    private $exponentPart;
    /** @var string */
    private $exponentSign;

    /**
     * BigNumber constructor.
     *
     * @param string $number
     *
     * @throws ParseNumberException
     */
    private function __construct(string $number)
    {
        $this->parseNumber(\trim($number));
    }

    /** @var string */

    /**
     * @codeCoverageIgnore
     */
    public function __debugInfo()
    {
        return [
            'sign' => $this->sign,
            'integerPart' => $this->integerPart,
            'decimalPart' => $this->decimalPart,
            'exponentSign' => $this->exponentSign,
            'exponentPart' => $this->exponentPart,
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
     *
     * @return BigNumber
     */
    public static function fromString(string $string): self
    {
        return new self($string);
    }

    /**
     * @param string $number
     *
     * @throws ParseNumberException
     */
    private function parseNumber(string $number): void
    {
        if (!(1 === \preg_match(Constants::NUMBER_PATTERN, $number, $matches))) {
            throw new ParseNumberException($number);
        }

        $this->sign = '+';
        if (isset($matches[1]) && '-' === $matches[1]) {
            $this->sign = '-';
        }

        $this->integerPart = $matches[2];

        $this->decimalPart = 0;
        if (isset($matches[3]) && '' !== $matches[3]) {
            $this->decimalPart = $matches[3];
        }

        $this->exponentSign = '+';
        if (isset($matches[4]) && '-' !== $matches[4]) {
            $this->exponentPart = $matches[4];
        }

        $this->exponentPart = 0;
        if (isset($matches[5]) && '' !== $matches[5]) {
            $this->exponentPart = $matches[5];
        }
    }

    private function cleanUp(): void
    {
        if ('0' === $this->exponentPart) {
            return;
        }

        if ('+' === $this->exponentSign) {
        }
    }
}
