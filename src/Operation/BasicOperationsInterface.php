<?php

namespace MockingMagician\Mathoraptor\Operation;


interface BasicOperationsInterface
{
    public function plusThat(BasicOperationsInterface $interface): BasicOperationsInterface;
    public function minusThat(BasicOperationsInterface $interface): BasicOperationsInterface;
    public function multiplyBy(BasicOperationsInterface $interface): BasicOperationsInterface;
    public function divideBy(BasicOperationsInterface $interface): BasicOperationsInterface;
}