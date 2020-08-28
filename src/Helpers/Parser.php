<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/mathoraptor/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/MockingMagician/mathoraptor/blob/master/README.md
 */

namespace MockingMagician\Mathoraptor\Helpers;

use MockingMagician\Mathoraptor\Exceptions\ArgumentNotMatchPatternException;
use MockingMagician\Mathoraptor\Exceptions\ParseNumberException;
use MockingMagician\Mathoraptor\Helpers\DTO\ParsedNumber;

/**
 * Class Parser.
 */
final class Parser
{
    /** @var ParsedNumber */
    public $parsedNumber;

    /**
     * @throws ParseNumberException
     * @throws ArgumentNotMatchPatternException
     */
    private function __construct(string $number)
    {
        if (!\preg_match(Constants::PARSE_NUMBER_PATTERN, $number, $matches)) {
            throw new ParseNumberException($number);
        }

        $default = [$sign = '+', $integer = '0', $decimal = '0', $exponentSign = '+', $exponent = 0];

        for ($i = 1; $i <= 5; ++$i) {
            if (isset($matches[$i])) {
                if ('' !== $matches[$i]) {
                    $default[$i - 1] = $matches[$i];
                    if (4 === $i - 1) {
                        $default[$i - 1] = (int) $default[$i - 1];
                    }
                }
            }
        }

        $this->parsedNumber = new ParsedNumber(...$default);
    }

    /**
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     */
    public static function parseNumber(string $integerOrFloatLike): string
    {
        $self = new self($integerOrFloatLike);

        return $self->parsedNumber->getLiteral();
    }
}
