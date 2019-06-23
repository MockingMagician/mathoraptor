<?php

declare(strict_types=1);

namespace MockingMagician\Mathoraptor\Helpers\DTO;


use MockingMagician\Mathoraptor\Exceptions\ArgumentNotMatchPatternException;
use MockingMagician\Mathoraptor\Helpers\Constants;

class ParsedNumber
{
    private $sign;
    private $integerPart;
    private $decimalPart;
    private $exponentSign;
    private $exponent;

    /**
     * ParsedNumber constructor.
     * @param string $sign
     * @param string $integerPart
     * @param string $decimalPart
     * @param string $exponentSign
     * @param int $exponent
     * @throws ArgumentNotMatchPatternException
     */
    public function __construct(
        string $sign,
        string $integerPart,
        string $decimalPart,
        string $exponentSign,
        int $exponent
    ) {
        if (!preg_match(Constants::SIGN_PATTERN, $sign)) {
            throw new ArgumentNotMatchPatternException($sign, Constants::SIGN_PATTERN);
        }
        $this->sign = $sign;

        if (!preg_match(Constants::ONE_OR_MORE_DIGIT_PATTERN, $integerPart)) {
            throw new ArgumentNotMatchPatternException($integerPart, Constants::ONE_OR_MORE_DIGIT_PATTERN);
        }
        $this->integerPart = $integerPart;

        if (!preg_match(Constants::ONE_OR_MORE_DIGIT_PATTERN, $decimalPart)) {
            throw new ArgumentNotMatchPatternException($decimalPart, Constants::ONE_OR_MORE_DIGIT_PATTERN);
        }
        $this->decimalPart = $decimalPart;

        if (!preg_match(Constants::SIGN_PATTERN, $exponentSign)) {
            throw new ArgumentNotMatchPatternException($exponentSign, Constants::SIGN_PATTERN);
        }
        $this->exponentSign = $exponentSign;

        $this->exponent = $exponent;
    }

    public function getSign(): string
    {
        return $this->sign;
    }

    public function getIntegerPart(): string
    {
        return $this->integerPart;
    }

    public function getDecimalPart(): string
    {
        return $this->decimalPart;
    }

    public function getExponentSign(): string
    {
        return $this->exponentSign;
    }

    public function getExponent(): int
    {
        return $this->exponent;
    }

    public function getLiteral(): string
    {
        return '';
    }
}
