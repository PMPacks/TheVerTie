<?php

namespace MyPlot;

use pocketmine\math\Vector3;
use pocketmine\level\ChunkManager;
use pocketmine\block\Block;
use pocketmine\level\generator\populator\Populator;
use pocketmine\utils\Random;
use pocketmine\level\generator\Generator;
use pocketmine\level\format\Chunk;

class SkyBlockStructure extends Populator{
	public $generator = null;

	public function __construct(Generator $gen){
		$this->generator = $gen;
	}

	/**
	 *
	 * @param ChunkManager $level 
	 * @param Chunk $chunk 
	 * @param int $Xofchunk 
	 * @param int $Zofchunk 
	 */
	public static function placeObject(ChunkManager $level, $chunk, $Xofchunk, $Zofchunk){
		$vec = new Vector3($chunk->getX() * 16 + $Xofchunk, 0, $chunk->getZ() * 16 + $Zofchunk);	
		$vec = $vec->subtract(7, 0, 7);
       # 3 0 6
       $level->setBlockIdAt($vec->x + 3, 64, $vec->z + 6, Block::STONE);
       $level->setBlockIdAt($vec->x + 3, 63, $vec->z + 6, Block::STONE);
       $level->setBlockIdAt($vec->x + 3, 62, $vec->z + 6, Block::STONE);
       # 3 0 7
       $level->setBlockIdAt($vec->x + 3, 65, $vec->z + 7, Block::TALL_GRASS);
       $level->setBlockIdAt($vec->x + 3, 64, $vec->z + 7, Block::GRASS);
       $level->setBlockIdAt($vec->x + 3, 63, $vec->z + 7, Block::STONE);
       $level->setBlockIdAt($vec->x + 3, 62, $vec->z + 7, Block::STONE); 
       $level->setBlockIdAt($vec->x + 3, 61, $vec->z + 7, Block::STONE);
       # 3 0 8
       $level->setBlockIdAt($vec->x + 3, 64, $vec->z + 8, Block::STONE);
       $level->setBlockIdAt($vec->x + 3, 63, $vec->z + 8, Block::STONE);
       $level->setBlockIdAt($vec->x + 3, 62, $vec->z + 8, Block::STONE);
       # 4 0 4
       $level->setBlockIdAt($vec->x + 4, 64, $vec->z + 4, Block::GRASS);
       # 4 0 5
       $level->setBlockIdAt($vec->x + 4, 65, $vec->z + 5, Block::TALL_GRASS);
       $level->setBlockIdAt($vec->x + 4, 64, $vec->z + 5, Block::GRASS);
       $level->setBlockIdAt($vec->x + 4, 63, $vec->z + 5, Block::STONE);
       $level->setBlockIdAt($vec->x + 4, 62, $vec->z + 5, Block::STONE);
       # 4 0 6
       $level->setBlockIdAt($vec->x + 4, 64, $vec->z + 6, Block::STONE);
       $level->setBlockIdAt($vec->x + 4, 63, $vec->z + 6, Block::STONE);
       $level->setBlockIdAt($vec->x + 4, 62, $vec->z + 6, Block::STONE);
       $level->setBlockIdAt($vec->x + 4, 61, $vec->z + 6, Block::STONE);
       $level->setBlockIdAt($vec->x + 4, 60, $vec->z + 6, Block::STONE);
       # 4 0 7
       $level->setBlockIdAt($vec->x + 4, 65, $vec->z + 7, Block::TALL_GRASS);
       $level->setBlockIdAt($vec->x + 4, 64, $vec->z + 7, Block::GRASS);
       $level->setBlockIdAt($vec->x + 4, 63, $vec->z + 7, Block::STONE);
       $level->setBlockIdAt($vec->x + 4, 62, $vec->z + 7, Block::IRON_ORE);
       $level->setBlockIdAt($vec->x + 4, 61, $vec->z + 7, Block::STONE);
       $level->setBlockIdAt($vec->x + 4, 60, $vec->z + 7, Block::STONE);
       # 4 0 8
       $level->setBlockIdAt($vec->x + 4, 64, $vec->z + 8, Block::DIRT);
       $level->setBlockIdAt($vec->x + 4, 63, $vec->z + 8, Block::STONE);
       $level->setBlockIdAt($vec->x + 4, 62, $vec->z + 8, Block::STONE);
       $level->setBlockIdAt($vec->x + 4, 61, $vec->z + 8, Block::STONE);
       $level->setBlockIdAt($vec->x + 4, 60, $vec->z + 8, Block::STONE);
       # 4 0 9
       $level->setBlockIdAt($vec->x + 4, 64, $vec->z + 9, Block::GRASS);
       $level->setBlockIdAt($vec->x + 4, 63, $vec->z + 9, Block::STONE);
       $level->setBlockIdAt($vec->x + 4, 62, $vec->z + 9, Block::STONE);
       $level->setBlockIdAt($vec->x + 4, 61, $vec->z + 9, Block::STONE);
       # 5 0 3
	   $level->setBlockIdAt($vec->x + 5, 64, $vec->z + 3, Block::GRASS);
		$level->setBlockIdAt($vec->x + 5, 65, $vec->z + 3, Block::HAY_BALE);
       # 5 0 4
       $level->setBlockIdAt($vec->x + 5, 64, $vec->z + 4, Block::STONE);
       $level->setBlockIdAt($vec->x + 5, 63, $vec->z + 4, Block::STONE);
       # 5 0 5
       $level->setBlockIdAt($vec->x + 5, 64, $vec->z + 5, Block::GRASS);
       $level->setBlockIdAt($vec->x + 5, 63, $vec->z + 5, Block::STONE);
       $level->setBlockIdAt($vec->x + 5, 62, $vec->z + 5, Block::STONE);
       $level->setBlockIdAt($vec->x + 5, 61, $vec->z + 5, Block::STONE);
       # 5 0 6
       $level->setBlockIdAt($vec->x + 5, 64, $vec->z + 6, Block::GRASS);
       $level->setBlockIdAt($vec->x + 5, 63, $vec->z + 6, Block::STONE);
       $level->setBlockIdAt($vec->x + 5, 62, $vec->z + 6, Block::STONE);
       $level->setBlockIdAt($vec->x + 5, 61, $vec->z + 6, Block::STONE);
       # 5 0 7
       $level->setBlockIdAt($vec->x + 5, 64, $vec->z + 7, Block::GRASS);
       $level->setBlockIdAt($vec->x + 5, 63, $vec->z + 7, Block::STONE);
       $level->setBlockIdAt($vec->x + 5, 62, $vec->z + 7, Block::STONE);
       $level->setBlockIdAt($vec->x + 5, 61, $vec->z + 7, Block::STONE);
       $level->setBlockIdAt($vec->x + 5, 60, $vec->z + 7, Block::STONE);
       $level->setBlockIdAt($vec->x + 5, 59, $vec->z + 7, Block::STONE);
       # 5 0 8
       $level->setBlockIdAt($vec->x + 5, 65, $vec->z + 8, Block::TALL_GRASS);
       $level->setBlockIdAt($vec->x + 5, 64, $vec->z + 8, Block::GRASS);
       $level->setBlockIdAt($vec->x + 5, 63, $vec->z + 8, Block::STONE);
       $level->setBlockIdAt($vec->x + 5, 62, $vec->z + 8, Block::STONE);
       $level->setBlockIdAt($vec->x + 5, 61, $vec->z + 8, Block::STONE);
       # 5 0 9
       $level->setBlockIdAt($vec->x + 5, 64, $vec->z + 9, Block::STONE);
       $level->setBlockIdAt($vec->x + 5, 63, $vec->z + 9, Block::STONE);
       $level->setBlockIdAt($vec->x + 5, 62, $vec->z + 9, Block::STONE);
       $level->setBlockIdAt($vec->x + 5, 61, $vec->z + 9, Block::STONE);
       $level->setBlockIdAt($vec->x + 5, 64, $vec->z + 9, Block::STONE);
       # 5 0 10
       $level->setBlockIdAt($vec->x + 5, 65, $vec->z + 10, Block::FENCE);
       $level->setBlockIdAt($vec->x + 5, 64, $vec->z + 10, Block::GRASS);
       $level->setBlockIdAt($vec->x + 5, 63, $vec->z + 10, Block::STONE);
	   # 6 0 3
	   $level->setBlockIdAt($vec->x + 6, 66, $vec->z + 3, Block::HAY_BALE);
	    $level->setBlockIdAt($vec->x + 6, 65, $vec->z + 3, Block::HAY_BALE);
       # 6 0 4
       $level->setBlockIdAt($vec->x + 6, 64, $vec->z + 4, Block::GRASS);
	   $level->setBlockIdAt($vec->x + 6, 65, $vec->z + 4, Block::HAY_BALE);
       $level->setBlockIdAt($vec->x + 6, 64, $vec->z + 4, Block::STONE);
       $level->setBlockIdAt($vec->x + 6, 63, $vec->z + 4, Block::STONE);
       $level->setBlockIdAt($vec->x + 6, 62, $vec->z + 4, Block::STONE);
       $level->setBlockIdAt($vec->x + 6, 61, $vec->z + 4, Block::STONE);
       # 6 0 5
       $level->setBlockIdAt($vec->x + 6, 64, $vec->z + 5, Block::DIRT);
       $level->setBlockIdAt($vec->x + 6, 63, $vec->z + 5, Block::STONE);
       $level->setBlockIdAt($vec->x + 6, 62, $vec->z + 5, Block::STONE);
       $level->setBlockIdAt($vec->x + 6, 61, $vec->z + 5, Block::STONE);
       $level->setBlockIdAt($vec->x + 6, 60, $vec->z + 5, Block::STONE);
       # 6 0 6
       $level->setBlockIdAt($vec->x + 6, 65, $vec->z + 6, Block::TALL_GRASS);
       $level->setBlockIdAt($vec->x + 6, 64, $vec->z + 6, Block::GRASS);
       $level->setBlockIdAt($vec->x + 6, 63, $vec->z + 6, Block::STONE);
       $level->setBlockIdAt($vec->x + 6, 62, $vec->z + 6, Block::STONE);
       $level->setBlockIdAt($vec->x + 6, 61, $vec->z + 6, Block::STONE);
       $level->setBlockIdAt($vec->x + 6, 60, $vec->z + 6, Block::STONE);
       # 6 0 7
       $level->setBlockIdAt($vec->x + 6, 64, $vec->z + 7, Block::STONE);
       $level->setBlockIdAt($vec->x + 6, 63, $vec->z + 7, Block::STONE);
       $level->setBlockIdAt($vec->x + 6, 62, $vec->z + 7, Block::STONE);
       $level->setBlockIdAt($vec->x + 6, 61, $vec->z + 7, Block::STONE);
       $level->setBlockIdAt($vec->x + 6, 60, $vec->z + 7, Block::STONE);
       $level->setBlockIdAt($vec->x + 6, 59, $vec->z + 7, Block::STONE);
       $level->setBlockIdAt($vec->x + 6, 58, $vec->z + 7, Block::STONE);
       $level->setBlockIdAt($vec->x + 6, 57, $vec->z + 7, Block::STONE);
       $level->setBlockIdAt($vec->x + 6, 56, $vec->z + 7, Block::STONE);
       # 6 0 8
       $level->setBlockIdAt($vec->x + 6, 65, $vec->z + 8, Block::TALL_GRASS);
       $level->setBlockIdAt($vec->x + 6, 64, $vec->z + 8, Block::GRASS);
       $level->setBlockIdAt($vec->x + 6, 63, $vec->z + 8, Block::STONE);
       $level->setBlockIdAt($vec->x + 6, 62, $vec->z + 8, Block::STONE);
       $level->setBlockIdAt($vec->x + 6, 61, $vec->z + 8, Block::STONE);
       $level->setBlockIdAt($vec->x + 6, 60, $vec->z + 8, Block::STONE);
       $level->setBlockIdAt($vec->x + 6, 59, $vec->z + 8, Block::STONE);
       $level->setBlockIdAt($vec->x + 6, 58, $vec->z + 8, Block::STONE);
       $level->setBlockIdAt($vec->x + 6, 57, $vec->z + 8, Block::STONE);
       # 6 0 9
       $level->setBlockIdAt($vec->x + 6, 64, $vec->z + 9, Block::GRASS);
       $level->setBlockIdAt($vec->x + 6, 63, $vec->z + 9, Block::STONE);
       $level->setBlockIdAt($vec->x + 6, 62, $vec->z + 9, Block::STONE);
       $level->setBlockIdAt($vec->x + 6, 61, $vec->z + 9, Block::STONE);
       $level->setBlockIdAt($vec->x + 6, 60, $vec->z + 9, Block::STONE);
       # 6 0 10
       $level->setBlockIdAt($vec->x + 6, 65, $vec->z + 10, Block::FENCE);
       $level->setBlockIdAt($vec->x + 8, 64, $vec->z + 10, Block::FARMLAND);
       $level->setBlockIdAt($vec->x + 6, 64, $vec->z + 10, Block::STONE);
       $level->setBlockIdAt($vec->x + 6, 63, $vec->z + 10, Block::STONE);
       $level->setBlockIdAt($vec->x + 6, 62, $vec->z + 10, Block::STONE);
       # 6 0 11
       $level->setBlockIdAt($vec->x + 6, 65, $vec->z + 11, Block::WHEAT_BLOCK);
       $level->setBlockIdAt($vec->x + 6, 64, $vec->z + 11, Block::FARMLAND);
       # 6 0 12
       $level->setBlockIdAt($vec->x + 6, 65, $vec->z + 12, Block::WHEAT_BLOCK);
       $level->setBlockIdAt($vec->x + 6, 64, $vec->z + 12, Block::FARMLAND);
       # 7 0 3
       $level->setBlockIdAt($vec->x + 7, 65, $vec->z + 3, Block::TALL_GRASS); 
       $level->setBlockIdAt($vec->x + 7, 64, $vec->z + 3, Block::GRASS); 
       # 7 0 4
      $level->setBlockIdAt($vec->x + 7, 64, $vec->z + 4, Block::STONE); 
      $level->setBlockIdAt($vec->x + 7, 63, $vec->z + 4, Block::STONE); 
       # 7 0 5
      $level->setBlockIdAt($vec->x + 7, 65, $vec->z + 5, Block::MELON_BLOCK); 
      $level->setBlockIdAt($vec->x + 7, 64, $vec->z + 5, Block::GRASS); 
      $level->setBlockIdAt($vec->x + 7, 63, $vec->z + 5, Block::STONE); 
      $level->setBlockIdAt($vec->x + 7, 62, $vec->z + 5, Block::STONE); 
      $level->setBlockIdAt($vec->x + 7, 61, $vec->z + 5, Block::STONE);
       # 7 0 6
      $level->setBlockIdAt($vec->x + 7, 65, $vec->z + 6, Block::TALL_GRASS); 
      $level->setBlockIdAt($vec->x + 7, 64, $vec->z + 6, Block::GRASS); 
      $level->setBlockIdAt($vec->x + 7, 63, $vec->z + 6, Block::IRON_ORE);
      $level->setBlockIdAt($vec->x + 7, 62, $vec->z + 6, Block::STONE); 
      $level->setBlockIdAt($vec->x + 7, 61, $vec->z + 6, Block::STONE); 
      $level->setBlockIdAt($vec->x + 7, 60, $vec->z + 6, Block::STONE); 
      $level->setBlockIdAt($vec->x + 7, 59, $vec->z + 6, Block::STONE); 
      $level->setBlockIdAt($vec->x + 7, 58, $vec->z + 6, Block::STONE); 
       # 7 0 7
		$level->setBlockIdAt($vec->x + 7, 64, $vec->z + 7, Block::GRASS);
      $level->setBlockIdAt($vec->x + 7, 63, $vec->z + 7, Block::STONE);
      $level->setBlockIdAt($vec->x + 7, 62, $vec->z + 7, Block::STONE);
      $level->setBlockIdAt($vec->x + 7, 61, $vec->z + 7, Block::STONE);
      $level->setBlockIdAt($vec->x + 7, 60, $vec->z + 7, Block::DIAMOND_BLOCK);
      $level->setBlockIdAt($vec->x + 7, 59, $vec->z + 7, Block::STONE);
      $level->setBlockIdAt($vec->x + 7, 58, $vec->z + 7, Block::STONE);
      $level->setBlockIdAt($vec->x + 7, 57, $vec->z + 7, Block::STONE);
       # 7 0 8
	   $level->setBlockIdAt($vec->x + 7, 67, $vec->z + 8, Block::COBWEB);
						
      $level->setBlockIdAt($vec->x + 7, 64, $vec->z + 8, Block::STONE);
      $level->setBlockIdAt($vec->x + 7, 63, $vec->z + 8, Block::STONE);
      $level->setBlockIdAt($vec->x + 7, 62, $vec->z + 8, Block::STONE);
      $level->setBlockIdAt($vec->x + 7, 61, $vec->z + 8, Block::STONE);
      $level->setBlockIdAt($vec->x + 7, 60, $vec->z + 8, Block::DIAMOND_BLOCK);
      $level->setBlockIdAt($vec->x + 7, 59, $vec->z + 8, Block::STONE);
      $level->setBlockIdAt($vec->x + 7, 58, $vec->z + 8, Block::STONE);
       # 7 0 9
       $level->setBlockIdAt($vec->x + 7, 64, $vec->z + 9, Block::STONE);
       $level->setBlockIdAt($vec->x + 7, 63, $vec->z + 9, Block::STONE);
       $level->setBlockIdAt($vec->x + 7, 62, $vec->z + 9, Block::STONE);
       $level->setBlockIdAt($vec->x + 7, 61, $vec->z + 9, Block::STONE);
       $level->setBlockIdAt($vec->x + 7, 60, $vec->z + 9, Block::STONE);
       # 7 0 10
       $level->setBlockIdAt($vec->x + 7, 65, $vec->z + 10, Block::TALL_GRASS);
       $level->setBlockIdAt($vec->x + 7, 64, $vec->z + 10, Block::GRASS);
       $level->setBlockIdAt($vec->x + 7, 63, $vec->z + 10, Block::STONE);  
       $level->setBlockIdAt($vec->x + 7, 62, $vec->z + 10, Block::STONE);  
       $level->setBlockIdAt($vec->x + 7, 61, $vec->z + 10, Block::IRON_ORE);  
       $level->setBlockIdAt($vec->x + 7, 60, $vec->z + 10, Block::STONE);
        # 7 0 11
        $level->setBlockIdAt($vec->x + 7, 65, $vec->z + 11, Block::WHEAT_BLOCK);    
        $level->setBlockIdAt($vec->x + 7, 64, $vec->z + 11, Block::FARMLAND); 
        $level->setBlockIdAt($vec->x + 7, 63, $vec->z + 11, Block::STONE);  
        $level->setBlockIdAt($vec->x + 7, 62, $vec->z + 11, Block::STONE);       
        # 7 0 12
        $level->setBlockIdAt($vec->x + 7, 65, $vec->z + 12, Block::WHEAT_BLOCK); 
        $level->setBlockIdAt($vec->x + 7, 64, $vec->z + 12, Block::FARMLAND); 
        # 8 0 3
        $level->setBlockIdAt($vec->x + 8, 64, $vec->z + 3, Block::DIRT); 
        $level->setBlockIdAt($vec->x + 8, 65, $vec->z + 3, Block::GRASS); 
        $level->setBlockIdAt($vec->x + 8, 66, $vec->z + 3, Block::TALL_GRASS); 
       # 8 0 4
        $level->setBlockIdAt($vec->x + 8, 67, $vec->z + 4, Block::SUGARCANE_BLOCK); 
        $level->setBlockIdAt($vec->x + 8, 66, $vec->z + 4, Block::SUGARCANE_BLOCK); 
        $level->setBlockIdAt($vec->x + 8, 65, $vec->z + 4, Block::SUGARCANE_BLOCK); 
        $level->setBlockIdAt($vec->x + 8, 64, $vec->z + 4, Block::GRASS); 
        $level->setBlockIdAt($vec->x + 8, 63, $vec->z + 4, Block::STONE); 
        # 8 0 5
        $level->setBlockIdAt($vec->x + 8, 64, $vec->z + 5, Block::WATER); 
        $level->setBlockIdAt($vec->x + 8, 63, $vec->z + 5, Block::STONE); 
        $level->setBlockIdAt($vec->x + 8, 62, $vec->z + 5, Block::STONE); 
        $level->setBlockIdAt($vec->x + 8, 61, $vec->z + 5, Block::STONE); 
        # 8 0 6
        $level->setBlockIdAt($vec->x + 8, 65, $vec->z + 6, Block::WATER_LILY); 
        $level->setBlockIdAt($vec->x + 8, 64, $vec->z + 6, Block::WATER); 
        $level->setBlockIdAt($vec->x + 8, 63, $vec->z + 6, Block::STONE); 
        $level->setBlockIdAt($vec->x + 8, 62, $vec->z + 6, Block::STONE); 
        # 8 0 7
        $level->setBlockIdAt($vec->x + 8, 65, $vec->z + 7, Block::ANVIL);
        $level->setBlockIdAt($vec->x + 8, 64, $vec->z + 7, Block::DIRT);
        $level->setBlockIdAt($vec->x + 8, 63, $vec->z + 7, Block::STONE); 
        $level->setBlockIdAt($vec->x + 8, 62, $vec->z + 7, Block::STONE);
        $level->setBlockIdAt($vec->x + 8, 61, $vec->z + 7, Block::DIAMOND_ORE);
        $level->setBlockIdAt($vec->x + 8, 60, $vec->z + 7, Block::STONE);
        $level->setBlockIdAt($vec->x + 8, 59, $vec->z + 7, Block::STONE);
        # 8 0 8
        $level->setBlockIdAt($vec->x + 8, 65, $vec->z + 8, Block::FENCE);
        $level->setBlockIdAt($vec->x + 8, 64, $vec->z + 8, Block::DIRT);
        $level->setBlockIdAt($vec->x + 8, 63, $vec->z + 8, Block::STONE);
        $level->setBlockIdAt($vec->x + 8, 62, $vec->z + 8, Block::STONE);
        $level->setBlockIdAt($vec->x + 8, 61, $vec->z + 8, Block::IRON_ORE);
        $level->setBlockIdAt($vec->x + 8, 60, $vec->z + 8, Block::STONE);
        # 8 0 9
        $level->setBlockIdAt($vec->x + 8, 65, $vec->z + 9, Block::FENCE);
        $level->setBlockIdAt($vec->x + 8, 64, $vec->z + 9, Block::DIRT);
        $level->setBlockIdAt($vec->x + 8, 63, $vec->z + 9, Block::STONE);
        $level->setBlockIdAt($vec->x + 8, 62, $vec->z + 9, Block::STONE);
        $level->setBlockIdAt($vec->x + 8, 61, $vec->z + 9, Block::STONE);
        # 8 0 10
        $level->setBlockIdAt($vec->x + 8, 65, $vec->z + 10, Block::WHEAT_BLOCK);
        $level->setBlockIdAt($vec->x + 8, 64, $vec->z + 10, Block::FARMLAND);
        $level->setBlockIdAt($vec->x + 8, 63, $vec->z + 10, Block::STONE);
        $level->setBlockIdAt($vec->x + 8, 62, $vec->z + 10, Block::STONE);
        # 8 0 11
        $level->setBlockIdAt($vec->x + 8, 65, $vec->z + 11, Block::WHEAT_BLOCK);
        $level->setBlockIdAt($vec->x + 8, 64, $vec->z + 11, Block::FARMLAND);
		# 8 0 12
		$level->setBlockIdAt($vec->x + 8, 64, $vec->z + 12, Block::FARMLAND);
		$level->setBlockIdAt($vec->x + 8, 65, $vec->z + 12, Block::WHEAT_BLOCK);
        # 9 0 4
        $level->setBlockIdAt($vec->x + 9, 66, $vec->z + 4, Block::TALL_GRASS);
        $level->setBlockIdAt($vec->x + 9, 65, $vec->z + 4, Block::GRASS);
        $level->setBlockIdAt($vec->x + 9, 64, $vec->z + 4, Block::STONE);
         # 9 0 5
        $level->setBlockIdAt($vec->x + 9, 65, $vec->z + 5, Block::GRASS);
        $level->setBlockIdAt($vec->x + 9, 64, $vec->z + 5, Block::STONE);
         # 9 0 6
        $level->setBlockIdAt($vec->x + 9, 64, $vec->z + 6, Block::WATER);
        $level->setBlockIdAt($vec->x + 9, 63, $vec->z + 6, Block::STONE);
        $level->setBlockIdAt($vec->x + 9, 62, $vec->z + 6, Block::STONE);
         # 9 0 7
        $level->setBlockIdAt($vec->x + 9, 64, $vec->z + 7, Block::GRASS);
        $level->setBlockIdAt($vec->x + 9, 63, $vec->z + 7, Block::STONE);
        $level->setBlockIdAt($vec->x + 9, 62, $vec->z + 7, Block::STONE);
        $level->setBlockIdAt($vec->x + 9, 61, $vec->z + 7, Block::STONE);
        # 9 0 8
        $level->setBlockIdAt($vec->x + 9, 64, $vec->z + 8, Block::DIRT);
        $level->setBlockIdAt($vec->x + 9, 63, $vec->z + 8, Block::STONE);
        $level->setBlockIdAt($vec->x + 9, 62, $vec->z + 8, Block::STONE);
        $level->setBlockIdAt($vec->x + 9, 61, $vec->z + 8, Block::STONE);
        # 9 0 9
        $level->setBlockIdAt($vec->x + 9, 65, $vec->z + 9, Block::WHEAT_BLOCK);
        $level->setBlockIdAt($vec->x + 9, 64, $vec->z + 9, Block::FARMLAND);
        $level->setBlockIdAt($vec->x + 9, 63, $vec->z + 9, Block::STONE);
        $level->setBlockIdAt($vec->x + 9, 62, $vec->z + 9, Block::STONE);
        $level->setBlockIdAt($vec->x + 9, 61, $vec->z + 9, Block::STONE);
        # 9 0 10
        $level->setBlockIdAt($vec->x + 9, 65, $vec->z + 10, Block::WHEAT_BLOCK);
        $level->setBlockIdAt($vec->x + 9, 64, $vec->z + 10, Block::FARMLAND);
		# 9 0 11
		$level->setBlockIdAt($vec->x + 9, 64, $vec->z + 11, Block::FARMLAND);
		$level->setBlockIdAt($vec->x + 9, 65, $vec->z + 11, Block::WHEAT_BLOCK);
        # 10 0 6
        $level->setBlockIdAt($vec->x + 10, 65, $vec->z + 6, Block::GRASS);
        $level->setBlockIdAt($vec->x + 10, 64, $vec->z + 6, Block::STONE);
        $level->setBlockIdAt($vec->x + 10, 63, $vec->z + 6, Block::STONE);
        # 10 0 7
        $level->setBlockIdAt($vec->x + 10, 65, $vec->z + 7, Block::GRASS);
        $level->setBlockIdAt($vec->x + 10, 64, $vec->z + 7, Block::STONE);
		# 10 0 8
		$level->setBlockIdAt($vec->x + 10, 64, $vec->z + 8, Block::FARMLAND);
		$level->setBlockIdAt($vec->x + 10, 65, $vec->z + 8, Block::WHEAT_BLOCK);
		# 10 0 9
		$level->setBlockIdAt($vec->x + 10, 64, $vec->z + 9, Block::FARMLAND);
		$level->setBlockIdAt($vec->x + 10, 65, $vec->z + 9, Block::WHEAT_BLOCK);
		# 10 0 10
		$level->setBlockIdAt($vec->x + 10, 64, $vec->z + 10, Block::FARMLAND);
		$level->setBlockIdAt($vec->x + 10, 65, $vec->z + 10, Block::WHEAT_BLOCK);
        # Others
        $level->setBlockIdAt($vec->x + 5, 65 , $vec->z + 6, Block::CRAFTING_TABLE);
		for($x = 5; $x < 10; $x++){
			for($z = 5; $z < 10; $z++){
				$level->setBlockIdAt($vec->x + $x, 68, $vec->z + $z, Block::LEAVES); // 72
			}
		}
		for($x = 6; $x < 9; $x++){
			for($z = 6; $z < 9; $z++){
				$level->setBlockIdAt($vec->x + $x, 69, $vec->z + $z, Block::LEAVES); // 73
			}
		}
		 for ($x = 4; $x < 11; $x++) {
                for ($z = 4; $z < 11; $z++) {
					 for ($x = 0; $x < 16; $x++) {

					
				}}}
		$level->setBlockIdAt($vec->x + 7, 65, $vec->z + 7, Block::LOG); // 5
		$level->setBlockIdAt($vec->x + 7, 66, $vec->z + 7, Block::LOG); // 6
		$level->setBlockIdAt($vec->x + 7, 67, $vec->z + 7, Block::LOG); // 7
		$level->setBlockIdAt($vec->x + 7, 68, $vec->z + 7, Block::LOG); // 8
		$level->setBlockIdAt($vec->x + 7, 69, $vec->z + 7, Block::LOG); // 9
		$level->setBlockIdAt($vec->x + 4, 1, $vec->z + 10, Block::AIR);
		$level->setBlockIdAt($vec->x + 5, 68, $vec->z + 5, Block::AIR); // 72
		$level->setBlockIdAt($vec->x + 5, 68, $vec->z + 9, Block::AIR);
		$level->setBlockIdAt($vec->x + 9, 68, $vec->z + 5, Block::AIR);
		$level->setBlockIdAt($vec->x + 9, 68, $vec->z + 9, Block::AIR);
		###
		$level->setBlockIdAt($vec->x + 5, 69, $vec->z + 7, Block::LEAVES); // 73
		$level->setBlockIdAt($vec->x + 7, 69, $vec->z + 5, Block::LEAVES);
		$level->setBlockIdAt($vec->x + 9, 69, $vec->z + 7, Block::LEAVES);
		$level->setBlockIdAt($vec->x + 7, 69, $vec->z + 9, Block::LEAVES);
		$level->setBlockIdAt($vec->x + 7, 70, $vec->z + 6, Block::LEAVES); // 74
		$level->setBlockIdAt($vec->x + 6, 70, $vec->z + 7, Block::LEAVES);
		$level->setBlockIdAt($vec->x + 8, 70, $vec->z + 7, Block::LEAVES);
		$level->setBlockIdAt($vec->x + 7, 70, $vec->z + 8, Block::LEAVES);
		$level->setBlockIdAt($vec->x + 7, 71, $vec->z + 7, Block::LEAVES); // 75
	}

	public function populate(ChunkManager $level, $chunkX, $chunkZ, Random $random){
		$chunk = $level->getChunk($chunkX, $chunkZ);
		$shape = $this->generator->getShape($chunkX << 4, $chunkZ << 4);
		for($Z = 0; $Z < 16; ++$Z){
			for($X = 0; $X < 16; ++$X){
				$type = $shape[($Z << 4) | $X];
				if($type === MyPlotGenerator::ISLAND){
					self::placeObject($level, $chunk, $X, $Z);
				}
			}
		}
	}
}