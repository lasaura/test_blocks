<?php

namespace App\BlocksOverlap;

use App\BlocksOverlap\Exception\InvalidBlocksIdException;

class Matrix
{
    //Check id's validate they are not the same

    private Block $block;
    private Block $anotherBlock;

    public function __construct(BlockInputDto $blockInputDto)
    {

        if($blockInputDto->getFirstId()!==0 || $blockInputDto->getSecondId()!==1){
            throw InvalidBlocksIdException::msg();

        }
        $this->block        = new Block(
            $blockInputDto->getFirstId(),
            $blockInputDto->getFirstBlockOrientation(),
            $blockInputDto->getFirstBlockX(),
            $blockInputDto->getFirstBlockY(),
            $blockInputDto->getFirstBlockLength()
        );
        //Verify id
        $this->anotherBlock = new Block(
            $blockInputDto->getSecondId(),
            $blockInputDto->getSecondBlockOrientation(),
            $blockInputDto->getSecondBlockX(),
            $blockInputDto->getSecondBlockY(),
            $blockInputDto->getSecondBlockLength()
        );
    }

    public function overlap(): bool
    {
        $firstBlockRanges  = $this->block->range();
        $secondBlockRanges = $this->anotherBlock->range();

        $isHoverlappedBetweenFirstBlockAndSecondBlock = false;
        $isVoverlappedBetweenFirstBlockAndSecondBlock = false;

        foreach ($firstBlockRanges as $index => $firstBlockRange) {

            foreach ($firstBlockRange as $axis => $positions) {

                foreach ($positions as $position) {

                    if (in_array($position, $secondBlockRanges[$index][$axis])) {

                        if ($axis === 'h') {
                            $isHoverlappedBetweenFirstBlockAndSecondBlock = true;
                        } else if ($axis === 'v') {
                            $isVoverlappedBetweenFirstBlockAndSecondBlock = true;
                        }

                    }
                }

            }
        }

        if ($this->block->getOrientation() !== $this->anotherBlock->getOrientation()) {
            return $isHoverlappedBetweenFirstBlockAndSecondBlock === true
                && $isVoverlappedBetweenFirstBlockAndSecondBlock === true;
        }

        if($this->block->getOrientation() === Block::HORIZONTAL_ORIENTATION &&
            $this->anotherBlock->getOrientation() === Block::HORIZONTAL_ORIENTATION){
            return $isHoverlappedBetweenFirstBlockAndSecondBlock === true;
        }else{
            return $isVoverlappedBetweenFirstBlockAndSecondBlock === true;
        }


    }
}