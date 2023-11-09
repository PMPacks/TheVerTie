<?php

namespace huongdanmem\huongdan;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;
use pocketmine\utils\TextFormat as C;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;

use pocketmine\utils\Config;
use jojoe77777\FormAPI;
use jojoe77777\FormAPI\SimpleForm;

class Main extends PluginBase implements Listener{

    public function onEnable(){
        $this->getLogger()->info(C::GREEN . "Plugin đã bật");
    }

    public function onDisable(){
        $this->getLogger()->info(C::RED . "Plugin đã tắt, vui lòng cài formapi");
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
        switch($cmd->getName()){                    
            case "huongdan":
                if($sender instanceof Player){
                    if($sender->hasPermission("huongdan.command")){
                    $this->HuongDan($sender);
                        return true;
                    }else{
                        $sender->sendMessage($this->getConfig()->get("noperm"));
                        return true;
                    }

                }else{
                    $sender->sendMessage("Dùng lệnh trong game!");
                    return true;
                } 
        }
    }

    public function HuongDan($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
                break;
                case 1:
                    $this->howtoplay($sender);
                break;
                case 2:
                    $this->aboutrules($sender);
                break;
                case 3:
                    $this->aboutboss($sender);
                break;

                }
            });
            $form->setTitle("§l§a• §2Hướng Dẫn §a•");
            $form->setContent("§e➼ Chọn 1 trong những nội dung sau để đọc\n");
            $form->addButton($this->getConfig()->get("exit-btn"));
            $form->addButton("§l§2• Lệnh Cơ Bản •");
            $form->addButton("§l§2• Cách Kiếm Tiền •");
            $form->addButton("§l§2• Cách Sử Dụng SkyBlock •");
            $form->sendToPlayer($sender);
            return $form;
    }

    public function howtoplay($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
            $command = "huongdan" ;
            $this->getServer()->getCommandMap()->dispatch($sender, $command);
                break;

                }
            });
            $form->setTitle("§l§a• §2Lệnh Cơ Bản §a•");
            $form->setContent($this->getConfig()->get("howtoplay-info"));
            $form->addButton($this->getConfig()->get("return-btn"));
            $form->sendToPlayer($sender);
            return $form;
    }

    public function aboutrules($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
            $command = "huongdan" ;
            $this->getServer()->getCommandMap()->dispatch($sender, $command);
                break;

                }
            });
            $form->setTitle("§l§a• §2Cách Kiếm Tiền §l§a•");
            $form->setContent($this->getConfig()->get("aboutrules-info"));
            $form->addButton($this->getConfig()->get("return-btn"));
            $form->sendToPlayer($sender);
            return $form;
    }

    public function aboutboss($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
            $command = "huongdan" ;
            $this->getServer()->getCommandMap()->dispatch($sender, $command);
                break;

                }
            });
            $form->setTitle("§l§a• §2Cách Sử Dụng SkyBlock §a•");
            $form->setContent($this->getConfig()->get("aboutboss-info"));
            $form->addButton($this->getConfig()->get("return-btn"));
            $form->sendToPlayer($sender);
            return $form;
    }

}