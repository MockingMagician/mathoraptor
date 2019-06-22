<?php

declare(strict_types=1);

namespace MockingMagician\Mathoraptor\Helpers;


use MockingMagician\Mathoraptor\Exceptions\ParseNumberException;

final class Parser
{
    /** @var string */
    private $sign;
    /** @var string */
    private $integerPart;
    /** @var string */
    private $decimalPart;
    /** @var string */
    private $exponentSign;
    /** @var int */
    private $exponentPart;

    /**
     * @param string $number
     *
     * @throws ParseNumberException
     */
    private function __construct(string $number)
    {
        $number = \preg_replace(
            Constants::TRIM_LEFT_NUMBER_PATTERN,
            Constants::TRIM_LEFT_NUMBER_REPLACEMENT,
            $number
        );
        $number = \preg_replace(
            Constants::TRIM_RIGHT_NUMBER_PATTERN,
            Constants::TRIM_RIGHT_NUMBER_REPLACEMENT,
            $number
        );

        // check number pattern
        if (!preg_match(Constants::NUMBER_PATTERN, $number, $matches)) {
            throw new ParseNumberException($number);
        }

        $this->sign = '+';
        if (isset($matches[1]) && '-' === $matches[1]) {
            $this->sign = '-';
        }

        $this->integerPart = $matches[2];

        $this->decimalPart = '';
        if (isset($matches[3]) && '' !== $matches[3]) {
            $this->decimalPart = $matches[3];
        }

        $this->exponentSign = '+';
        if (isset($matches[4]) && '-' !== $matches[4]) {
            $this->exponentPart = $matches[4];
        }

        $this->exponentPart = 0;
        if (isset($matches[5]) && '' !== $matches[5]) {
            $this->exponentPart = (int) $matches[5];
        }
    }

    private function cleanExponent()
    {
        if (0 === $this->exponentPart) {
            return;
        }

        if ('+' === $this->exponentSign) {
            while (0 < $this->exponentSign-- && 0 < mb_strlen($this->decimalPart)) {
                $this->integerPart .= $this->decimalPart[0];
                $this->decimalPart = \mb_substr($this->decimalPart, 1);
            }
            while (0 < $this->exponentSign--) {
                $this->integerPart .= '0';
            }
            $this->exponentPart = 0;

//            $decimalLength = mb_strlen($this->decimalPart);
//            if ($decimalLength == $this->exponentPart) {
//                $this->integerPart .= $decimalLength;
//                $this->exponentPart = 0;
//
//                return;
//            }
//
//            if (0 < ($diff = $this->exponentPart - $decimalLength)) {
//                $this->integerPart .= $decimalLength;
//                $this->integerPart = str_pad($this->integerPart, $diff, '0');
//                $this->exponentPart = 0;
//
//                return;
//            }
//
//            if (0 > ($diff = $this->exponentPart - $decimalLength)) {
//                $this->integerPart .= mb_substr($this->decimalPart, 0, $this->exponentPart);
//                $this->decimalPart = mb_substr($this->decimalPart, $this->exponentPart);
//                $this->exponentPart = 0;
//
//                return;
//            }
        }

        if ('-' === $this->exponentSign) {
            while (0 < $this->exponentSign-- && 0 < mb_strlen($this->decimalPart)) {
                $this->decimalPart .= $this->integerPart[0];
                $this->decimalPart = \mb_substr($this->decimalPart, 1);
            }
            while (0 < $this->exponentSign--) {
                $this->integerPart .= '0';
            }
            $this->exponentPart = 0;
        }
    }

    /**
     * @param string $float
     * @return string
     * @throws ParseNumberException
     */
    public static function parseFloat(string $float): string
    {
        $self = new self($float);
        $self->cleanExponent();
    }

    public static function parseInteger(string $integer): string
    {

    }
}
