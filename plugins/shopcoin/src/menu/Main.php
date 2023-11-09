<?php

namespace menu;

use pocketmine\Player;
use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\command\{Command, CommandSender, ConsoleCommandSender};

Class Main extends PluginBase implements Listener{
	
	public function onEnable():void{
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
        $this->saveDefaultConfig();
        $this->saveResource("menu.yml");
        @mkdir($this->getDataFolder(), 0744, true);
       $this->menu = new Config($this->getDataFolder()."menu.yml",Config::YAML);        
    }
    
	public function onCommand(CommandSender $sender, Command $command, String $label, array $args) : bool {
        switch($command->getName()){
            case "shopcoin":
                $this->menu($sender);
           return true;
        }
        return true;
	}
                
    public function menu($sender){
        $formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $formapi->createSimpleForm(function(Player $sender, $data){
          $result = $data;
          if($result == null){
          return;
          }
          $command = $this->menu->get(strtolower($data))["command"]; 
          $cm = str_replace(["{player}"], [$sender->getName(), ''], $command);
          $this->getServer()->getCommandMap()->dispatch($sender, $cm);
        });
        for($i = 0;$i <= 20 ;$i++){
            if($this->menu->exists($i)){
               $form->addButton($this->menu->get(strtolower($i))["button"]); 
            }
        }
        $form->setTitle("§l§f•§b ShopCoin §f•");
        $form->sendToPlayer($sender);
	}
}
