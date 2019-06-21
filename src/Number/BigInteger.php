<?php

namespace MockingMagician\Mathoraptor\Number;


use MockingMagician\Mathoraptor\Exceptions\ParseIntegerException;
use MockingMagician\Mathoraptor\Helpers\Constants;
use MockingMagician\Mathoraptor\Operation\BasicOperationsInterface;

class BigInteger implements BasicOperationsInterface
{
    private $sign;
    private $integerPart;

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
        $string = json_encode($this->__debugInfo());

        return $string ? $string : '';
    }

    /**
     * BigNumber constructor.
     * @param string $integer
     * @throws ParseIntegerException
     */
    private function __construct(string $integer)
    {
        $this->parseNumber(\trim($integer));
    }

    /**
     * @param string $integer
     * @throws ParseIntegerException
     */
    private function parseNumber(string $integer)
    {
        if (!(1 === \preg_match(Constants::INTEGER_PATTERN, $integer,$matches))) {
            throw new ParseIntegerException($integer);
        }

        $this->sign = '+';
        if (isset($matches[1]) && '-' === $matches[1]) {
            $this->sign = '-';
        }

        $this->integerPart = $matches[2];
    }

    /**
     * @param string $string
     * @return BigInteger
     * @throws ParseIntegerException
     */
    public static function fromString(string $string)
    {
        return new self($string);
    }

    /**
     * @param BasicOperationsInterface|BigInteger $interface
     * @return BigInteger
     * @throws ParseIntegerException
     */
    public function plusThat(BasicOperationsInterface $interface): BasicOperationsInterface
    {
        if ('-' === $interface->sign) {
            return $this->minusThat(BigInteger::fromString($this->integerPart));
        }

        $stringToParse = '';
        $self = str_split($this->integerPart);
        $that = str_split($interface->integerPart);
        $maxLength = max(count($self, $that));
        for ($i = 0; $this->integerPart; $i++) {

        }

        /**
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
     * @param BasicOperationsInterface|BigInteger $interface
     * @return BasicOperationsInterface
     * @throws ParseIntegerException
     */
    public function minusThat(BasicOperationsInterface $interface): BasicOperationsInterface
    {
        if ('-' === $interface->sign) {
            return $this->plusThat(BigInteger::fromString($this->integerPart));
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
}
