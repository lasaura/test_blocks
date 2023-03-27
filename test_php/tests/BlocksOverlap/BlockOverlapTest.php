<?php

namespace App\Tests\BlocksOverlap;

use App\BlocksOverlap\Block;
use App\BlocksOverlap\BlockInputDto;
use App\BlocksOverlap\Exception\BlockIsNotRectangleException;
use App\BlocksOverlap\Exception\InvalidBlocksIdException;
use App\BlocksOverlap\Matrix;
use PHPUnit\Framework\TestCase;


class BlockOverlapTest extends TestCase
{
    public function testCanCreateBlockAndGetXandYarrayOfRanges()
    {
        //Input: 0 h 2 3 5 1 v 4 1 5;

        $block = new Block(0, 'h', 2, 3, 5);

        $range = $block->range();

        $this->assertIsArray($range);

        $this->assertArrayHasKey('h', $range[0]);
        $this->assertArrayHasKey('v', $range[1]);

        $this->assertEquals(2, $range[0]['h'][0]);
        $this->assertEquals(3, $range[0]['h'][1]);
        $this->assertEquals(4, $range[0]['h'][2]);
        $this->assertEquals(5, $range[0]['h'][3]);
        $this->assertEquals(6, $range[0]['h'][4]);

        $this->assertEquals(3, $range[1]['v'][0]);
    }

    public function testWip()
    {
        //Commented inputs are tested below
        $positions = [
          //'0 h 2 3 5 1 v 3 1 1'  => false,
          //'0 h 2 3 1 1 h 2 3 1'  => true,
            '0 h 2 3 5 1 h 3 3 2'  => true,
            '0 h 2 3 5 1 h 4 1 2'  => true,
            '0 h 2 3 5 1 v 3 1 3'  => true,
            '0 h 8 7 2 1 v 10 7 6' => false,
            '0 h 2 3 5 1 v 3 1 2'  => false,
          //'0 h 4 3 3 2 v 6 2 2'  => true,
            '0 v 3 3 2 1 v 3 5 2'  => false,
            '0 h 1 3 2 1 h 5 3 2'  => false
        ];

        foreach ($positions as $positionInput => $result) {
            $matrix = new Matrix(new BlockInputDto($positionInput));
            $this->assertEquals($result,$matrix->overlap());

        }

    }

    public function testIfBlockIsNotRectangleShouldThrowBlockIsNotRectangleException()
    {
        $this->expectException(BlockIsNotRectangleException::class);
        new Matrix(new BlockInputDto('0 h 2 3 5 1 v 3 1 1'));

        $this->expectException(BlockIsNotRectangleException::class);
        new Matrix(new BlockInputDto('0 h 2 3 1 1 h 2 3 1'));
    }

    public function testIfBlockHaveInvalidIdValueShouldThrowBlockIdException()
    {
        $this->expectException(InvalidBlocksIdException::class);
        new Matrix(new BlockInputDto('0 h 4 3 3 2 v 6 2 2'));
    }
}