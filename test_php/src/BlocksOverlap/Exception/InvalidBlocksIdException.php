<?php

namespace App\BlocksOverlap\Exception;

class InvalidBlocksIdException extends \Exception
{
    public static function msg(): self
    {
        return new self('Invalid block Id , must be 0 for first and 1 for second');
    }
}