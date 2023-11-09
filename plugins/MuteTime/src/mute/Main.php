<?php

namespace mute;

use pocketmine\Player;
use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\command\{Command, CommandSender, ConsoleCommandSender};
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerChatEvent;

Class Main extends PluginBase implements Listener{
	
	public function onEnable():void{
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
       @mkdir($this->getDataFolder(), 0744, true);
       $this->mute = new Config($this->getDataFolder()."mute.yml",Config::YAML);		
    }
    public function onJoin(PlayerJoinEvent $ev) {
        if(!$this->mute->exists($ev->getPlayer()->getName())) {
            $this->mute->set($ev->getPlayer()->getName(), "no");
            $this->mute->save();
        }
    }

	public function onCommand(CommandSender $player, Command $command, String $label, array $args) : bool {
        switch($command->getName()){
            case "mute":
                if($player->hasPermission("mute.staff")){
                   $lit = [];
         foreach($this->getServer()->getOnlinePlayers() as $player){
            $list[] = $player->getName();
            $this->playerList[$player->getName()] = $list;
        }
        $formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $formapi->createCustomForm(function(Player $player, $data){
			if(!$data == null){
			$index = $data[0];
            $name = $this->playerList[$player->getName()][$index];
            $time = time();
            $this->mute->set($name, $time + ($data[1] * 65));
            $this->mute->save();
            $this->getServer()->broadcastMessage("§l§6•§e Người chơi§c ".$name." §ebị mute §f".$data[1]." §aphút");
            $player->sendMessage("§l§b•§a Mute thành công");
			}
        });
        $form->setTitle("§fMute");
        $form->addDropdown("§f§lDanh sách người chơi\n", $this->playerList[$player->getName()]);
            $form->addSlider("§l§aSố Lượng§f", 1, 60);
        $form->sendToPlayer($player);
                }else{
					 $player->sendMessage("§l§b•§a Mute thành công");
				}
           return true;
        }
        return true;
	}
    
    public function menu($player){
        $lit = [];
        foreach($this->getServer()->getOnlinePlayers() as $player){
            $list[] = $player->getName();
            $this->playerList[$player->getName()] = $list;
        }
        $formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $formapi->createCustomForm(function(Player $player, $data){
			if($data == null){
				return;
			}
			$index = $data[0];
            $name = $this->playerList[$player->getName()][$index];
            $time = time();
            $this->mute->set($name, $time + ($data[1] * 65));
            $this->mute->save();
            $this->getServer()->broadcastMessage("§l§6•§e Người chơi§c ".$name." §ebị mute §f".$data[1]." §aphút");
            $player->sendMessage("§l§b•§a Mute thành công");
        });
        $form->setTitle("§fMute");
        $form->addDropdown("§f§lDanh sách người chơi\n", $this->playerList[$player->getName()]);
            $form->addSlider("§l§aSố Lượng§f", 1, 60);
        $form->sendToPlayer($player);

    }

    public function onChat(PlayerChatEvent $ev){
        $player = $ev->getPlayer();
        $time = time();
        $time_mute = $this->mute->get($player->getName());
        if($time_mute == "no"){
            return;
        }
        if($time >= $time_mute){
            $this->mute->set($player->getName(), "no");
            $this->mute->save();
            return;
        }
        if($time_mute >= $time){    
           $ev->setCancelled(true);
           $player->sendMessage("§l§c•§e Bạn đã bị chặn chat bởi staff vui lòng đợi ");
        }
    }
}