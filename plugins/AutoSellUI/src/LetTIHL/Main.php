<?php

namespace LetTIHL;

use pocketmine\{Server, Player};
use pocketmine\command\{ConsoleCommandSender, Command, CommandSender};
use pocketmine\event\{Listener, block\BlockBreakEvent};
use pocketmine\utils\Config;
use pocketmine\event\player\{PlayerJoinEvent, PlayerQuitEvent};
use pocketmine\plugin\PluginBase;

Class Main extends PluginBase implements Listener{
	
	public function onEnable():void{
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
		$this->getLogger()->info("\n\n\n\n§l§a> §bPlugin Auto Sell By PIG\n\n\n\n");
@mkdir($this->getDataFolder(), 0744, true);
$this->atv1 = new Config($this->getDataFolder()."autov1.yml",Config::YAML);
}

public function onJoin(PlayerJoinEvent $ev) {
if(!$this->atv1->exists($ev->getPlayer()->getName())) {
$this->atv1->set($ev->getPlayer()->getName(), 0);
$this->atv1->save();
    }
}

public function onQuit(PlayerQuitEvent $ev) {
$this->atv1->save();
}
	
	public function onCommand(CommandSender $sender, Command $command, String $label, array $args) : bool {
        switch($command->getName()){
            case "autosell":
           if ($sender->hasPermission("autosell.command")){
            $this->auto($sender);
            return true;
        }
        return true;
	}
        }
		
	 public function auto($sender){
        $formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $formapi->createSimpleForm(function(Player $sender, $data){
          $result = $data;
          if($result === null){
          }
          switch($result){
              case 0:
              break;
              case 1:
     if($this->atv1->get($sender->getPlayer()->getName()) == 1) {
     $this->atv1->set($sender->getPlayer()->getName(), ($this->atv1->get($sender->getPlayer()->getName()) - 1));
			$sender->sendMessage("§l§c【】§c Auto Sell đã tắt..!");
}elseif($this->atv1->get($sender->getPlayer()->getName()) == 0) {
     $this->atv1->set($sender->getPlayer()->getName(), ($this->atv1->get($sender->getPlayer()->getName()) + 1));
			$sender->sendMessage("§l§c【】§b Auto Sell đã bật..!");
     }
              break;

         }
        });

     if($this->atv1->get($sender->getPlayer()->getName()) == 0) {
     $atv1 = "§cTắt";
    }elseif($this->atv1->get($sender->getPlayer()->getName()) == 1) {
     $atv1 = "§aBật";
     }
        $form->setTitle("§l§9⚫§a Auto Sell §9⚫");
		$form->addButton("§l§e•§c Thoát §e•");
		$form->addButton("§l§e•§b Auto Sell §f[ ".$atv1." §f] §e•");
        $form->sendToPlayer($sender);
	}
		
	public function onBreak(BlockBreakEvent $event) {
		$player = $event->getPlayer();
     if($this->atv1->get($event->getPlayer()->getName()) == 1) {
		foreach($event->getDrops() as $drop) {
			if(!$player->getInventory()->canAddItem($drop)) {
				$event->getPlayer()->addTitle("§l§6❖§a Full Inventory §e✰", "§l§aTự động bán");
                $this->getServer()->getCommandMap()->dispatch($player,"sell all");

            }

				break; 
			}
		}
	}
}
