<?php

namespace KeyShopUI;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\utils\Config;
use onebone\economyapi\EconomyAPI;
use jojoe77777\FormAPI;
use jojoe77777\FormAPI\SimpleForm;

class Main extends PluginBase implements Listener {
	
	public function onEnable(){
		$this->getLogger()->info("Enable Plugin ShopKey By Vbee");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label,array $args): bool{
		switch($cmd->getName()){
			case "shopkey":
			if(!$sender instanceof Player){
			$sender->sendMessage("Sử dụng lệnh trong game");
			return false;
			}
			if($sender instanceof Player){
			$this->shopFrom($sender);
			}
			break;		
		}
		return true;
	}
	
	public function shopFrom(Player $player){
		$form = new SimpleForm(function (Player $player, $data){
		$result = $data;
		if($result === null){
			return true;
			}
			switch($result){
				case 0:
					if(\pocketmine\Server::getInstance()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($player) >= $this->getConfig()->get("common.price")){
						$this->getServer()->dispatchCommand(new \pocketmine\command\ConsoleCommandSender(), "key Common ".$player->getName()." ".$this->getConfig()->get("common.amount"));
						$player->sendMessage($this->getConfig()->get("common.success.purchase"));
						EconomyAPI::getInstance()->reduceMoney($player, $this->getConfig()->get("common.price"));
					} else {
						$player->sendMessage($this->getConfig()->get("not.enough.coin"));
					}
				break;
				case 1:
					if(\pocketmine\Server::getInstance()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($player) >= $this->getConfig()->get("uncommon.price")){
						$this->getServer()->dispatchCommand(new \pocketmine\command\ConsoleCommandSender(), "key UnCommon ".$player->getName()." ".$this->getConfig()->get("uncommon.amount"));
						$player->sendMessage($this->getConfig()->get("uncommon.success.purchase"));
						EconomyAPI::getInstance()->reduceMoney($player, $this->getConfig()->get("uncommon.price"));
					} else {
						$player->sendMessage($this->getConfig()->get("not.enough.coin"));
					}
				break;
				case 2:
					if(\pocketmine\Server::getInstance()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($player) >= $this->getConfig()->get("mythic.price")){
						$this->getServer()->dispatchCommand(new \pocketmine\command\ConsoleCommandSender(), "key Mythic ".$player->getName()." ".$this->getConfig()->get("mythic.amount"));
						$player->sendMessage($this->getConfig()->get("mythic.success.purchase"));
						EconomyAPI::getInstance()->reduceMoney($player, $this->getConfig()->get("mythic.price"));
					} else {
						$player->sendMessage($this->getConfig()->get("not.enough.coin"));
					}
				break;
				case 3:
					if(\pocketmine\Server::getInstance()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($player) >= $this->getConfig()->get("legendary.price")){
						$this->getServer()->dispatchCommand(new \pocketmine\command\ConsoleCommandSender(), "key Legendary ".$player->getName()." ".$this->getConfig()->get("legendary.amount"));
						$player->sendMessage($this->getConfig()->get("legendary.success.purchase"));
						EconomyAPI::getInstance()->reduceMoney($player, $this->getConfig()->get("legendary.price"));
					} else {
						$player->sendMessage($this->getConfig()->get("not.enough.coin"));
					}
				break;
          case 4:
				  if(\pocketmine\Server::getInstance()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($player) >= $this->getConfig()->get("lucky.price")){
														$this->getServer()->dispatchCommand(new \pocketmine\command\ConsoleCommandSender(), "key Lucky ".$player->getName()." ".$this->getConfig()->get("lucky.amount"));
														$player->sendMessage($this->getConfig()->get("lucky.success.purchase"));
														EconomyAPI::getInstance()->reduceMoney($player, $this->getConfig()->get("lucky.price"));
													} else {
														$player->sendMessage($this->getConfig()->get("not.enough.coin"));
													}
												break;
			}
		});
		$config = $this->getConfig();
		$this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($player);
		$form->setTitle("§l§d• Shop§eKey •");
		$form->setContent("§l§e➛ §aXin chào , §f". $player->getName(). "\n§aXu Hiện Tại : §f" . $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($player). "\n§aRank : §f". $this->getServer()->getPluginManager()->getPlugin("PurePerms")->getUserDataMgr()->getGroup($player)->getName() . "\n§aNhớ vote cho server tại : bit.do/thevertie");
		$form->addButton("§l§c• Common •\n§aGiá: 50.000§e Xu",1,"https://cdn-icons-png.flaticon.com/512/2829/2829831.png");
		$form->addButton("§l§c• UnCommon •\n§aGiá: 70.000§e Xu", 1,"https://cdn-icons-png.flaticon.com/512/2825/2825855.png");
		$form->addButton("§l§c• Mythic •\n§aGiá: 100.000§e Xu", 1,"https://cdn-icons-png.flaticon.com/512/720/720119.png");
		$form->addButton("§l§c• Legendary •\n§aGiá: 120.000§e Xu", 1,"https://cdn-icons-png.flaticon.com/512/5999/5999631.png");
		$form->addButton("§l§c• Lucky •\n§aGiá: 150.000 §eXu",1,"https://cdn-icons-png.flaticon.com/512/3925/3925175.png");
		$form->sendToPlayer($player);
	}
}
