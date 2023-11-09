<?php

namespace Fly;

use pocketmine\{
    Player,
    event\Listener,
    plugin\PluginBase,
    event\entity\EntityLevelChangeEvent};
use pocketmine\command\{Command, CommandSender};
use pocketmine\event\player\PlayerCommandPreprocessEvent;

class Main extends PluginBase implements Listener {

    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool {
        if(strtolower($cmd->getName()) === "fly")
            if(empty($args)) {
                if(!$sender->hasPermission("fly.command")) {
                    $sender->sendMessage("§r⨞§l§c Vui Lòng Sử Dụng Lệnh Trong Trò Chơi!");
                    return true;
                }else{
                    if(!$sender instanceof Player) {
                        $sender->sendMessage("§r⨞§l§c Vui Lòng Sử Dụng Lệnh Trong Trò Chơi!");
                        return true;
                    }

                    if($sender->getAllowFlight()) {
                        $sender->setFlying(false);
                        $sender->setAllowFlight(false);
                        $sender->sendMessage("§r⨞§l§a Đã Kích Hoạt Trạng Thái Phi Hành!");
                        return true;
                    }else{
                        $sender->setAllowFlight(true);
                        $sender->sendMessage("§r⨞§l§c Đã Vô Hiệu Hóa Trạng Thái Phi Hành!");
                        return true;
                    }
                }
            }
            return false;
        }

/*        public function onChangeWorld(EntityLevelChangeEvent $event){
            if(!in_array($event->getEntity()->getName(), array("Steve", "NhanAZ"))){
                $event->getEntity()->setFlying(false);
                $event->getEntity()->setAllowFlight(false);
            }
        }

        public function onCommandPreProcess(PlayerCommandPreprocessEvent $event) {
            $args = explode(" ", $event->getMessage());
            if(!in_array($event->getPlayer()->getName(), array("Steve", "NhanAZ"))){
                if(in_array($args[0], array("/tp", "/fly"))) {
                    if($event->getPlayer()->getLevel()->getName() == "PvP") {
                        $event->getPlayer()->sendMessage("Lệnh này bị cấm tại khu vực này!");
                        $event->setCanCelled();
                    }
                }
            }
        }*/
    }