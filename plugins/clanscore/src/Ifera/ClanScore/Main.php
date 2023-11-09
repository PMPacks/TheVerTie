<?php
declare(strict_types = 1);

namespace Ifera\ClanScore;

use Ifera\ClanScore\listeners\EventListener;
use Ifera\ClanScore\listeners\TagResolveListener;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
		$this->getServer()->getPluginManager()->registerEvents(new TagResolveListener($this), $this);
	}
}