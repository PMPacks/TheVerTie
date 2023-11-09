<?php

namespace jm;

use pocketmine\{Player, Server};
use pocketmine\command\{Command, CommandSender};
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener {
	
	public $playerList = [];
	
	public function onEnable() {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
	}
	
	public function onCommand(CommandSender $player, Command $cmd, string $label, array $args) : bool {
		if ($cmd->getName() === "joinui") {
			$form = $this->formapi->createSimpleForm(function (Player $player, int $data = null) {
			$result = $data;
			if ($result === null) {
			  return true; 
			  
			}
			switch ($result) {
      case 0: 
      $cmd1 = "huongdan";
		  $this->getServer()->getCommandMap()->dispatch($player, $cmd1);
				break;
			 case 1:
				$cmd2 = "tinhnang";
			 $this->getServer()->getCommandMap()->dispatch($player, $cmd2);
				break;
			case 2:
				$cmd3 = "luat";
			 $this->getServer()->getCommandMap()->dispatch($player, $cmd3);
				break;
			}
		});
		$name = $player->getName();
		$form->setTitle("§l§c• §2ＴＶＴ ＳＫＹＢＬＯＣＫ §c•");
		$form->setContent("§l§a• §eChào Bạn : §b{$name}\n§l§a• §eThông Tin Server Được Cập Nhật Tại :\n- Link: §c§lbit.do/grouptvt\n§a§l• §eVote Nhận Key Mỗi Ngày Tại :\n- Link: §c§lbit.do/thevertie\n");
		$form->addButton("§l§2• Hướng Dẫn Chơi •");
		$form->addButton("§l§2• Tính Năng •");
		$form->addButton("§l§2• Luật Máy Chủ •");
		$form->sendToPlayer($player);
		}
    return true;
			}
		}