<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/mathoraptor/blob/master/LICENSE.md Apache License 2.0
 * @link https://github.com/MockingMagician/mathoraptor/blob/master/README.md
 */

namespace MockingMagician\Mathoraptor\Operation;


interface BasicOperationsInterface
{
    public function add(BasicOperationsInterface $interface): BasicOperationsInterface;

    public function sub(BasicOperationsInterface $interface): BasicOperationsInterface;

    public function multiplyBy(BasicOperationsInterface $interface): BasicOperationsInterface;

    public function divideBy(BasicOperationsInterface $interface): BasicOperationsInterface;
}
