<?php

namespace phuongaz\DailyMission;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\Player;
use pocketmine\utils\Config;
use pocketmine\Server;
use pocketmine\block\{Wood, Wood2, DiamondOre, Diamond, Iron, IronOre, Gold, GoldOre, Emerald, EmeraldOre, Stone, Cobblestone, Redstone, RedstoneOre, Coal, CoalOre, Lapis, LapisOre};
use pocketmine\entity\{Animal, Monster};

use pocketmine\event\inventory\CraftItemEvent;

use pocketmine\command\{Command, CommandSender};
use jojoe77777\FormAPI\CustomForm;
use onebone\economyapi\EconomyAPI;
use SkyBlock\ZulfahmiFjr\Main;


class Mission extends PluginBase implements Listener
{
    public $data;
    public $plugin;
    public $money;

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);        
        $this->load();
        $this->plugin = $this;               
    }    

    public function load()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $this->data = new Config($this->getDataFolder() . "Data.yml", Config::YAML);
        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
        $this->money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
        if(!$this->config->exists("money")){
        $this->config->set("money",3000);
        $this->config->save();
        }
    }
    public function isToday()
    {
        if ($this->data->exists("date") && $this->data->get("date") == date("d/m/Y")) {
            return true;
        } else {
            $this->data->set("date", date("d/m/Y"));
            $Bdata = $this->data->getAll();
            foreach ($Bdata as $key => $value) {
                if ($key != "date" && $key != "nowmission") {                    
                    $this->data->set($key, 0);
                    $this->data->save();
                }               
            }
            $rand  = rand(1, 4);
            $rand2 = rand(1, 64);              
            $Ajob = "";
            $this->data->set($key, 0);
            switch ($rand) {
                case 1:
                    $Ajob = "wood";
                    break;
                case 2:
                    $Ajob = "mine";
                    break;
                case 3:
                    $Ajob = "build";
                    break;             
                case 4: 
                    $Ajob = "craft";
            }
            if($Ajob == "build"){
                $rand2 = mt_rand(10000, 15000);
                $money = $rand2*1.5; 
            }
            if($Ajob == "wood"){
                $rand2 = mt_rand(1000, 1500);
                $money = $rand2*1.8;
            }
            if($Ajob == "mine"){
                $rand2 = mt_rand(10000, 18000);
                $money = $rand2*1.4;
            }
            if($Ajob == "craft"){
                $rand2 = mt_rand(200, 500);
                $money = $rand2*10;
            }

            $this->data->set("nowmission", $Ajob);
            $this->config->set("money", $money);
            $this->data->set("checkpoint", $rand2);           
            $this->data->save();
            $this->config->save();

            return true;
        }
    }

    public function isNowmission($type)
    {
        if ($this->data->get("nowmission") == $type) {
            return true;
        } else {
            return false;
        }
    }
    public function checkProgress($player)
    {
        if ($this->data->get("checkpoint") == $this->data->get($player->getName())) {
            return true;
        } else {
            return false;
        }      
    }
    public function isFinish($player)
    {
        if ($this->data->get("checkpoint") <= $this->data->get($player->getName())) {
            return true;
        } else {
            return false;
        }        
    }

    public function toString() :string{
        $type = $this->data->get("nowmission");
        $count = $this->data->get("checkpoint");
        switch($type){
            case "craft":
                $string = "§a§lChế Tạo §e".$count." §a§lCông Cụ Bằng Kim Cương";
                break;
            case "wood":
                $string = "§a§lThu hoạch§e ".$count."§a§l Khối Gỗ";
                break;
            case "mine":
                $string = "§a§lĐào§e ".$count." §a§lLoại Quặng Bất Kì";
                break;
            case "build":
                $string = "§a§lĐặt §e".$count." §a§lKhối Bất Kì";
                break;
        }
        return $string;
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool{
        if(!$sender instanceof Player) return false;
        if($cmd->getName() == "mission"){
            $form = new CustomForm(function(Player $player, ?array $data){
                if(is_null($data)) return;
            });
            $form->setTitle("§l§3• §dNhiệm vụ §3•");
            $form->addLabel("§l§aNhiệm vụ hôm nay:§e ".$this->toString());
            $form->addLabel("§l§a• §cPhần thưởng:§e ". $this->config->get("money"). "§3§l Xu");
            $size = $this->data->get("checkpoint");
            $form->addLabel("§l§a• §cTiến độ của bạn: §e".$this->getPlayerData($sender)."§e/§e".$size);
            $form->addLabel("§l§a• §cLưu ý: Chỉ tiêu sẽ được làm mới vào ngày hôm sau");
            $form->sendToPlayer($sender);
        }
        return true;
    }

    public function getPlayerData(Player $player) {
        $data = $this->data->get($player->getName());
        return (!is_null($data)) ? $data : 0;
    }

    public function addProgress($player, $type)
    {
        $this->isToday();
        if ($this->isNowmission($type)) {
            if ($this->data->exists($player->getName())) {
                $this->data->set($player->getName(), $this->data->get($player->getName()) + 1);             
            } else {
                $this->data->set($player->getName(), 1);                            
            }
            if (!$this->isFinish($player)) {
            }
            $this->data->save();          
            if ($this->checkProgress($player)) {
                $player->sendMessage("§l§a• Bạn vừa hoàn thành chỉ tiêu trong ngày hôm nay");
                $player->sendMessage("§a§lBạn vừa được nhận:§e ".$this->config->get("money"). " §aXu!");
                Server::getInstance()->broadcastMessage("§l§a• Người chơi §e".$player->getName(). " §avừa hoàn thành chỉ tiêu ngày hôm nay và nhận được §e".$this->config->get("money"). " §aXu!");
                EconomyAPI::getInstance()->addMoney($player, $this->config->get("money"));
            }                        
        }else{
            if ($this->isFinish($player)) {
                
            }else{
            }
        }
        $this->data->save();
    }

    public function onJoin(PlayerJoinEvent $event) :void{
        $this->isToday();
        $event->getPlayer()->sendMessage("§l§d• §aChỉ tiêu hôm nay là : §e".$this->toString());
        $event->getPlayer()->sendMessage("§l§d• §aSử dụng lệnh §e/mission§f để biết thêm chi tiết");
    }

    public function onBreak(BlockBreakEvent $event)
    {
        $player = $event->getPlayer();       
        $block = $event->getBlock();
        //if($event->getPlayer()->getLevel()->getName() != "skyblock") return;
        if($event->isCancelled()) {
            return;
        }

        if ($block instanceof Wood or $block instanceof Wood2) {            
            $this->plugin->addProgress($player, "wood");                           
        } elseif ($block instanceof Diamond or $block instanceof DiamondOre or $block instanceof Iron or $block instanceof IronOre or $block instanceof Gold or $block instanceof GoldOre or $block instanceof Emerald or $block instanceof EmeraldOre or $block instanceof Stone or $block instanceof Cobblestone or $block instanceof Redstone or $block instanceof RedstoneOre or $block instanceof Coal or $block instanceof CoalOre or $block instanceof Lapis or $block instanceof LapisOre) {           
                $this->plugin->addProgress($player, "mine");           
        }
    }    
    public function onPlace(BlockPlaceEvent $event)
    {
        $player = $event->getPlayer();       
        $block = $event->getBlock();
        //if($event->getPlayer()->getLevel()->getName() != "skyblock") return;
        if($event->isCancelled()) {            
            return;        
        }

        $this->plugin->addProgress($player, "build");                   
    }

    public function onCraft(CraftItemEvent $event)
    {
        $player = $event->getPlayer();
        $items = $event->getOutputs();
        foreach($items as $item){
            if(in_array($item->getId(), [276, 277, 278, 279, 293])){
                $this->plugin->addProgress($player, "craft");
            }
        }
    }

    public function onKill(PlayerDeathEvent $event)
    {
        $entity = $event->getEntity();
        $cause  = $entity->getLastDamageCause();
        if ($cause instanceof EntityDamageByEntityEvent) {
            $player = $cause->getDamager();
            if ($player instanceof Player) {
                if ($entity instanceof Player) {
                    
                    $this->plugin->addProgress($player, "kill");                    
                }
            }
        }
    }    
}