<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/mathoraptor/blob/master/LICENSE.md Apache License 2.0
 * @link https://github.com/MockingMagician/mathoraptor/blob/master/README.md
 */

namespace MockingMagician\Mathoraptor\Number;

use MockingMagician\Mathoraptor\Exceptions\ParseIntegerException;
use MockingMagician\Mathoraptor\Helpers\Constants;
use MockingMagician\Mathoraptor\Operation\BasicOperationsInterface;

class BigInteger implements BasicOperationsInterface
{
    private $sign;
    private $integerPart;

    /**
     * BigNumber constructor.
     *
     * @param string $integer
     *
     * @throws ParseIntegerException
     */
    private function __construct(string $integer)
    {
        $this->parseNumber(\trim($integer));
    }

    /**
     * @codeCoverageIgnore
     */
    public function __debugInfo()
    {
        return [
            'sign' => $this->sign,
            'integerPart' => $this->sign,
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
     * @throws ParseIntegerException
     *
     * @return BigInteger
     */
    public static function fromString(string $string)
    {
        return new self($string);
    }

    /**
     * @param BasicOperationsInterface|self $interface
     *
     * @throws ParseIntegerException
     *
     * @return BasicOperationsInterface|self
     */
    public function plusThat(BasicOperationsInterface $interface): BasicOperationsInterface
    {
        if ('-' === $interface->sign) {
            return $this->minusThat(self::fromString($this->integerPart));
        }

        $result = '';
        $self = \str_split($this->integerPart);
        $iSelf = \count($self);
        $that = \str_split($interface->integerPart);
        $iThat = \count($that);
        for ($iSelf--, $iThat--; $iSelf >= 0 && $iThat >= 0; $iSelf--, $iThat--) {
        }

        /*
         * 1684961651
         *     894984
         * __________
         * 1684755535
         *    1101100
         * __________
         * 1685856635
         */
    }

    /**
     * @param BigInteger $interface
     *
     * @throws ParseIntegerException
     *
     * @return BasicOperationsInterface
     */
    public function minusThat(BasicOperationsInterface $interface): BasicOperationsInterface
    {
        if ('-' === $interface->sign) {
            return $this->plusThat(self::fromString($this->integerPart));
        }
    }

    public function multiplyBy(BasicOperationsInterface $interface): BasicOperationsInterface
    {
        // TODO: Implement multiplyBy() method.
    }

    public function divideBy(BasicOperationsInterface $interface): BasicOperationsInterface
    {
        // TODO: Implement divideBy() method.
    }

    /**
     * @param string $integer
     *
     * @throws ParseIntegerException
     */
    private function parseNumber(string $integer)
    {
        if (!(1 === \preg_match(Constants::INTEGER_PATTERN, $integer, $matches))) {
            throw new ParseIntegerException($integer);
        }

        $this->sign = '+';
        if (isset($matches[1]) && '-' === $matches[1]) {
            $this->sign = '-';
        }

        $this->integerPart = $matches[2];
    }
}
