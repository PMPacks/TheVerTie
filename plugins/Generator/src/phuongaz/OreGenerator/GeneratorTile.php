<?php

namespace phuongaz\OreGenerator;

use pocketmine\Player;
use pocketmine\tile\Spawnable;
use pocketmine\block\Block;
use pocketmine\nbt\tag\CompoundTag;

Class GeneratorTile extends Spawnable{

	private $ores = [
		56,
		21,
		129,
		15,
		14,
		73,
		16
	];

	private $levelgen = 1;

	public function onUpdate() :bool{
		if($this->getBlock()->getId() !== Block::STONECUTTER){
			$this->close();
			return false;
		}
		$pos = $this->getBlock()->asPosition()->add(0, 1);
		$upBlock = $this->getBlock()->getLevel()->getBlock($pos);
		if($upBlock->getId() == Block::AIR){
			if($upBlock->getLevel()->getServer()->getTick() % (32 - $this->levelgen) == 0){
				$newBlock = $this->getNewBlock();
				$this->getBlock()->getLevel()->setBlock($upBlock, $newBlock, true, true);
			}
		}
		return true;
	}

	public function getNewBlock() :Block{
		$level = $this->levelgen;
		$chance = mt_rand(3, (9 - $level)+3);
		if($chance == 3){
			return Block::get($this->ores[array_rand($this->ores)]);
		}
		return Block::get(1);
	}

	public function getLevelGenerator(){
		return $this->levelgen;
	}

    protected function addAdditionalSpawnData(CompoundTag $nbt): void {
        $nbt->setString("id", "StoneCutter");
    }

    protected function readSaveData(CompoundTag $nbt): void {
    	$this->scheduleUpdate();
        $this->levelgen = $nbt->getInt("generator");
    }

    protected function writeSaveData(CompoundTag $nbt): void {
        $nbt->setInt("generator", $this->levelgen);
    }
}