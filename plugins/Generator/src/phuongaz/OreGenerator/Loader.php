<?php

namespace phuongaz\OreGenerator;

use pocketmine\plugin\PluginBase;
use pocketmine\tile\Tile;
use pocketmine\Server;
use phuongaz\OreGenerator\UpgradeHandler\UpgradeCommand;

Class Loader extends PluginBase{

	public function onEnable() :void{
		Server::getInstance()->getPluginManager()->registerEvents(new GenListener(), $this);
		Server::getInstance()->getCommandMap()->register("OreGenerator", new UpgradeCommand());
        Tile::registerTile(GeneratorTile::class, ["GeneratorTile"]);
	}
}