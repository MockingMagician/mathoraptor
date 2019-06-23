<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/mathoraptor/blob/master/LICENSE.md Apache License 2.0
 * @link https://github.com/MockingMagician/mathoraptor/blob/master/README.md
 */

namespace MockingMagician\Mathoraptor\Number;

use MockingMagician\Mathoraptor\Exceptions\ArgumentNotMatchPatternException;
use MockingMagician\Mathoraptor\Exceptions\OperationException;
use MockingMagician\Mathoraptor\Exceptions\ParseNumberException;
use MockingMagician\Mathoraptor\Helpers\Parser;
use MockingMagician\Mathoraptor\Operation\BasicOperationsInterface;

class BigNumber implements BasicOperationsInterface
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
        return $this->number ? $this->number : '';
    }

    /**
     * @param string $string
     *
     * @throws ParseNumberException
     * @throws ArgumentNotMatchPatternException
     *
     * @return static
     */
    public static function fromString(string $string): self
    {
        return new static($string);
    }

    public function getIntegerPart()
    {
        if (false === \strpos($this->number, '.')) {
            return $this->number;
        }

        return \explode('.', $this->number)[0];
    }

    public function getDecimalPart()
    {
        if (false === \strpos($this->number, '.')) {
            return '';
        }

        return \explode('.', $this->number)[1];
    }

    /**
     * @param BasicOperationsInterface $interface
     *
     * @throws ArgumentNotMatchPatternException
     * @throws OperationException
     * @throws ParseNumberException
     *
     * @return BasicOperationsInterface
     */
    public function add(BasicOperationsInterface $interface): BasicOperationsInterface
    {
        if ($interface instanceof self) {
            $length = \max(\mb_strlen($this->getDecimalPart()), \mb_strlen($interface->getDecimalPart()));

            return self::fromString(\bcadd($this->number, $interface->number, $length));
        }

        if ($interface instanceof BigFraction) {
            $numerator = \bcmul($this->getNumber(), $interface->getDenominator()->getNumber());
            $numerator = \bcadd($numerator, $interface->getNumerator()->getNumber());

            return new BigFraction(BigInteger::fromString($numerator), clone $interface->getDenominator());
        }

        throw new OperationException(
            \sprintf('Operation not implemented with object `%s`', \get_class($interface))
        );
    }

    /**
     * @param BasicOperationsInterface $interface
     *
     * @throws ArgumentNotMatchPatternException
     * @throws OperationException
     * @throws ParseNumberException
     *
     * @return BasicOperationsInterface
     */
    public function sub(BasicOperationsInterface $interface): BasicOperationsInterface
    {
        if ($interface instanceof self) {
            $length = \max(\mb_strlen($this->getDecimalPart()), \mb_strlen($interface->getDecimalPart()));

            return self::fromString(\bcsub($this->number, $interface->number, $length));
        }

        if ($interface instanceof BigFraction) {
            $numerator = \bcmul($this->getNumber(), $interface->getDenominator()->getNumber());
            $numerator = \bcsub($numerator, $interface->getNumerator()->getNumber());

            return new BigFraction(BigInteger::fromString($numerator), clone $interface->getDenominator());
        }

        throw new OperationException(
            \sprintf('Operation not implemented with object `%s`', \get_class($interface))
        );
    }

    /**
     * @param BasicOperationsInterface $interface
     *
     * @throws ArgumentNotMatchPatternException
     * @throws OperationException
     * @throws ParseNumberException
     *
     * @return BasicOperationsInterface
     */
    public function multiplyBy(BasicOperationsInterface $interface): BasicOperationsInterface
    {
        if ($interface instanceof self) {
            $length = \max(\mb_strlen($this->getDecimalPart()), \mb_strlen($interface->getDecimalPart()));

            return self::fromString(\bcmul($this->number, $interface->number, $length));
        }

        if ($interface instanceof BigFraction) {
            $numerator = \bcmul($this->getNumber(), $interface->getNumerator()->getNumber());
            $denominator = \bcmul($this->getNumber(), $interface->getDenominator()->getNumber());

            return new BigFraction(BigInteger::fromString($numerator), BigInteger::fromString($denominator));
        }

        throw new OperationException(
            \sprintf('Operation not implemented with object `%s`', \get_class($interface))
        );
    }

    /**
     * @param BasicOperationsInterface $interface
     *
     * @throws ArgumentNotMatchPatternException
     * @throws OperationException
     * @throws ParseNumberException
     *
     * @return BasicOperationsInterface
     */
    public function divideBy(BasicOperationsInterface $interface): BasicOperationsInterface
    {
        if ($interface instanceof self) {
            $length = \max(\mb_strlen($this->getDecimalPart()), \mb_strlen($interface->getDecimalPart()));

            return new BigFraction(
                BigInteger::fromString(\bcmul($this->number, "${length}")),
                BigInteger::fromString(\bcmul($interface->number, "${length}"))
            );
        }

        if ($interface instanceof BigFraction) {
            $numerator = \bcmul($this->getNumber(), $interface->getDenominator()->getNumber());

            return new BigFraction(BigInteger::fromString($numerator), clone $interface->getNumerator());
        }

        throw new OperationException(
            \sprintf('Operation not implemented with object `%s`', \get_class($interface))
        );
    }

    public function getNumber(): string
    {
        return $this->number;
    }
}
