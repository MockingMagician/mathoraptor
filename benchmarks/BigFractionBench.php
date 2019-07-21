<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/mathoraptor/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/MockingMagician/mathoraptor/blob/master/README.md
 */

namespace MockingMagician\Mathoraptor\Benchmarks;

use MockingMagician\Mathoraptor\Exceptions\ArgumentNotMatchPatternException;
use MockingMagician\Mathoraptor\Exceptions\OperationException;
use MockingMagician\Mathoraptor\Exceptions\ParseNumberException;
use MockingMagician\Mathoraptor\Number\BigFraction;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\OutputMode;
use PhpBench\Benchmark\Metadata\Annotations\OutputTimeUnit;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

/**
 * @Iterations(5)
 * @OutputTimeUnit("milliseconds")
 * @OutputMode("throughput")
 */
class BigFractionBench extends AbstractNumberProvider
{
    private $bn1;
    private $bi1;
    private $bi2;
    private $bi3;
    private $bf1;
    private $bf2;

    /**
     * BigNumberBench constructor.
     *
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     */
    public function __construct()
    {
        $this->bn1 = $this->provideBigNumber();
        $this->bi1 = $this->provideBigInteger();
        $this->bi2 = $this->provideBigInteger();
        $this->bi3 = $this->provideBigInteger();
        $this->bf1 = $this->provideBigFraction();
        $this->bf2 = $this->provideBigFraction();
    }

    /**
     * @Revs(1000)
     *
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     */
    public function bench instance(): void
    {
        new BigFraction($this->bi1, $this->bi2);
    }

    /**
     * @Revs(1000)
     *
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     * @throws OperationException
     */
    public function bench add big number(): void
    {
        $this->bf1->add($this->bn1);
    }

    /**
     * @Revs(1000)
     *
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     * @throws OperationException
     */
    public function bench add big integer(): void
    {
        $this->bf1->add($this->bi3);
    }

    /**
     * @Revs(1000)
     *
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     * @throws OperationException
     */
    public function bench add big fraction(): void
    {
        $this->bf1->add($this->bf2);
    }

    /**
     * @Revs(1000)
     *
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     * @throws OperationException
     */
    public function bench sub big number(): void
    {
        $this->bf1->sub($this->bn1);
    }

    /**
     * @Revs(1000)
     *
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     * @throws OperationException
     */
    public function bench sub big integer(): void
    {
        $this->bf1->sub($this->bi3);
    }

    /**
     * @Revs(1000)
     *
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     * @throws OperationException
     */
    public function bench sub big fraction(): void
    {
        $this->bf1->sub($this->bf2);
    }

    /**
     * @Revs(1000)
     *
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     * @throws OperationException
     */
    public function bench multiplyBy big number(): void
    {
        $this->bf1->multiplyBy($this->bn1);
    }

    /**
     * @Revs(1000)
     *
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     * @throws OperationException
     */
    public function bench multiplyBy big integer(): void
    {
        $this->bf1->multiplyBy($this->bi3);
    }

    /**
     * @Revs(1000)
     *
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     * @throws OperationException
     */
    public function bench multiplyBy big fraction(): void
    {
        $this->bf1->multiplyBy($this->bf2);
    }

    /**
     * @Revs(1000)
     *
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     * @throws OperationException
     */
    public function bench divideBy big number(): void
    {
        $this->bf1->divideBy($this->bn1);
    }

    /**
     * @Revs(1000)
     *
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     * @throws OperationException
     */
    public function bench divideBy big integer(): void
    {
        $this->bf1->divideBy($this->bi3);
    }

    /**
     * @Revs(1000)
     *
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     * @throws OperationException
     */
    public function bench divideBy big fraction(): void
    {
        $this->bf1->divideBy($this->bf2);
    }
}
