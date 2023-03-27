<?php

namespace App\BlocksOverlap;

class BlockInputDto
{
    private int $firstBlockId;
    private string $firstBlockOrientation;
    private int $firstBlockX;
    private int $firstBlockY;
    private int $firstBlockLength;

    private int $secondBlockId;
    private string $secondBlockOrientation;
    private int $secondBlockX;
    private int $secondBlockY;
    private int $secondBlockLength;

    public function __construct(string $blockInput)
    {
        $blockInput = explode(' ', $blockInput);

        $this->firstBlockId          = $blockInput[0];
        $this->firstBlockOrientation = $blockInput[1];
        $this->firstBlockX           = $blockInput[2];
        $this->firstBlockY           = $blockInput[3];
        $this->firstBlockLength      = $blockInput[4];

        $this->secondBlockId          = $blockInput[5];
        $this->secondBlockOrientation = $blockInput[6];
        $this->secondBlockX           = $blockInput[7];
        $this->secondBlockY           = $blockInput[8];
        $this->secondBlockLength      = $blockInput[9];
    }

    public function getFirstId(): int
    {
        return $this->firstBlockId;
    }

    public function getSecondId(): int
    {
        return $this->secondBlockId;
    }

    public function getFirstBlockOrientation(): string
    {
        return $this->firstBlockOrientation;
    }

    public function getSecondBlockOrientation(): string
    {
        return $this->secondBlockOrientation;
    }

    public function getFirstBlockX(): int
    {
        return $this->firstBlockX;
    }

    public function getSecondBlockX(): int
    {
        return $this->secondBlockX;
    }


    public function getFirstBlockY(): int
    {
        return $this->firstBlockY;
    }

    public function getSecondBlockY(): int
    {
        return $this->secondBlockY;
    }

    public function getFirstBlockLength(): int
    {
        return $this->firstBlockLength;
    }

    public function getSecondBlockLength(): int
    {
        return $this->secondBlockLength;
    }

}