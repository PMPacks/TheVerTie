<?php

namespace doitaisan;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\event\Listener;

use onebone\coinapi\CoinAPI;

use onebone\economyapi\EconomyAPI;

use jojoe77777\FormAPI\CustomForm;

class Main extends PluginBase implements Listener {
  
  public function onEnable(){
    $this->getLogger()->info("Plugin Code By PmmdSt");
    $this->money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
    $this->coin = $this->getServer()->getPluginManager()->getPlugin("CoinAPI");
  }
  
  public function onDisable(){
    $this->getLogger()->info("Plugin Da Bi Tat");
  }
  
  public function onCommand(CommandSender $sender, Command $cmd, String $label, array $args): bool{
    switch($cmd->getName()){
      case "doitaisan":
        if ($sender instanceof Player){
          $this->DoiTaiSanUi($sender);
        }else{
          $sender->sendMessage("Pls Use In Game :((");
        }
    }
    return true;
  }
  
  public function DoiTaiSanUi($player){
    $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
    $form = $api->createSimpleForm(function(Player $player, ?int $data = null){
      
      if($data === null){
        return true;
      }
      switch($data){
        case 0:
          $this->DoiXu($player);
          break;
        case 1:
          $this->DoiCoin($player);
              break;
      }
    });
    $form->setTitle("§l§a✔ §rĐổi Tài Sản §a✔");
    $form->setContent("§l§f§•[§c+§f]§r Hãy Chọn Các Nút Sau Đây");
    $form->addButton("§l§1•§c Đổi Xu §1•",1,"https://i.imgur.com/u7JxDYC.png");
    $form->addButton("§l§1•§c Đổi Coin§1 •",1,"https://i.imgur.com/5bPYJvn.png");
    $form->sendToPlayer($player);
    return $form;
  }
  public function DoiXu($player){
    $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
    $form = $api->createCustomForm(function(Player $player, $data){
      
      if($data === null){
        return true;
      }
      $data[1] >= 1;
             if(!isset($data[1]) || !is_numeric($data[1])){
          $player->sendMessage("§a§l• Vui Lòng Nhập Số Không Dùng Kí Tự Khác");
          return false;
      }
      $coin = CoinAPI::getInstance()->myCoin($player);
      if($coin >= $data[1]*1){
        $this->coin->reduceCoin($player, $data[1]*1);
        $this->money->addMoney($player, $data[1]*5000);
        $player->sendMessage("§l§f[§•§c+§f]§r Đã đổi thành công §e" . $data[1]*5000 . " §aXu");
      }else{
        $player->sendMessage("§l§f§•[§c+§f]§r Bạn không có đủ Coin");
      }
    });
    $form->setTitle("§l§1•§c Đổi Xu §1•");
    $form->addLabel("§l§eHãy Nhập Số Coin Muốn Đổi Ra Xu");
    $form->addInput("§l§f§•[§c+§f]§r Coin = 5000 Xu", "0");
    $form->sendToPlayer($player);
    return $form;
  
       }
       public function DoiCoin($player){
           $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
           $form = $api->createCustomForm(function(Player $player, $data){
             
             if($data === null){
               return true;
             }
             $data[1] >= 1;
             if(!isset($data[1]) || !is_numeric($data[1])){
                 $player->sendMessage("§a§lVui lòng nhập số không nhập kí tự khác");
                 return false;
             }
             $money = EconomyAPI::getInstance()->myMoney($player);
             if($money >= $data[1]*1000000){
               $this->money->reduceMoney($player, $data[1]*1000000);
               $this->coin->addCoin($player, $data[1]);
               $player->sendMessage("§l§f§•[§c+§f]§r Đã đổi thành công §e" . $data[1] . " §aCoin");
             }else{
               $player->sendMessage("§l§f§•[§c+§f]§r Bạn không có đủ Money");
             }
           });
           $form->setTitle("§l§1• §c Đổi Coin §1•");
           $form->addLabel("§l§eHãy Nhập Số Coin Muốn Đổi");
           $form->addInput("§l§f§•[§c+§f]§r 1.000.000 Xu = 1 Coin", "0");
           $form->sendToPlayer($player);
           return $form;
         }
         
}