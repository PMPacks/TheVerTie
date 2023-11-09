<?php
namespace BuyFix;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\math\Vector3;
use onebone\economyapi\EconomyAPI;
use pocketmine\inventory\PlayerInventory;
use pocketmine\block\Block;
use pocketmine\item\Item;
use pocketmine\level\Level;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\Tool;
use pocketmine\item\Armor;

class Main extends PluginBase implements Listener{

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    			//$this->getLogger()->info("§a§lKhởi Chạy");
    			
    }
    
    
    
    public function onCommand(CommandSender $sender, Command $command, String $label, array $args) : bool {
        if($command->getName() === "fix"){
          if(!$sender instanceof Player){
            $sender->sendMessage("Please use command in game!");
            return true;
          }
          $economy = EconomyAPI::getInstance();
          $mymoney = $economy->myMoney($sender);
		     $item = $sender->getInventory()->getItemInHand();
          $meta = $item->getDamage();
          $cash = $meta * 0.5;
          if($mymoney >= $cash){
            $economy->reduceMoney($sender, $cash);
            $item = $sender->getInventory()->getItemInHand();
				      if($item instanceof Armor or $item instanceof Tool){
				        $id = $item->getId();
					      $meta = $item->getDamage();
					      $sender->getInventory()->removeItem(Item::get($id, $meta, 1));
					      $newitem = Item::get($id, 0, 1);
					      
					      
					      if($item->hasCustomName()){
						       $newitem->setCustomName($item->getCustomName());
						     }
					      if($item->hasEnchantments()){
						        foreach($item->getEnchantments() as $enchants){
						            $newitem->addEnchantment($enchants);
						       }
						     }
						    $lore = $item->getLore();
						    $newitem->setlore($lore);
					      $sender->getInventory()->addItem($newitem);
					      $sender->sendMessage(" §l§aVật Phẩm §e". $item->getName() . " §aĐã Được Sửa Chữa Với Giá§e $cash §aXu!");
					      return true;
					    } else {
				        	$sender->sendMessage(" §l§cVật Phẩm Bạn Cần Sửa Chữa Không Hợp Lệ!");
					        return false;
					    }
            return true;
          } else {
            $sender->sendMessage(" §l§cBạn Không Đủ§e $cash §cXu Để Sửa Chữa Vật Phẩm!");
            return true;
          }
        }
    }
}
