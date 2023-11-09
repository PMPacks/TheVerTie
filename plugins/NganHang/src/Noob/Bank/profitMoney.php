<?php

namespace Noob\Bank;

use pocketmine\scheduler\Task;
use pocketmine\Server;
use pocketmine\Player;
use Noob\Bank\Main;

Class profitMoney extends Task{

    public function __construct(Main $plugin){
        $this->plugin = $plugin;
    }

    public function onRun($currentTick){
		$this->plugin->profitMoney();
	}
	
	public function cancel(){
      $this->getHandler()->cancel();
    }
}
