<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/mathoraptor/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/MockingMagician/mathoraptor/blob/master/README.md
 */

namespace MockingMagician\Mathoraptor\Number;

use MockingMagician\Mathoraptor\Exceptions\ArgumentNotMatchPatternException;
use MockingMagician\Mathoraptor\Exceptions\OperationException;
use MockingMagician\Mathoraptor\Exceptions\ParseNumberException;
use MockingMagician\Mathoraptor\Operation\BasicOperationsInterface;

class BigFraction implements BasicOperationsInterface
{
    private $numerator;
    private $denominator;

    /**
     * BigFraction constructor.
     *
     * @param BigInteger $numerator
     * @param BigInteger $denominator
     *
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     */
    public function __construct(BigInteger $numerator, BigInteger $denominator)
    {
        $this->numerator = $numerator;
        $this->denominator = $denominator;
        $this->reduce();
    }

    /**
     * @codeCoverageIgnore
     */
    public function __debugInfo()
    {
        return [
            'numerator' => $this->numerator->getNumber(),
            'denominator' => $this->denominator->getNumber(),
        ];
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
            $n1 = \bcmul($this->numerator->getNumber(), $interface->denominator->getNumber());
            $n2 = \bcmul($interface->numerator->getNumber(), $this->denominator->getNumber());
            $numerator = \bcadd($n1, $n2);
            $denominator = \bcmul($this->denominator->getNumber(), $interface->denominator->getNumber());

            return new BigFraction(BigInteger::fromString($numerator), BigInteger::fromString($denominator));
        }

        if ($interface instanceof BigNumber) {
            return $interface->add($this);
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
            $n1 = \bcmul($this->numerator->getNumber(), $interface->denominator->getNumber());
            $n2 = \bcmul($interface->numerator->getNumber(), $this->denominator->getNumber());
            $numerator = \bcsub($n1, $n2);
            $denominator = \bcmul($this->denominator->getNumber(), $interface->denominator->getNumber());

            return new BigFraction(BigInteger::fromString($numerator), BigInteger::fromString($denominator));
        }

        if ($interface instanceof BigNumber) {
            return BigInteger::fromString('0')->sub($interface)->add($this);
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
            $numerator = \bcmul($this->numerator->getNumber(), $interface->numerator->getNumber());
            $denominator = \bcmul($this->denominator->getNumber(), $interface->denominator->getNumber());

            return new BigFraction(BigInteger::fromString($numerator), BigInteger::fromString($denominator));
        }

        if ($interface instanceof BigNumber) {
            return $this->multiplyBy($interface->toBigFraction());
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
        if ($interface instanceof BigFraction) {
            return $this->multiplyBy(new BigFraction(clone $interface->denominator, clone $interface->numerator));
        }

        if ($interface instanceof BigNumber) {
            return $this->divideBy($interface->toBigFraction());
        }

        throw new OperationException(
            \sprintf('Operation not implemented with object `%s`', \get_class($interface))
        );
    }

    public function getNumerator(): BigInteger
    {
        return $this->numerator;
    }

    public function getDenominator(): BigInteger
    {
        return $this->denominator;
    }

    /**
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     */
    protected function reduce(): void
    {
        while (null !== ($divider = $this->findCommonFactor())) {
            $this->numerator = BigInteger::fromString(\bcdiv($this->numerator->getNumber(), $divider));
            $this->denominator = BigInteger::fromString(\bcdiv($this->denominator->getNumber(), $divider));
        }
    }

    protected function findCommonFactor(): ?string
    {
        $list = ['11', '7', '5', '3', '2'];
        foreach ($list as $divider) {
            if ('0' === \bcmod($this->numerator->getNumber(), $divider) &&
                '0' === \bcmod($this->denominator->getNumber(), $divider)
            ) {
                return $divider;
            }
        }

        return null;
    }
}
