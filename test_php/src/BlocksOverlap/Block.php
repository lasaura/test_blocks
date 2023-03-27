<?php

namespace App\BlocksOverlap;

use App\BlocksOverlap\Exception\BlockIsNotRectangleException;

class Block
{
    //bloque un longitud variable > 1 y la anchura es 1 siempre
    //validar tambien las orientacion con las constantes
    const HORIZONTAL_ORIENTATION = 'h';
    const VERTICAL_ORIENTATION = 'v';
    private int $id;
    private string $orientation;
    private int $x;
    private int $y;
    private int $blockLength;

    public function __construct(int $id, string $orientation, int $x, int $y, int $blockLength)
    {

        if ($blockLength <= 1){
            throw BlockIsNotRectangleException::msg($blockLength);
        }

        $this->x           = $x;
        $this->y           = $y;
        $this->id          = $id;
        $this->blockLength = $blockLength;
        $this->orientation = $orientation;
    }


    public function range(): array
    {
        $orientation = $this->getOrientation() === self::VERTICAL_ORIENTATION ?
            self::VERTICAL_ORIENTATION : self::HORIZONTAL_ORIENTATION;

        //v

        $initialPosition = $orientation === self::HORIZONTAL_ORIENTATION ? $this->getX() : $this->getY();
        //3

        $otherPosition = $orientation === self::HORIZONTAL_ORIENTATION ? $this->getY() : $this->getX();
        //2

        $otherOrientationKey = $orientation === self::HORIZONTAL_ORIENTATION ? self::VERTICAL_ORIENTATION : self::HORIZONTAL_ORIENTATION;
        //h

        $range = [];

        if ($orientation === self::HORIZONTAL_ORIENTATION) {
            $range[0] = [$orientation => range($initialPosition, $initialPosition + ($this->getBlockLength() - 1))];
            $range[1] = [$otherOrientationKey => [$otherPosition]];
        } else {
            $range[0] = [$otherOrientationKey => [$otherPosition]];
            $range[1] = [$orientation => range($initialPosition, $initialPosition + ($this->getBlockLength() - 1))];
        }

        return $range;

    }

    /**
     * @return int
     */
    private function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getOrientation(): string
    {
        return $this->orientation;
    }

    /**
     * @return int
     */
    private function getX(): int
    {
        return $this->x;
    }

    /**
     * @return int
     */
    private function getY(): int
    {
        return $this->y;
    }

    /**
     * @return int
     */
    private function getBlockLength(): int
    {
        return $this->blockLength;
    }
}