<?php

namespace cobac;

use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\command\{
    Command,
    CommandSender
};
use pocketmine\event\player\{
    PlayerJoinEvent,
    PlayerQuitEvent
};
use cobac\TimeTask;
use pocketmine\scheduler\ClosureTask;
use pocketmine\event\player\PlayerCommandPreprocessEvent;

class Main extends PluginBase implements Listener{
	
	public $data;
	public $time = 300;
	
	public function onEnable():void{
	    $this->getServer()->getPluginManager()->registerEvents($this,$this);
	    $this->money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
	    $this->getLogger()->info("§l§a> §bPlugin Cờ bạc online By LetTIHL");
	    $this->data["Tài"]["Let"] = 0;
	    $this->data["Xỉu"]["Let"] = 0;
	    $this->getScheduler()->scheduleRepeatingTask(new TimeTask($this), 20);
    }

	public function onPlayerCmd(PlayerCommandPreprocessEvent $event) {
	    $player = $event->getPlayer();
	    $cmd = $event->getMessage();
	    if($cmd == "/tx") $this->menu($player);
	    
	}
	
    public function menu($player){
        $formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $formapi->createCustomForm(function(Player $player, $data){
            if($data == null) return false;
            if($this->time <= 5){
                $player->sendMessage("§l§f• §cHết Thời gian cược");
                return false;
            }
            if(!is_numeric($data[2])){
                $player->sendMessage("§l§f• §cVui Lòng Nhập Số cược");
                return false;                
            }
            if($data[2] >100000){
                $player->sendMessage("§l§f• §cSố cược không được vượt quá 100k");
                return false;                      
            }
            if($this->money->myMoney($player) < $data[2]){
                $player->sendMessage("§l§f• §cBạn không đủ tiền cược");
                return false;
            }
            if($data[1] == 0){
                if(in_array($player->getName(),$this->data["Tài"])){
                    
                    if($this->data["Tài"][$player->getName()] + $data [2] <= 100000){
                        $this->data["Tài"][$player->getName()] += $data[2];
                        $this->money->reduceMoney($player, $data[2]);                        
                    }else{
                         $player->sendMessage("§l§f• §cCược vượt quá giới hạn");
                    }
                }else{
                    $this->money->reduceMoney($player, $data[2]);
                    $this->data["Tài"][$player->getName()] = $data[2];
                }
                $player->sendMessage("§l§b•§a Cược tài với $data[2] thành công");                
            }
            if($data[1] == 1){
                if(in_array($player->getName(),$this->data["Xỉu"])){
                    if($this->data["Xỉu"][$player->getName()] + $data [2] <= 100000){
                        $this->data["Xỉu"][$player->getName()] += $data[2];
                        $this->money->reduceMoney($player, $data[2]);
                    }else{
                         $player->sendMessage("§l§f• §cCược vượt quá giới hạn");
                    }
                }else{
                    $this->money->reduceMoney($player, $data[2]);
                    $this->data["Xỉu"][$player->getName()] = $data[2];
                }
                $player->sendMessage("§l§b•§a Cược Xỉu với $data[2] thành công");                
            }
        });
        $money = $this->money->myMoney($player);
        $form->setTitle("§fTài Xỉu Online");
        $form->addLabel("§l§c•§eMoney:§f $money ");
        $form->addDropdown("§fBình Chọn",["Tài", "Xỉu"]);
        $form->addInput("§a• Số tiền cược");
        $form->sendToPlayer($player);

    }
}