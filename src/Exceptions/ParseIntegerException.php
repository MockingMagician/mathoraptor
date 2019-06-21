<?php

namespace MockingMagician\Mathoraptor\Exceptions;


use Throwable;

class ParseIntegerException extends \Exception
{

    public function __construct(string $parsedInt, int $code = 0, Throwable $previous = null)
    {
        $message = sprintf('Can not parse `%s` to integer.', $parsedInt);
        parent::__construct($message, $code, $previous);
    }
}
