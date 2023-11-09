<?php

namespace AutoFly;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\player\PlayerJoinEvent;

class Main extends PluginBase implements Listener{
	 public function onEnable(){
		 $this->getServer()->getPluginManager()->registerEvents($this, $this);
		 }
		public function onJoin(PlayerJoinEvent $event){ 
			$player = $event->getPlayer();
	  $command = "joinui";
	  $this->getServer()->getCommandMap()->dispatch($player, $command); 
			}
             }