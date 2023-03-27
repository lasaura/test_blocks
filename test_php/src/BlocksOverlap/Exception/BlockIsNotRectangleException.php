<?php

namespace App\BlocksOverlap\Exception;

class BlockIsNotRectangleException extends \Exception
{
    public static function msg(int $blockLength): self
    {
        return new self("Block needs to be a rectangle invalid block length $blockLength");
    }
}