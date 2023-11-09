<?php

namespace muagen;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\item\Item;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use onebone\economyapi\EconomyAPI;
use jojoe77777\FormAPI\CustomForm;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class Main extends PluginBase implements Listener{
  
 public function onEnable(){
   $this->getServer()->getPluginManager()->registerEvents($this,$this);
   $this->getServer()->getLogger()->Info("Plugin Đang Chạy");
   $this->eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
 }
 public function onCommand(CommandSender $sender, Command $cmd, String $label, Array $args) : bool{
   switch($cmd->getName()){
     case "muagen":
     if ($sender instanceof Player){
       $this->muagen($sender);
     }
     return true;
     }
 }
 public function muagen($sender){
   if ($sender instanceof Player){
   $form = new CustomForm(function(Player $player, $data){
    if ($data === null){
      return true;
    }
    $data[1] >= 1;
    if(!isset($data[1]) || !is_numeric($data[1])){
    $player->sendMessage("§a§l• Vui Lòng Nhập Số Không Dùng Kí Tự Khác");
          return false;
      }
      $money = $this->eco->myMoney($player);
      $item = Item::get(245, 0, $data[1]*1);
      $inv = $player->getInventory();
      if ($money >= $data[1]*20000){
       $this->eco->reduceMoney($player, $data[1]*20000);
       $item->setCustomName("ORE Generator (1)");
       if ($inv->canAddItem($item)){
         $inv->addItem($item);       
       }
      }else{
        $player->sendMessage("Không Đủ Xu");
    }
   });
   $form->setTitle("§a§l• Mua Gen •");
   $form->addLabel("§e§l• Nhập Số Gen Bạn Muốn Mua");
   $form->addInput("§a§l• 20.000 Xu = 1 Generator");
   $form->sendToPlayer($sender);
   }
    return true;
 }
}