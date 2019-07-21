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
use MockingMagician\Mathoraptor\Number\BigNumber;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\OutputMode;
use PhpBench\Benchmark\Metadata\Annotations\OutputTimeUnit;
use PhpBench\Benchmark\Metadata\Annotations\ParamProviders;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

/**
 * @Iterations(5)
 * @OutputTimeUnit("milliseconds")
 * @OutputMode("throughput")
 */
class BigNumberBench extends AbstractNumberProvider
{
    private $bn1;
    private $bn2;
    private $bi1;
    private $bf1;

    /**
     * BigNumberBench constructor.
     *
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     * @throws \Exception
     */
    public function __construct()
    {
        $this->bn1 = $this->provideBigNumber();
        $this->bn2 = $this->provideBigNumber();
        $this->bi1 = $this->provideBigInteger();
        $this->bf1 = $this->provideBigFraction();
    }

    /**
     * @throws \Exception
     *
     * @return \Generator
     */
    public function provideForBenchInstance(): \Generator
    {
        yield [$this->provideNumberString()->current()];
    }

    /**
     * @ParamProviders({"provideForBenchInstance"})
     * @Revs(1000)
     *
     * @param array $number
     *
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     */
    public function bench instance(array $number): void
    {
        BigNumber::fromString($number[0]);
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
        $this->bn1->add($this->bn2);
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
        $this->bn1->add($this->bi1);
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
        $this->bn1->add($this->bf1);
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
        $this->bn1->sub($this->bn2);
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
        $this->bn1->sub($this->bi1);
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
        $this->bn1->sub($this->bf1);
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
        $this->bn1->multiplyBy($this->bn2);
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
        $this->bn1->multiplyBy($this->bi1);
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
        $this->bn1->multiplyBy($this->bf1);
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
        $this->bn1->divideBy($this->bn2);
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
        $this->bn1->divideBy($this->bi1);
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
        $this->bn1->divideBy($this->bf1);
    }
}
