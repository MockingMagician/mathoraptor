<?php

namespace MockingMagician\Mathoraptor\Number;


use MockingMagician\Mathoraptor\Operation\BasicOperationsInterface;

class BigFraction implements BasicOperationsInterface
{
    private $numerator;
    private $denominator;

    public function __construct(BigInteger $numerator, BigInteger $denominator)
    {
        $this->numerator = $numerator;
        $this->denominator = $denominator;
    }

    public function plusThat(BasicOperationsInterface $interface): BasicOperationsInterface
    {
        // TODO: Implement plusThat() method.
    }

    public function minusThat(BasicOperationsInterface $interface): BasicOperationsInterface
    {
        // TODO: Implement minusThat() method.
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