<?php

namespace VanishPro;

//ALL OUR IMPORTS
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\Player;

class Main extends PluginBase implements Listener{

    public function onEnable() : void{
        $this->getLogger()->info("VanishPro by PerhapsPlatypus has been enabled! :)");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    
    public function onCommand(CommandSender $issuer, Command $command, string $label, array $args) : bool {
        switch($command->getName()){
            case "vanishpro":
                if($issuer->hasPermission('pp.vanish')){
                    $issuer->sendMessage("§l§6• Bạn đang sử dụng ẩn thân chi thuật!");
                    $this->vanish($issuer);
                }else{
                    $issuer->sendMessage("§l§c• Bạn không có quyền để sử dụng câu lệnh này");
                }
                return true;
            case "unvanishpro":
                if($issuer->hasPermission('pp.vanish')){
                    $issuer->sendMessage("§l§6• Bạn đang không sử dụng ẩn thân chi thuật!");
                    $this->unVanish($issuer);
                }
                return true;
            default:
                return false;
        }
    }

    public function vanish(Player $player){
        $online = $this->getServer()->getOnlinePlayers();
        foreach ($online as $players){
            $players->hidePlayer($player);
        }
    }

    public function unVanish(Player $player){
        $online = $this->getServer()->getOnlinePlayers();
        foreach ($online as $players){
            $players->showPlayer($player);
        }
    }
}