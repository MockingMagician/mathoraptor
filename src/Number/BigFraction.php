<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/mathoraptor/blob/master/LICENSE.md Apache License 2.0
 * @link https://github.com/MockingMagician/mathoraptor/blob/master/README.md
 */

namespace MockingMagician\Mathoraptor\Number;

use MockingMagician\Mathoraptor\Exceptions\ArgumentNotMatchPatternException;
use MockingMagician\Mathoraptor\Exceptions\ParseNumberException;
use MockingMagician\Mathoraptor\Operation\BasicOperationsInterface;

class BigFraction implements BasicOperationsInterface
{
    private $numerator;
    private $denominator;

    public function __construct(BigInteger $numerator, BigInteger $denominator)
    {
        $this->numerator = $numerator;
        $this->denominator = $denominator;
        $this->reduce();
    }

    public function add(BasicOperationsInterface $interface): BasicOperationsInterface
    {
        // TODO: Implement add() method.
    }

    public function sub(BasicOperationsInterface $interface): BasicOperationsInterface
    {
        // TODO: Implement sub() method.
    }

    public function multiplyBy(BasicOperationsInterface $interface): BasicOperationsInterface
    {
        // TODO: Implement multiplyBy() method.
    }

    public function divideBy(BasicOperationsInterface $interface): BasicOperationsInterface
    {
        // TODO: Implement divideBy() method.
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
