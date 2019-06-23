<?php

namespace MockingMagician\Mathoraptor\Exceptions;


use Throwable;

class ArgumentNotMatchPatternException extends \Exception
{
    public function __construct(string $argumentInStringFormat, string $pattern, int $code = 0, Throwable $previous = null)
    {
        $message = sprintf('Argument `%s` does not match pattern `%s`', $argumentInStringFormat, $pattern);
        parent::__construct($message, $code, $previous);
    }
}
