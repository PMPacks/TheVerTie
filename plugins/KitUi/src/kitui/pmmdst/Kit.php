<?php

namespace kitui\pmmdst;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\event\Listener;

use pocketmine\item\Item;

use pocketmine\event\block\BlockPlaceEvent;

use pocketmine\block\Block;

use pocketmine\level\Level;
use pocketmine\level\Position;

use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;

use DaPigGuy\PiggyCustomEnchants\CustomEnchantManager;

class Kit extends PluginBase implements Listener {
  
  public $prefix = "§e§l【 §aTheVerTie §e】";
  
  public $kit1 = [];
  public $kit2 = [];
  public $kit3 = [];
  public $kit4 = [];
  
  public function onEnable(){
    $this->getLogger()->info("§aĐang chạy....");
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
  }
  
  public function onDisable(){
    $this->getLogger()->info("§cĐang tắt....");
  }
  
  public function onCommand(CommandSender $sender, Command $cmd, String $label, array $args): bool{
    switch($cmd->getName()){
      case "kit":
        if($sender instanceof Player){
          $this->Kit($sender);
        }else{
          $sender->sendMessage($this->prefix . "§c Please use this command in game !");
        }
        break;
    }
    return true;
  }
  
  public function Kit($player){
    $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
    $form = $api->createSimpleForm(function(Player $player, int $data = null){
      
      if($data === null){
        return true;
      }
      //------------------Get Chest
      $chest1 = Item::get(54, 0, 1);
      $chest2 = Item::get(54, 0, 1);
      $chest3 = Item::get(54, 0, 1);
      $chest4 = Item::get(54, 0, 1);
      //------------------Set Name Chest
      $chest1->setCustomName("§l§c✘§eHỘP KIT VIP4§c✘");
      $chest2->setCustomName("§l§c✘§eHỘP KIT VIP5§c✘");
      $chest3->setCustomName("§l§c✘§eHỘP KIT VIP6§c✘");
      $chest4->setCustomName("§l§c✘§eHỘP KIT VIP7§c✘");
      switch($data){
        case 0:
          if($player->hasPermission("kitvip4.kit")){
            if($player->getInventory()->canAddItem($chest1)){
              if(!isset($this->kit1[$player->getName()])){
                $this->kit1[$player->getName()] = time() + 864000;
                $player->getInventory()->addItem($chest1);
                $player->sendMessage($this->prefix . "§f➵§e Đã nhận thành công §9HỘP KIT VIP4");
              }else{
                if(time() < $this->kit1[$player->getName()]){
                  $time = $this->kit1[$player->getName()] - time();
                  $player->sendMessage($this->prefix . "§cHãy chờ thêm §e" . $time . "§c giây nữa !");
                }else{
                  unset($this->kit1[$player->getName()]);
                }
              }
            }else{
              $player->sendMessage($this->prefix . " §cBạn không đủ slot để add hộp kit, hãy quay lại sau !");
            }
          }else{
            $player->sendMessage($this->prefix . "§c Bạn không có quyền để nhận kit !");
          }
          break;
          
          case 1:
          if($player->hasPermission("kitvip5.kit")){
            if($player->getInventory()->canAddItem($chest2)){
              if(!isset($this->kit2[$player->getName()])){
                $this->kit2[$player->getName()] = time() + 864000;
                $player->getInventory()->addItem($chest2);
                $player->sendMessage($this->prefix . "§f➵§e  Đã nhận thành công §9HỘP KIT VIP5");
              }else{
                if(time() < $this->kit2[$player->getName()]){
                  $time = $this->kit2[$player->getName()] - time();
                  $player->sendMessage($this->prefix . "§cHãy chờ thêm §e" . $time . "§c giây nữa !");
                }else{
                  unset($this->kit2[$player->getName()]);
                }
              }
            }else{
              $player->sendMessage($this->prefix . " §cBạn không đủ slot để add hộp kit, hãy quay lại sau !");
            }
          }else{
            $player->sendMessage($this->prefix . "§c Bạn không có quyền để nhận kit !");
          }
          break;
          
          case 2:
            if($player->hasPermission("kitvip6.kit")){
            if($player->getInventory()->canAddItem($chest3)){
              if(!isset($this->kit3[$player->getName()])){
                $this->kit3[$player->getName()] = time() + 864000;
                $player->getInventory()->addItem($chest3);
                $player->sendMessage($this->prefix . "§f➵§e  Đã nhận thành công §9HỘP KIT VIP6");
              }else{
                if(time() < $this->kit3[$player->getName()]){
                  $time = $this->kit3[$player->getName()] - time();
                  $player->sendMessage($this->prefix . "§cHãy chờ thêm §e" . $time . "§c giây nữa !");
                }else{
                  unset($thí->kit3[$player->getName()]);
                }
              }
            }else{
              $player->sendMessage($this->prefix . " §cBạn không đủ slot để add hộp kit, hãy quay lại sau !");
            }
          }else{
            $player->sendMessage($this->prefix . "§c Bạn không có quyền để nhận kit !");
          }
            break;
            
            case 3:
              if($player->hasPermission("kitvip7.kit")){
            if($player->getInventory()->canAddItem($chest4)){
              if(!isset($this->kit4[$player->getName()])){
                $this->kit4[$player->getName()] = time() + 864000;
                $player->getInventory()->addItem($chest4);
                $player->sendMessage($this->prefix . "§l§f➵§e  Đã nhận thành công §9HỘP KIT VIP7");
              }else{
                if(time() < $this->kit4[$player->getName()]){
                  $time = $this->kit4[$player->getName()] - time();
                  $player->sendMessage($this->prefix . "§cHãy chờ thêm §e" . $time . "§c giây nữa !");
                }else{
                  unset($thí->kit4[$player->getName()]);
                }
              }
            }else{
              $player->sendMessage($this->prefix . " §cBạn không đủ slot để add hộp kit, hãy quay lại sau !");
            }
          }else{
            $player->sendMessage($this->prefix . "§c Bạn không có quyền để nhận kit !");
          }
              break;
      }
    });
    $form->setTitle($this->prefix);
    $form->setContent("§e§l• 10 Ngày nhận 1 lần");
    $form->addButton("§l§c》 §9KIT VIP 4 §c《");
    $form->addButton("§l§c》 §9KIT VIP 5 §c《");
    $form->addButton("§l§c》 §9KIT VIP 6 §c《");
    $form->addButton("§l§c》 §9KIT VIP 7 §c《");
    $form->sendToPlayer($player);
    return $form;
  }
  
  public function onPlace(BlockPlaceEvent $event){
    $player = $event->getPlayer();
    $block = $event->getBlock();
    $item = $event->getItem();
    $level = $block->getLevel();
    $hand = $player->getInventory()->getItemInHand();
      //------------------------- ITEM
      //-------------------------ITEM_1
       $kiem1 = Item::get(276, 0, 1);
       $cup1 = Item::get(278, 0, 1);
       $riu1 = Item::get(279, 0, 1);
       $mu1 = Item::get(310, 0, 1);
       $giap1 = Item::get(311, 0, 1);
       $quan1 = Item::get(312, 0, 1);
       $giay1 = Item::get(313, 0, 1);
       //-------------------------ITEM_2
       $kiem2 = Item::get(276, 0, 1);
       $cup2 = Item::get(278, 0, 1);
       $riu2 = Item::get(279, 0, 1);
       $mu2= Item::get(310, 0, 1);
       $giap2 = Item::get(311, 0, 1);
       $quan2 = Item::get(312, 0, 1);
       $giay2 = Item::get(313, 0, 1);
       //------------------------ITEM_3
       $kiem3 = Item::get(276, 0, 1);
       $cup3 = Item::get(278, 0, 1);
       $riu3 = Item::get(279, 0, 1);
       $mu3 = Item::get(310, 0, 1);
       $giap3 = Item::get(311, 0, 1);
       $quan3 = Item::get(312, 0, 1);
       $giay3 = Item::get(313, 0, 1);
       //------------------------ITEM_4
       $kiem4 = Item::get(276, 0, 1);
       $cup4 = Item::get(278, 0, 1);
       $riu4 = Item::get(279, 0, 1);
       $mu4 = Item::get(310, 0, 1);
       $giap4 = Item::get(311, 0, 1);
       $quan4 = Item::get(312, 0, 1);
       $giay4 = Item::get(313, 0, 1);
       //----------------------ENCHANTS
       $sharpness = Enchantment::getEnchantment(9);
       $eff = Enchantment::getEnchantment(15);
       $fortune = Enchantment::getEnchantment(18);
       $break = Enchantment::getEnchantment(17);
       $fire = Enchantment::getEnchantment(13);
       $flame = Enchantment::getEnchantment(21);
       $power = Enchantment::getEnchantment(19);
       $knockback = Enchantment::getEnchantment(12);
       $protect = Enchantment::getEnchantment(0);
       $blast_protect = Enchantment::getEnchantment(3);
       $projectile_protect = Enchantment::getEnchantment(4);
       //----------------------SetName
  
 /*1*/     $kiem1->setCustomName("§a§l• KIT VIP4 •");
       $cup1->setCustomName("§a§l• KIT VIP4 •");
       $riu1->setCustomName("§a§l• KIT VIP4 •");
       $mu1->setCustomName("§a§l• KIT VIP4 •");
       $giap1->setCustomName("§a§l• KIT VIP4 •");
       $quan1->setCustomName("§a§l• KIT VIP4 •");
       $giay1->setCustomName("§a§l• KIT VIP4 •");
  /*2*/     $kiem2->setCustomName("§a§l• KIT VIP5 •");
    $cup2->setCustomName("§a§l• KIT VIP5 •");
    $riu2->setCustomName("§a§l• KIT VIP5 •");
    $mu2->setCustomName("§a§l• KIT VIP5 •");
       $giap2->setCustomName("§a§l• KIT VIP5 •");
       $quan2->setCustomName("§a§l• KIT VIP5 •");
       $giay2->setCustomName("§a§l• KIT VIP5 •");
 /*3*/ $kiem3->setCustomName("§a§l• KIT VIP6 •");
       $cup3->setCustomName("§a§l• KIT VIP6 •");
       $riu3->setCustomName("§a§l• KIT VIP6 •");
       $mu3->setCustomName("§a§l• KIT VIP6 •");
       $giap3->setCustomName("§a§l• KIT VIP6 •");
       $quan3->setCustomName("§a§l• KIT VIP6 •");
       $giay3->setCustomName("§a§l• KIT VIP6 •"); 
 /*4*/ $kiem4->setCustomName("§a§l• KIT VIP6 •");
       $cup4->setCustomName("§a§l• KIT VIP7 •");
       $riu4->setCustomName("§a§l• KIT VIP7 •");
       $mu4->setCustomName("§a§l• KIT VIP7 •");
       $giap4->setCustomName("§a§l• KIT VIP7 •");
       $quan4->setCustomName("§a§l• KIT VIP7 •");
       $giay4->setCustomName("§a§l• KIT VIP7 •"); 
       //------------------CustomEnchant
       $jackpot = CustomEnchantManager::getEnchantmentByName("Jackpot");
       $haste = CustomEnchantManager::getEnchantmentByName("Haste");
       $antiknockback = CustomEnchantManager::getEnchantmentByName("AntiKnockback");
       $poison = CustomEnchantManager::getEnchantmentByName("Poison");
       $lightning = CustomEnchantManager::getEnchantmentByName("Lightning");
       $wither = CustomEnchantManager::getEnchantmentByName("Wither");
       $lumber = CustomEnchantManager::getEnchantmentByName("Lumberjack");
       $tank = CustomEnchantManager::getEnchantmentByName("Tank");
       //---------------------AddEnchant
   /*1*/ $kiem1->addEnchantment(new EnchantmentInstance($sharpness, 5));
   $kiem1->addEnchantment(new EnchantmentInstance($break, 15));
   $kiem1->addEnchantment(new EnchantmentInstance($fire, 5));
   $cup1->addEnchantment(new EnchantmentInstance($break, 15));
   $cup1->addEnchantment(new EnchantmentInstance($eff, 6));
   $cup1->addEnchantment(new EnchantmentInstance($fortune, 4));
   $riu1->addEnchantment(new EnchantmentInstance($break, 15));
   $riu1->addEnchantment(new EnchantmentInstance($eff, 6));
    $mu1->addEnchantment(new EnchantmentInstance($protect, 5));
    $mu1->addEnchantment(new EnchantmentInstance($blast_protect, 5));
    $mu1->addEnchantment(new EnchantmentInstance($projectile_protect, 5));
    $mu1->addEnchantment(new EnchantmentInstance($break, 15));
    $giap1->addEnchantment(new EnchantmentInstance($protect, 5));
    $giap1->addEnchantment(new EnchantmentInstance($blast_protect, 5));
    $giap1->addEnchantment(new EnchantmentInstance($projectile_protect, 5));
    $giap1->addEnchantment(new EnchantmentInstance($break, 15));
    $quan1->addEnchantment(new EnchantmentInstance($protect, 5));
    $quan1->addEnchantment(new EnchantmentInstance($blast_protect, 5));
    $quan1->addEnchantment(new EnchantmentInstance($projectile_protect, 5));
    $quan1->addEnchantment(new EnchantmentInstance($break, 15));
    $giay1->addEnchantment(new EnchantmentInstance($protect, 5));
    $giay1->addEnchantment(new EnchantmentInstance($blast_protect, 5));
    $giay1->addEnchantment(new EnchantmentInstance($projectile_protect, 5));
    $giay1->addEnchantment(new EnchantmentInstance($break, 15));
/*2*/ $kiem2->addEnchantment(new EnchantmentInstance($sharpness, 10));
   $kiem2->addEnchantment(new EnchantmentInstance($break, 25));
   $kiem2->addEnchantment(new EnchantmentInstance($fire, 10));
   $kiem2->addEnchantment(new EnchantmentInstance($knockback, 1));
   $cup2->addEnchantment(new EnchantmentInstance($break, 25));
   $cup2->addEnchantment(new EnchantmentInstance($eff, 10));
   $cup2->addEnchantment(new EnchantmentInstance($fortune, 6));
   $riu2->addEnchantment(new EnchantmentInstance($break, 25));
   $riu2->addEnchantment(new EnchantmentInstance($eff, 10));
   $mu2->addEnchantment(new EnchantmentInstance($protect, 10));
    $mu2->addEnchantment(new EnchantmentInstance($blast_protect, 10));
    $mu2->addEnchantment(new EnchantmentInstance($projectile_protect, 10));
    $mu2->addEnchantment(new EnchantmentInstance($break, 25));
    $giap2->addEnchantment(new EnchantmentInstance($protect, 10));
    $giap2->addEnchantment(new EnchantmentInstance($blast_protect, 10));
    $giap2->addEnchantment(new EnchantmentInstance($projectile_protect, 10));
    $giap2->addEnchantment(new EnchantmentInstance($break, 25));
    $quan2->addEnchantment(new EnchantmentInstance($protect, 10));
    $quan2->addEnchantment(new EnchantmentInstance($blast_protect, 10));
    $quan2->addEnchantment(new EnchantmentInstance($projectile_protect, 10));
    $quan2->addEnchantment(new EnchantmentInstance($break, 25));
    $giay2->addEnchantment(new EnchantmentInstance($protect, 10));
    $giay2->addEnchantment(new EnchantmentInstance($blast_protect, 10));
    $giay2->addEnchantment(new EnchantmentInstance($projectile_protect, 10));
    $giay2->addEnchantment(new EnchantmentInstance($break, 25));
/*3*/ $kiem3->addEnchantment(new EnchantmentInstance($sharpness, 20));
   $kiem3->addEnchantment(new EnchantmentInstance($break, 35));
   $kiem3->addEnchantment(new EnchantmentInstance($fire, 15));
   $kiem3->addEnchantment(new EnchantmentInstance($knockback, 1));
   $kiem3->addEnchantment(new EnchantmentInstance($poison, 1));
   $kiem3->addEnchantment(new EnchantmentInstance($wither, 1));
   $kiem3->addEnchantment(new EnchantmentInstance($lightning, 1));
   $cup3->addEnchantment(new EnchantmentInstance($break, 35));
   $cup3->addEnchantment(new EnchantmentInstance($eff, 20));
   $cup3->addEnchantment(new EnchantmentInstance($fortune, 8));
   $cup3->addEnchantment(new EnchantmentInstance($jackpot, 1));
   $cup3->addEnchantment(new EnchantmentInstance($haste, 1));
   $riu3->addEnchantment(new EnchantmentInstance($break, 35));
   $riu3->addEnchantment(new EnchantmentInstance($eff, 20));
   $riu3->addEnchantment(new EnchantmentInstance($lumber, 2));
   $mu3->addEnchantment(new EnchantmentInstance($protect, 20));
    $mu3->addEnchantment(new EnchantmentInstance($blast_protect, 20));
    $mu3->addEnchantment(new EnchantmentInstance($projectile_protect, 20));
    $mu3->addEnchantment(new EnchantmentInstance($break, 35));
    $mu3->addEnchantment(new EnchantmentInstance($antiknockback, 1));
    $mu3->addEnchantment(new EnchantmentInstance($tank, 1));
    $giap3->addEnchantment(new EnchantmentInstance($protect, 20));
    $giap3->addEnchantment(new EnchantmentInstance($blast_protect, 20));
    $giap3->addEnchantment(new EnchantmentInstance($projectile_protect, 20));
    $giap3->addEnchantment(new EnchantmentInstance($break, 35));
    $giap3->addEnchantment(new EnchantmentInstance($antiknockback, 1));
    $giap3->addEnchantment(new EnchantmentInstance($tank, 1));
    $quan3->addEnchantment(new EnchantmentInstance($protect, 20));
    $quan3->addEnchantment(new EnchantmentInstance($blast_protect, 20));
    $quan3->addEnchantment(new EnchantmentInstance($projectile_protect, 20));
    $quan3->addEnchantment(new EnchantmentInstance($break, 35));
    $quan3->addEnchantment(new EnchantmentInstance($antiknockback, 1));
    $quan3->addEnchantment(new EnchantmentInstance($tank, 1));
    $giay3->addEnchantment(new EnchantmentInstance($protect, 20));
    $giay3->addEnchantment(new EnchantmentInstance($blast_protect, 20));
    $giay3->addEnchantment(new EnchantmentInstance($projectile_protect, 20));
    $giay3->addEnchantment(new EnchantmentInstance($break, 35));
    $giay3->addEnchantment(new EnchantmentInstance($antiknockback, 1));
    $giay3->addEnchantment(new EnchantmentInstance($tank, 1));
 /*4*/ $kiem4->addEnchantment(new EnchantmentInstance($sharpness, 30));
   $kiem4->addEnchantment(new EnchantmentInstance($break, 50));
   $kiem4->addEnchantment(new EnchantmentInstance($fire, 25));
   $kiem4->addEnchantment(new EnchantmentInstance($knockback, 1));
   $kiem4->addEnchantment(new EnchantmentInstance($poison, 2));
   $kiem4->addEnchantment(new EnchantmentInstance($wither, 2));
   $kiem4->addEnchantment(new EnchantmentInstance($lightning, 2));
   $cup4->addEnchantment(new EnchantmentInstance($break, 50));
   $cup4->addEnchantment(new EnchantmentInstance($eff, 30));
   $cup4->addEnchantment(new EnchantmentInstance($fortune, 15));
   $cup4->addEnchantment(new EnchantmentInstance($jackpot, 2));
   $cup4->addEnchantment(new EnchantmentInstance($haste, 2));
   $riu4->addEnchantment(new EnchantmentInstance($break, 50));
   $riu4->addEnchantment(new EnchantmentInstance($eff, 30));
   $riu4->addEnchantment(new EnchantmentInstance($lumber, 2));
   $mu4->addEnchantment(new EnchantmentInstance($protect, 30));
    $mu4->addEnchantment(new EnchantmentInstance($blast_protect, 30));
    $mu4->addEnchantment(new EnchantmentInstance($projectile_protect, 30));
    $mu4->addEnchantment(new EnchantmentInstance($break, 50));
    $mu4->addEnchantment(new EnchantmentInstance($antiknockback, 1));
    $mu4->addEnchantment(new EnchantmentInstance($tank, 2));
    $giap4->addEnchantment(new EnchantmentInstance($protect, 30));
    $giap4->addEnchantment(new EnchantmentInstance($blast_protect, 30));
    $giap4->addEnchantment(new EnchantmentInstance($projectile_protect, 30));
    $giap4->addEnchantment(new EnchantmentInstance($break, 50));
    $giap4->addEnchantment(new EnchantmentInstance($antiknockback, 1));
    $giap4->addEnchantment(new EnchantmentInstance($tank, 2));
    $quan4->addEnchantment(new EnchantmentInstance($protect, 30));
    $quan4->addEnchantment(new EnchantmentInstance($blast_protect, 30));
    $quan4->addEnchantment(new EnchantmentInstance($projectile_protect, 30));
    $quan4->addEnchantment(new EnchantmentInstance($break, 55));
    $quan4->addEnchantment(new EnchantmentInstance($antiknockback, 1));
    $quan4->addEnchantment(new EnchantmentInstance($tank, 2));
    $giay4->addEnchantment(new EnchantmentInstance($protect, 30));
    $giay4->addEnchantment(new EnchantmentInstance($blast_protect, 30));
    $giay4->addEnchantment(new EnchantmentInstance($projectile_protect, 30));
    $giay4->addEnchantment(new EnchantmentInstance($break, 50));
    $giay4->addEnchantment(new EnchantmentInstance($antiknockback, 1));
    $giay4->addEnchantment(new EnchantmentInstance($tank, 2));
    //------------------Make Array
    $kitkov = [$kiem1, $cup1, $riu1, $mu1, $giap1, $quan1, $giay1];
    $kitkovchampion = [$kiem2, $cup2, $riu2, $mu2, $giap2, $quan2, $giay2];
    $kitkovmaster = [$kiem3, $cup3, $riu3, $mu3, $giap3, $quan3, $giay3];
    $kitkovgod = [$kiem4, $cup4, $riu4, $mu4, $giap4, $quan4, $giay4];
    //------------------Place And Drop
    if($item->getId() === 54 and $item->getCustomName() === "§l§c✘§eHỘP KIT VIP4§c✘"){
      $event->setCancelled();
     $player->getInventory()->removeItem($hand);
     foreach($kitkov as $kitkovp){
       $level->dropItem($block, $kitkovp);
     }
    }
    if($item->getId() === 54 and $item->getCustomName() === "§l§c✘§eHỘP KIT VIP5§c✘"){
      $event->setCancelled();
     $player->getInventory()->removeItem($hand);
     foreach($kitkovchampion as $kitkovchampionp){
       $level->dropItem($block, $kitkovchampionp);
     }
    }
    if($item->getId() === 54 and $item->getCustomName() === "§l§c✘§eHỘP KIT VIP6§c✘"){
     $event->setCancelled();
     $player->getInventory()->removeItem($hand);
     foreach($kitkovmaster as $kitkovmasterp){
       $level->dropItem($block, $kitkovmasterp);
     }
    }
    if($item->getId() === 54 and $item->getCustomName() === "§l§c✘§eHỘP KIT VIP7§c✘"){
     $event->setCancelled();
     $player->getInventory()->removeItem($hand);
     foreach($kitkovgod as $kitkovgodp){
       $level->dropItem($block, $kitkovgodp);
     }
    }
  }
}