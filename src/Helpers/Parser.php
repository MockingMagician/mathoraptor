<?php

declare(strict_types=1);

namespace MockingMagician\Mathoraptor\Helpers;


use MockingMagician\Mathoraptor\Exceptions\ArgumentNotMatchPatternException;
use MockingMagician\Mathoraptor\Exceptions\ParseNumberException;
use MockingMagician\Mathoraptor\Helpers\DTO\ParsedNumber;

final class Parser
{
    /** @var ParsedNumber */
    public $parsedNumber;

    /**
     * @param string $number
     *
     * @throws ParseNumberException
     * @throws ArgumentNotMatchPatternException
     */
    private function __construct(string $number)
    {
        if (!preg_match(Constants::PARSE_NUMBER_PATTERN, $number, $matches)) {
            throw new ParseNumberException($number);
        }

        $default = [$sign = '+', $integer = '0', $decimal = '0', $exponentSign = '+', $exponent = 0];

        for ($i = 0; $i < 5; $i++) {
            if (isset($matches[$i])) {
                if ('' !== $matches[$i]) {
                    $default[$i] = $matches[$i];
                    if (4 === $i) {
                        $default[$i] = (int) $default[$i];
                    }
                }
            }
        }

        $this->parsedNumber = new ParsedNumber(...$default);
    }

    /**
     * @param string $integerOrFloatLike
     * @return string
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     */
    public static function parseNumber(string $integerOrFloatLike): string
    {
        $self = new self($integerOrFloatLike);

        return $self->parsedNumber->getLiteral();
    }
}
