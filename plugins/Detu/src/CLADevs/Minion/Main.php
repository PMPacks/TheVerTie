<?php

declare(strict_types=1);

namespace CLADevs\Minion;

use CLADevs\Minion\minion\Minion as Mini;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\entity\Entity;
use pocketmine\item\Item;
use CLADevs\Minion\EventListener as Ev;
use pocketmine\utils\Config;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as C;

class Main extends PluginBase{

	private static $instance;
	private $nosell = [];

	public function onLoad(): void{
		self::$instance = $this;
	}
	
	public static function getInstance(){
		return self::$instance;
	}

	public function onEnable(): void{
	    Entity::registerEntity(Mini::class, true);
	    $this->saveDefaultConfig();
	    $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
    $files = array("sell.yml", "messages.yml");
		foreach($files as $file){
			if(!file_exists($this->getDataFolder() . $file)) {
				@mkdir($this->getDataFolder());
				file_put_contents($this->getDataFolder() . $file, $this->getResource($file));
			}
		}
		$this->sell = new Config($this->getDataFolder() . "sell.yml", Config::YAML);
	$sell = $this->sell;
	}
	
	public function onJoin (PlayerJoinEvent $j)
	{
	    $player = $j->getPlayer()->getName();
		$this->nosell[$player] = "on";
	}

	public static function get(): self{
		return self::$instance;
	}
	
	public function mode($player){
		return $this->nosell[$player] ?? "on";
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
	    if($command->getName() === "detu"){
          if($sender->hasPermission("detu.cmd"))
	           if($sender instanceof ConsoleCommandSender){
	               if(!isset($args[0])){
                    $sender->sendMessage("Usage: /detu <player>");
                    return false;
                }
	           if(!$p = $this->getServer()->getPlayer($args[0])){
	                $sender->sendMessage(C::RED . "§l§c♥ §aĐệ Tử§b → Không Tìm Được Tên Của Người Chơi Này");
	                return false;
                }
	            $this->giveItem($p);
	            return false;
            }elseif($sender instanceof Player){
	                if(isset($args[0])){
                    if(!$p = $this->getServer()->getPlayer($args[0])){
                        $sender->sendMessage(C::RED . "§l§c♥ §aĐệ Tử§b → Không Tìm Được Tên Của Người Chơi Này.");
                        return false;
                        }
                    $this->giveItem($p);
                    return false;
                    }
	            $this->giveItem($sender);
	            return false;
            }
            return true;
	    }elseif(strtolower($command->getName()) == "detusellmessage") {
           if($sender->hasPermission("detusellmessage.command")) {
           if(!isset($args[0])){
               $sender->sendMessage("§l§c♥ §aSellMessage§b → Thường Dùng: /detusellmessage <on|off>");
               return false;
           }
           switch ($args[0]) {
               case "on":
			       $sender->sendMessage("§l§c♥ §aSellMessage§b → §aĐang Bật ");
				   $this->nosell[$sender->getName()] = "on";
				   $sender->getInventory()->setSize(65);
				   break;

               case "off":
			       $sender->sendMessage("§l§c♥ §aSellMessage§b → §aĐã Tắt "); 
                   $this->nosell[$sender->getName()] = "off";
				   break;
               default :
                   $sender->sendMessage("§l§c♥ §aSellMessage§b → Thường Dùng: /detusellmessage <on|off>");
                   break;
           }
       }
       
       return true;
    }elseif(strtolower($command->getName()) == "tatketnoi"){
    Ev::getEv($sender);
    return true;
    }
    }
    
    public function onQuit(PlayerQuitEvent $e){
       $a = "detusellmessage on";
       $this->getServer()->dispatchCommand($e->getPlayer(),$a);
    }

    public function giveItem(Player $sender): void{
	    $sender->getInventory()->addItem($this->getItem($sender));
	    $sender->sendMessage(C::GREEN . "Bạn Đã Nhận Được 1 Đệ Tử");
    }

    public function getItem(Player $sender, int $level = 1, string $eter = "no", string $autofix = "no", string $xyz = "n"): Item{
        $item = Item::get(Item::NETHER_STAR);
        $item->setCustomName(C::BOLD . C::AQUA . "* " . C::GOLD . "Đệ " . C::AQUA . "Tử" . " *");
        $item->setLore(
            [
                " ",
                C::GRAY . "* " . C::YELLOW . "Nhấn Để Đặt Tôi Ra",
                C::GRAY . "* " . C::YELLOW . "Tôi Sẽ Đào Khối Ở Trước Mặt",
                C::GRAY . "* " . C::YELLOW . "Nhớ Kết Nối Rương Để Tôi Bỏ Đồ Vào",
                C::GRAY . "* " . C::YELLOW . "Tôi Sẽ Giúp Bạn Kiếm Tiền Dễ Hơn",
                "§lLevel: §r$level",
                "§l§6Eternity: §r§6$eter",
                "§l§eAutoFix: §r§e$autofix"
            ]
        );
        $nbt = $item->getNamedTag();
        $nbt->setString("summon", "miner");
        $nbt->setString("player", $sender->getName());
        $nbt->setString("xyz", $xyz);
        $nbt->setString("eternity", $eter);
        $nbt->setInt("level", $level);
        $nbt->setString("autofix", $autofix);
        $item->setNamedTag($nbt);
        return $item;
    }
}
