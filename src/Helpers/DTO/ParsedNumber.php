<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/mathoraptor/blob/master/LICENSE.md Apache License 2.0
 * @link https://github.com/MockingMagician/mathoraptor/blob/master/README.md
 */

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

    /** @var null|string */
    private $literal;

    /**
     * ParsedNumber constructor.
     *
     * @param string $sign
     * @param string $integerPart
     * @param string $decimalPart
     * @param string $exponentSign
     * @param int    $exponent
     *
     * @throws ArgumentNotMatchPatternException
     */
    public function __construct(
        string $sign,
        string $integerPart,
        string $decimalPart,
        string $exponentSign,
        int $exponent
    ) {
        if (!\preg_match(Constants::SIGN_PATTERN, $sign)) {
            throw new ArgumentNotMatchPatternException($sign, Constants::SIGN_PATTERN);
        }
        $this->sign = $sign;

        if (!\preg_match(Constants::ONE_OR_MORE_DIGIT_PATTERN, $integerPart)) {
            throw new ArgumentNotMatchPatternException($integerPart, Constants::ONE_OR_MORE_DIGIT_PATTERN);
        }
        $this->integerPart = $integerPart;

        if (!\preg_match(Constants::ONE_OR_MORE_DIGIT_PATTERN, $decimalPart)) {
            throw new ArgumentNotMatchPatternException($decimalPart, Constants::ONE_OR_MORE_DIGIT_PATTERN);
        }
        $this->decimalPart = $decimalPart;

        if (!\preg_match(Constants::SIGN_PATTERN, $exponentSign)) {
            throw new ArgumentNotMatchPatternException($exponentSign, Constants::SIGN_PATTERN);
        }
        $this->exponentSign = $exponentSign;

        $this->exponent = $exponent;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getSign(): string
    {
        return $this->sign;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getIntegerPart(): string
    {
        return $this->integerPart;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDecimalPart(): string
    {
        return $this->decimalPart;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getExponentSign(): string
    {
        return $this->exponentSign;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getExponent(): int
    {
        return $this->exponent;
    }

    public function getLiteral(): string
    {
        if (null === $this->literal) {
            $this->literal = $this->generateLiteral();
        }

        return $this->literal;
    }

    /**
     * @return string[]
     */
    private function getCleanIntegerAndDecimalFromExponent(): array
    {
        if (0 === $this->exponent) {
            return [$this->integerPart, $this->decimalPart];
        }

        if ('+' === $this->exponentSign && 0 !== $this->exponent) {
            $integerPart = $this->integerPart;
            $decimalLength = \mb_strlen($this->decimalPart);
            $diff = (int) ($this->exponent - $decimalLength);

            if (0 < $diff) {
                $integerPart .= $this->decimalPart;
                $integerPart .= \str_pad('', $diff, '0');
                $decimalPart = '0';

                return [$integerPart, $decimalPart];
            }

            if (0 > $diff = $this->exponent - $decimalLength) {
                $integerPart .= \mb_substr($this->decimalPart, 0, (int) ($decimalLength + $diff));
                $decimalPart = \mb_substr($this->decimalPart, $diff);

                return [$integerPart, $decimalPart];
            }

            $integerPart .= $this->decimalPart;
            $decimalPart = '0';

            return [$integerPart, $decimalPart];
        }

        // if ('-' === $this->exponentSign  && 0 !== $this->exponent)
        $decimalPart = $this->decimalPart;
        $integerLength = \mb_strlen($this->integerPart);
        $diff = (int) ($this->exponent - $integerLength);

        if (0 < $diff) {
            $decimalPart = $this->integerPart.$decimalPart;
            $decimalPart = \str_pad('', $diff, '0').$decimalPart;
            $integerPart = '0';

            return [$integerPart, $decimalPart];
        }

        if (0 > $diff) {
            $decimalPart = \mb_substr($this->integerPart, \abs($diff)).$decimalPart;
            $integerPart = \mb_substr($this->integerPart, 0, \abs($diff));

            return [$integerPart, $decimalPart];
        }

        $decimalPart = $this->integerPart.$decimalPart;
        $integerPart = '0';

        return [$integerPart, $decimalPart];
    }

    private function generateLiteral(): string
    {
        $cleaned = $this->getCleanIntegerAndDecimalFromExponent();
        $literal = '-' === $this->sign ? '-' : '';
        $literal .= ('' === ($integer = \ltrim($cleaned[0], '0'))) ? '0' : $integer;
        $literal .= \rtrim('.'.$cleaned[1], '.0');

        return $literal;
    }
}
