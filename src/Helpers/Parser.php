<?php

declare(strict_types=1);

namespace MockingMagician\Mathoraptor\Helpers;


use MockingMagician\Mathoraptor\Exceptions\ParseNumberException;
use MockingMagician\Mathoraptor\Helpers\DTO\ParsedNumber;

final class Parser
{
    /** @var ParsedNumber */
    public $parsedNumber;

    /**
     * @param string $number
     *
     * @throws ParseNumberException
     */
    private function __construct(string $number)
    {
        if (!preg_match(Constants::PARSE_NUMBER_PATTERN, $number, $matches)) {
            throw new ParseNumberException($number);
        }

        $default = [$sign = '+', $integer = '0', $decimal = '0', $exponentSign = '+', $exponent = 0];

        for ($i = 0; $i < 5; $i++) {
            if (isset($matches[$i])) {
                if ('' !== $matches[$i]) {
                    $default[$i] = $matches[$i];
                    if (4 === $i) {
                        $default[$i] = (int) $default[$i];
                    }
                }
            }
        }

        $this->parsedNumber = new ParsedNumber(...$default);
    }

    private function cleanExponent()
    {
        if (0 === $this->exponentPart) {
            return;
        }

        if ('+' === $this->exponentSign) {
            while (0 < $this->exponentPart-- && 0 < mb_strlen($this->decimalPart)) {
                $this->integerPart .= $this->decimalPart[0];
                $this->decimalPart = \mb_substr($this->decimalPart, 1);
            }
            while (0 < $this->exponentPart--) {
                $this->integerPart .= '0';
            }

            return;
        }

        while (0 < $this->exponentPart-- && 0 < mb_strlen($this->integerPart)) {
            $this->decimalPart = $this->integerPart[\mb_strlen($this->integerPart) - 1] . $this->decimalPart;
            $this->integerPart = \mb_substr($this->integerPart, 0, \mb_strlen($this->integerPart) - 1);
        }
        while (0 <= $this->exponentPart--) {
            $this->decimalPart = '0' . $this->decimalPart;
        }
    }

    public static function parseNumber(string $float): string
    {
        $self = new self($float);
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

        return \preg_replace(
            Constants::TRIM_LEFT_NUMBER_PATTERN,
            Constants::TRIM_LEFT_NUMBER_REPLACEMENT,
            ('-' === $self->sign ? '-' : '') . (0 === \mb_strlen($self->integerPart) ? 0 : $self->integerPart) . '.' . $self->decimalPart
        );
    }

    /**
     * @param string $integer
     * @return string
     * @throws ParseNumberException
     */
    public static function parseInteger(string $integer): string
    {
        $self = new self($integer);
        $self->cleanExponent();

        return \preg_replace(
            Constants::TRIM_LEFT_NUMBER_PATTERN,
            Constants::TRIM_LEFT_NUMBER_REPLACEMENT,
            ('-' === $self->sign ? '-' : '') . $self->integerPart
        );
    }
}
