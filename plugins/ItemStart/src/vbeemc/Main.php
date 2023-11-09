<?php

namespace vbeemc;

use pocketmine\Player;
use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\item\Item;
use pocketmine\command\{Command, CommandSender, ConsoleCommandSender};
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\item\enchantment\{Enchantment, EnchantmentInstance};

Class Main extends PluginBase implements Listener{
	
	public function onEnable():void{
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
@mkdir($this->getDataFolder(), 0744, true);
       $this->itemnew = new Config($this->getDataFolder()."itemnew.yml",Config::YAML);
}

  public function onJoin(PlayerJoinEvent $ev) {
	
  if(!$this->itemnew->exists($ev->getPlayer()->getName())) {

			$player = $ev->getPlayer();
			$item = Item::get(245, 0, 1);
                $item->setCustomName("ORE Generator (1)");
      $item1 = Item::get(257, 0, 1);
                $item1->setCustomName("§a§l• Cup Khởi Đầu •");
                $item1->setLore(array("§e§l• Cup Chỉ Nhận Được Một Lần \n• §e§lChúc Các Bạn Chơi Game Vui Vẻ"));
     $item1->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(15), 1));
      $item2 = Item::get(258, 0, 1);
                $item2->setCustomName("§a§l• Rìu Khởi Đầu •");
                $item2->setLore(array("§e§l• Rìu chỉ nhận được một lần \n• §e§lChúc Các Bạn Chơi Game Vui Vẻ"));
     $item3 = Item::get(320, 0, 64);
     $item2->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(15), 1));
			$player->getInventory()->addItem($item);
			$player->getInventory()->addItem($item1);
			$player->getInventory()->addItem($item2);
			$player->getInventory()->addItem($item3);
			
$this->itemnew->set($ev->getPlayer()->getName());
$this->itemnew->save();
       }
    }
}