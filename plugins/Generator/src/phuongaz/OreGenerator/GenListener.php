<?php

namespace phuongaz\OreGenerator;

use pocketmine\event\block\{BlockPlaceEvent, BlockBreakEvent};
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\Listener;
use pocketmine\block\Block;
use pocketmine\item\Item;
use pocketmine\nbt\tag\IntTag;

Class GenListener implements Listener{

	public function BlockPlace(BlockPlaceEvent $event){
		$block = $event->getBlock();
		$item = $event->getItem();
		if($block->getId() == Block::STONECUTTER){
            $nbt = GeneratorTile::createNBT($block);
            $nbt_item = $item->getNamedTag();
            if($nbt_item->hasTag("generator", IntTag::class)){
            	$level = $nbt_item->getInt("generator");
            }else $level = 1;
            $nbt->setInt("generator", $level);
            $Tile = new GeneratorTile($block->getLevel(), $nbt);
            $Tile->spawnToAll();
		}
	}

	public function BlockBreakEvent(BlockBreakEvent $event){
		$block = $event->getBlock();
		if($block->getId() == Block::STONECUTTER){
			$tile = $event->getPlayer()->getLevel()->getTile($event->getBlock());
			if($tile instanceof GeneratorTile){
				$tile_level = $tile->getLevelGenerator();
				$item = Item::get(245);
				$item->setCustomName("§l§eMáy tạo khoáng sản §f(§eCấp ".$tile_level."§f)");
				$nbt = $item->getNamedTag();
				$nbt->setInt("generator", $tile_level);
				$item->setNamedTag($nbt);
				$event->setDrops([$item]);
			}
		}
	}
}