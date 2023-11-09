<?php

namespace DafaRahestian\HealFeed;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;

class Main extends PluginBase {

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{
        if($sender instanceof Player){
            if($sender->hasPermission("heal.command")){
                if($cmd->getName() == "heal"){
                    $sender->setHealth($sender->getMaxHealth());
                    $sender->sendMessage("§a Hồi thành công .");
                }
            }
            if($sender->hasPermission("feed.command")){
                if($cmd->getName() == "feed"){
                    $sender->setFood(20);
                    $sender->setSaturation(20);
                    $sender->sendMessage("§a Hồi thành công.");
                }
            }
        }
        return true;
    }
}
