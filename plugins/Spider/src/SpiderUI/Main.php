<?php

#=========================================================================================================================#

namespace SpiderUI;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\protocol\ModalFormResponsePacket;

#=========================================================================================================================#

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;

#=========================================================================================================================#

use pocketmine\event\player\PlayerQuitEvent;

#=========================================================================================================================#

use SpiderUI\FormEvent\Form;
use SpiderUI\FormEvent\SimpleForm;

#=========================================================================================================================#


class Main extends PluginBase implements Listener
{

#=========================================================================================================================#

    public $formCount = 0;
    public $forms = [];

#=========================================================================================================================#

    public function onEnable() : void {
     $this->getLogger()->info("Plugin Việt Hóa 99℅ By PIG ");
     $this->formCount = rand(0, 0xFFFFFFFF);
     $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

#=========================================================================================================================#

    public function createSimpleForm(callable $function = null) : SimpleForm {
     $this->formCountBump();
     $form = new SimpleForm($this->formCount, $function);
     $this->forms[$this->formCount] = $form;
     return $form;
    }

#=========================================================================================================================#

    public function formCountBump() : void {
     ++$this->formCount;
     if($this->formCount & (1 << 32)){
      $this->formCount = rand(0, 0xFFFFFFFF);
     }
  }

#=========================================================================================================================#

    public function onPacketReceived(DataPacketReceiveEvent $ev) : void {
     $pk = $ev->getPacket();
     if($pk instanceof ModalFormResponsePacket){
      $player = $ev->getPlayer();
      $formId = $pk->formId;
      $data = json_decode($pk->formData, true);
      if(isset($this->forms[$formId])){
       $form = $this->forms[$formId];
       if(!$form->isRecipient($player)){
        return;
       }
       $callable = $form->getCallable();
       if(!is_array($data)){
        $data = [$data];
       }
       if($callable !== null) {
        $callable($ev->getPlayer(), $data);
       }
       unset($this->forms[$formId]);
       $ev->setCancelled();
       }
    }
 }

#=========================================================================================================================#

    public function onPlayerQuit(PlayerQuitEvent $ev) {
     $player = $ev->getPlayer();
     foreach ($this->forms as $id => $form) {
      if($form->isRecipient($player)) {
       unset($this->forms[$id]);
       break;
      }
   }
}

#=========================================================================================================================#

    public function SpiderMenu($player): void{
     $form = $this->createSimpleForm(function (Player $player, array $data) {
     if (isset($data[0])){
      $scat = $data[0];
       switch ($scat) {
        case 0:
        break;
        return true;
        case 1:
         $player->setCanClimbWalls(true);
         $player->sendMessage("§l§bBạn Đã Bật Chế Độ Spider");
        break;
        return true;
        case 2:
         $player->setCanClimbWalls(false);
         $player->sendMessage("§l§c Bạn Đã Tắt Chế Độ Spider");
        break;
        return true;
       }
    } 
 });
 $form->setTitle("§l§9⚫§a Spider §9⚫");
 $form->setContent("§l§e•§d Hãy chọn §aBật | §6Tắt");
 $form->addButton("§l§e•§c Thoát §e•");
 $form->addButton("§l§e•§a Bật §bSpider §e•");
 $form->addButton("§l§e•§6 Tắt §bSpider §e•");
 $form->sendToPlayer($player);
 }

#=========================================================================================================================#

    public function onCommand(CommandSender $player, Command $command, string $label, array $args): bool{ 
     switch($command->getName()){
      case "spider";
       if($player instanceof Player){
        if($player->hasPermission("spider.command")){
         $this->SpiderMenu($player);
        }
     }
     break;
     }
     return true;
     }
  }

#=========================================================================================================================#