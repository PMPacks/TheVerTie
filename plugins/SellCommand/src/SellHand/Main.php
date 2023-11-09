<?php

/*
*   _____      _ _ 
*  / ____|    | | |
* | (___   ___| | |
*  \___ \ / _ \ | |
*  ____) |  __/ | |
* |_____/ \___|_|_|
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU Lesser General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*/

namespace SellHand;

use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as TF;
use onebone\economyapi\EconomyAPI;

class Main extends PluginBase implements Listener{

	public function onLoad(){
		$this->getLogger()->info("§ePlugin Loading!");
	}

	public function onEnable(){
    	$this->getLogger()->info(TF::GREEN.TF::BOLD."
   _____      _ _ 
  / ____|    | | |
 | (___   ___| | |
  \___ \ / _ \ | |
  ____) |  __/ | |
 |_____/ \___|_|_|
 Enabled Sell by PrinxIsLequit and georgianYT.
 		");
		$files = array("sell.yml", "messages.yml");
		foreach($files as $file){
			if(!file_exists($this->getDataFolder() . $file)) {
				@mkdir($this->getDataFolder());
				file_put_contents($this->getDataFolder() . $file, $this->getResource($file));
			}
		}
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->sell = new Config($this->getDataFolder() . "sell.yml", Config::YAML);
		$this->messages = new Config($this->getDataFolder() . "messages.yml", Config::YAML);
	}

	public function onDisable(){
    	$this->getLogger()->info("§cPlugin Disabled!");
  	}

	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
		switch(strtolower($cmd->getName())){
			case "sell":
			// Checks if command is executed by console.
			// It further solves the crash problem.
			if(!($sender instanceof Player)){
				$sender->sendMessage(TF::RED . TF::BOLD ."Error: ". TF::RESET . TF::DARK_RED ."Please use this command in game!");
				return true;
				break;
			}

				/* Check if the player is permitted to use the command */
				if($sender->hasPermission("sell") || $sender->hasPermission("sell.hand") || $sender->hasPermission("sell.all")){
					/* Disallow non-survival mode abuse */
					if(!$sender->isSurvival()){
						$sender->sendMessage(TF::RED . TF::BOLD ."Lỗi: ". TF::RESET . TF::DARK_RED ."§cHãy chuyển sang chế độ sinh tồn.");
						return false;
					}
					
					/* Sell Hand */
					if(isset($args[0]) && strtolower($args[0]) == "hand"){
						if(!$sender->hasPermission("sell.hand")){
							$error_handPermission = $this->messages->get("error-nopermission-sellHand");
							$sender->sendMessage(TF::RED . TF::BOLD . "Lỗi: " . TF::RESET . TF::RED . $error_handPermission);
							return false;
						}
						$item = $sender->getInventory()->getItemInHand();
						$itemId = $item->getId();
						/* Check if the player is holding a block */
						if($item->getId() === 0){
							$sender->sendMessage(TF::RED . TF::BOLD ."Lỗi: ". TF::RESET . TF::DARK_RED ."§cHãy giữ 1 item trên tay để bán");
							return false;
						}
						/* Recheck if the item the player is holding is a block */
						if($this->sell->get($itemId) == null){
							$sender->sendMessage(TF::RED . TF::BOLD ."Lỗi: ". TF::RESET . TF::GREEN . $item->getName() . TF::DARK_RED ." §ckhông bán được.");
							return false;
						}
						/* Sell the item in the player's hand */
						EconomyAPI::getInstance()->addMoney($sender, $this->sell->get($itemId) * $item->getCount());
						$sender->getInventory()->removeItem($item);
						$price = $this->sell->get($item->getId()) * $item->getCount();
						$sender->sendMessage(TF::GREEN . TF::BOLD . "(!) " . TF::RESET . TF::GREEN . "$" . $price . " đã nhập vô số tiền của tiền của bạn.");
						$sender->sendMessage(TF::GREEN . "Bạn đã nhận được " . TF::RED . "$" . $price . TF::GREEN . " khi bán (" . $item->getCount() . " " . $item->getName() . " với $" . $this->sell->get($itemId) . " mỗi cái).");

					/* Sell All */
					}elseif(isset($args[0]) && strtolower($args[0]) == "all"){
						if(!$sender->hasPermission("sell.all")){
							$error_allPermission = $this->messages->get("error-nopermission-sellAll");
							$sender->sendMessage(TF::RED . TF::BOLD . "Lỗi: " . TF::RESET . TF::RED . $error_allPermission);
							return false;
						}
						$items = $sender->getInventory()->getContents();
						foreach($items as $item){
							if($this->sell->get($item->getId()) !== null && $this->sell->get($item->getId()) > 0){
								$price = $this->sell->get($item->getId()) * $item->getCount();
								EconomyAPI::getInstance()->addMoney($sender, $price);
								$sender->sendMessage("§a§l• Bạn đã nhận được số tiền : §e" . $price ." §a§lkhi bán §c" . $item->getCount() . "§b " . $item->getName());
								$sender->getInventory()->remove($item);
							}
						}
					}elseif(isset($args[0]) && strtolower($args[0]) == "about"){
						$sender->sendMessage(TF::RED . TF::BOLD . "(!) " . TF::RESET . TF::GRAY . "Server sử dụng plugin Sell Hand, bởi Muqsit Rayyan và sửa bởi georgianYT.");
					}else{
						$sender->sendMessage(TF::RED . TF::BOLD . "(!) " . TF::RESET . TF::DARK_RED . "§bCửa hàng bán đồ online");
						$sender->sendMessage(TF::RED . "§a- " . TF::DARK_RED . "§b/sell hand " . TF::GRAY . "§7->§l§e Bán vật phẩm cầm trên tay.");
						$sender->sendMessage(TF::RED . "§a- " . TF::DARK_RED . "§b/sell all " . TF::GRAY . "§7-> §l§eBán tất cả đồ có thể bán trong người.");
						return true;
					}
				}else{
					$error_permission = $this->messages->get("error-permission");
					$sender->sendMessage(TF::RED . TF::BOLD . "Lỗi: " . TF::RESET . TF::RED . $error_permission);
				}
				break;
		}
		return true;
	}
}
