<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/mathoraptor/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/MockingMagician/mathoraptor/blob/master/README.md
 */

namespace MockingMagician\Mathoraptor\Benchmarks;

use Exception;
use Generator;
use MockingMagician\Mathoraptor\Exceptions\ArgumentNotMatchPatternException;
use MockingMagician\Mathoraptor\Exceptions\ParseNumberException;
use MockingMagician\Mathoraptor\Number\BigFraction;
use MockingMagician\Mathoraptor\Number\BigInteger;
use MockingMagician\Mathoraptor\Number\BigNumber;
use function mb_strlen;
use function random_int;

abstract class AbstractNumberProvider
{
    /**
     * @throws Exception
     *
     * @return Generator
     */
    public function provideIntegerString(): Generator
    {
        $papMaxIntLength = mb_strlen((string) PHP_INT_MAX);

        while (true) {
            $sign = 0 === random_int(0, 1) ? '+' : '-';
            $integer = '';
            while ($papMaxIntLength * 2 > mb_strlen($integer)) {
                $integer .= (string) random_int(0, PHP_INT_MAX);
            }

            yield $sign.$integer;
        }
    }

    /**
     * @throws Exception
     *
     * @return Generator
     */
    public function provideNumberString(): Generator
    {
        $papMaxIntLength = mb_strlen((string) PHP_INT_MAX);

        while (true) {
            $integer = '';
            while ($papMaxIntLength * 2 > mb_strlen($integer)) {
                $integer .= (string) random_int(0, PHP_INT_MAX);
            }

            yield $this->provideIntegerString()->current().'.'.$integer;
        }
    }

    /**
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     * @throws Exception
     *
     * @return BigNumber
     */
    public function provideBigNumber(): BigNumber
    {
        return BigNumber::fromString($this->provideNumberString()->current());
    }

    /**
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     * @throws Exception
     *
     * @return BigInteger
     */
    public function provideBigInteger(): BigInteger
    {
        return BigInteger::fromString($this->provideIntegerString()->current());
    }

    /**
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     * @throws Exception
     *
     * @return BigFraction
     */
    public function provideBigFraction(): BigFraction
    {
        return new BigFraction($this->provideBigInteger(), $this->provideBigInteger());
    }
}
