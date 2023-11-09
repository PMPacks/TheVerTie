<?php

namespace shopdonate;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\item\enchantment\{Enchantment, EnchantmentInstance};
use pocketmine\item\Item;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use onebone\coinapi\CoinAPI;
use jojoe77777\FormAPI\CustomForm;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class Main extends PluginBase implements Listener{
  
 public function onEnable(){
   $this->getServer()->getPluginManager()->registerEvents($this,$this);
   $this->getServer()->getLogger()->Info("Plugin Đang Chạy");
   $this->coin = $this->getServer()->getPluginManager()->getPlugin("CoinAPI");
 }
 public function onCommand(CommandSender $sender, Command $cmd, String $label, Array $args) : bool{
   switch($cmd->getName()){
     case "shopdonate":
     if ($sender instanceof Player){
       $this->shopdonate($sender);
     }
     return true;
     }
 }
 public function shopdonate($sender){
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
      $cost = $this->coin->myCoin($player);
      $item = Item::get(4, 0, $data[1]*1);
      $inv = $player->getInventory();
      if ($cost >= $data[1]*25){
       $this->coin->reduceCoin($player, $data[1]*25);
       $item->setCustomName("§a§lĐá §aD§bO§3N§gA§cT§dE");
       $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(15), 1));
       $player->sendMessage("Mua Thành Công");
       if ($inv->canAddItem($item)){
         $inv->addItem($item);
       }
      }else{
        $player->sendMessage("Không Đủ Coin");
      }
   });
   $form->setTitle("§a§l• ShopDonate •");
   $form->addLabel("§e§lNhập Số Đá Bạn Muốn Mua");
   $form->addInput("§a§l• 25 Coin = 1 Đá Donate");
   $form->sendToPlayer($sender);
 }
    return true;
 }
}