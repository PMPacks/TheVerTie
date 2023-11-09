<?php

namespace cobac;

use pocketmine\scheduler\Task;
use cobac\Main;

class TimeTask extends Task{

    public function __construct(Main $plugin){

        $this->plugin = $plugin;
    }
    public function onRun($currentTick){
        $this->plugin->time --;
        if(!$this->plugin->time <= 0) return false;
        $rand = mt_rand(0,49);
        $rand2 = mt_rand(50, 100);
        $mumber = mt_rand($rand, $rand2);
        if($mumber <= 50 ){
            $type = true;
        }else{
            $type = false;
        }
        if($type == true){
            $name = "";
            foreach($this->plugin->data["Tài"] as $names => $xu){
                if( $xu > 0){
                    $xu = $xu * 1.9;
                    $player = $this->plugin->getServer()->getPlayer($names);
                    unset($this->plugin->data["Tài"][$names]);                 
                    if(!$player == null){                                    $this->plugin->money->addMoney($player, $xu);
                        $player->sendMessage("§l§c•§b Bạn đã nhận được $xu xu từ tài xỉu online");
                        $name .= $player->getName().", ";
                    }
                }
            }
            $this->plugin->getServer()->broadcastMessage("§l§6•§e Kết quả Là Tài \n §fNgười Trúng Thưởng:§a $name ");
            foreach($this->plugin->data["Xỉu"] as $names => $xu){
                if( $xu > 0){
                    unset($this->plugin->data["Xỉu"][$names]);
                    $player = $this->plugin->getServer()->getPlayer($names);
                    if(!$player == null){
                        $player->sendMessage("§l§c•§b Bạn đã thua $xu xu ở tài xỉu online");
                    }
                }
            }            
            
        }else{
            $name = "";
            foreach($this->plugin->data["Xỉu"] as $names => $xu){
                if( $xu >0){
                    $xu = $xu * 1.9;
                    $player = $this->plugin->getServer()->getPlayer($names);
                    unset($this->plugin->data["Xỉu"][$names]);                 
                    if(!$player == null){                                    $this->plugin->money->addMoney($player, $xu);
                        $player->sendMessage("§l§c•§b Bạn đã nhận được $xu xu từ tài xỉu online");
                        $name .= $player->getName().", ";
                    }
                }
            }
            $this->plugin->getServer()->broadcastMessage("§l§6•§e Kết quả Là Xỉu \n §fNgười trúng thưởng:§a $name ");
            foreach($this->plugin->data["Tài"] as $names => $xu){
                if( $xu > 0){
                    unset($this->plugin->data["Tài"][$names]);
                    $player = $this->plugin->getServer()->getPlayer($names);
                    if(!$player== null){
                        $player->sendMessage("§l§c•§b Bạn đã thua $xu xu ở tài xỉu online");
                   }
                }
            }            
            
        }
        $this->plugin->time = 300;
        $this->plugin->getServer()->broadcastMessage("§l§6•§e 5 phút đặt tài xỉu bắt đầu");
    }
}

    