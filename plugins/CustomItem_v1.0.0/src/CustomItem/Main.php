<?php 

namespace CustomItem;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantInstance;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

Class Main extends PluginBase implements Listener{

 public $prefix = "§a[§bMine§eTown§a]§r ";
 
 public function onEnable(){
   $this->getServer()->getPluginManager()->registerEvents($this, $this);
   $this->getLogger()->info("§bLOADING...");
   }
   
   public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool{
	   switch($cmd->getName()){
		   case "setitemname":
		   $name = $sender->getName();
		   $text = implode(" ", $args);
		   $item = $sender->getInventory()->getItemInHand();
		   $item->setCustomname($text);
		   $sender->getInventory()->setItemInHand($item);
		   $sender->sendMessage($this->prefix . "§aBạn đã đặt tên Item thành §c" . $text . "§a.");
		   break;
		   return true;
		   case "setitemlore":
		   $name = $sender->getName();
		   /*$br = explode("\\n", $text);
		   $text = "";
		   foreach($br as $line)
		   $args .= $line."\n";*/
		   //$lore = implode(str_replace("{line}","\n", $args));
		   $lore = implode(" ", $args);
		   $lore = explode("\\n",$lore);
		   $item = $sender->getInventory()->getItemInHand();
		   $item->setLore($lore);
		   $sender->getInventory()->setItemInHand($item);
		   $sender->sendMessage($this->prefix . "§aBạn đã đặt tên Lore Item thành công.");
	   }
	   return true;
   }
}