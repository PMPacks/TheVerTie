<?php

namespace phuongaz\AuraBoss;

use phuongaz\AuraBoss\Boss;
use pocketmine\Server;
use pocketmine\Command\{Command,CommandSender};
use pocketmine\Player;
use jojoe77777\FormAPI\{
	CustomForm,
	SimpleForm
};
use pocketmine\utils\TextFormat as TF;

use phuongaz\AuraBoss\Entity\LvlEntity;
Class BossCommands extends Command{

	private $main;

	public function __construct(Boss $main){
		parent::__construct("boss", "tạo boss/triệu hồi boss", "/boss");
		$this->main = $main;
	}

	public function execute(CommandSender $sender, string $label, array $args):bool {
		if($sender instanceof Player){
			if(!$sender->isOp()) return true;
			$this->openForm($sender);	
		} 
		if(isset($args[0]) and $args[0] == 'clear-all'){
			$sender->sendMessage("Tất cả các boss đã được xóa");
			$this->main->clearAllBoss();
		}
		if(isset($args[0]) and $args[0] == 'spawn-all'){
			$this->main->spawnAllBoss();
		}
		if(isset($args[0]) and $args[0] == 'cooldown' and isset($args[1]) and isset($args[2])){
			$this->main->getManager()->spawnCountDown($args[1], $args[2]);
		}

		return true;
	}

	public function openForm(CommandSender $sender){
		$form = new SimpleForm(function(Player $player, $data){
			if(is_null($data)) return;
			if($data == 0) $this->openSpawnForm($player);
			if($data == 1) $this->openSettingForm($player);
		});
		$form->setTitle(TF::BOLD. TF::GREEN. " §c§l• §9§lBoss §c§l•");
		$form->setContent(TF::BOLD. TF::GREEN. "§e§l↣§aBạn Phải Tạo Boss Rồi Mới Triệu Hồi!");
		$form->addButton(TF::BLUE. TF::BOLD. "§c§l• §9§lTriệu Hồi §c§l•", 1,"https://i.imgur.com/nl8uItl.png");
		$form->addButton(TF::BLUE. TF::BOLD. "§c§l• §9§lTạo Boss §c§l•", 2,"https://i.imgur.com/kHjurJ4.png");
		$form->addButton(TF::BLUE. TF::BOLD. "§c§l• §9Thoát §c§l•", 3,"https://www.flaticon.com/free-icon/remove_1828843");
		$form->sendToPlayer($sender);
	}

	public function openSpawnForm(Player $player) {
		$form = new SimpleForm(function(Player $player, $data){
			if(is_null($data)) return;
			$player->sendMessage(TF::BOLD. TF::GREEN . "§l§6[§aTVT§6]§e↣Boss đã được hồi sinh");
			$this->main->spawnBoss($data);
		});

		$form->setTitle(TF::RED. TF::BOLD. "§e§l• §c§lBoss §e§l•");
		foreach(array_keys($this->main->getAllBoss()) as $id){
			$name = $this->main->config->get($id)["name"];
			$form->addButton(TF::DARK_BLUE. TF::BOLD. "§c§ltriệu hồi \n ".TF::RESET. $name);
		}
		$form->sendToPlayer($player);
	}


	public function openSettingForm($player){
			$form = new CustomForm(function(Player $player, $data){
			if(is_null($data)) return;
			$key = $this->main->getNextKey();
			$databoss = [
				"name" => $data[1],
				"skin" => $data[0],
				"maxhealth" =>(int) $data[2],
				"damage" => (int)$data[3],
				"speed" => (int) $data[4],
				"posX" => $player->getX(),
				"posY" => $player->getY(),
				"posZ" => $player->getZ(),
				"level" => $player->getLevel()->getName(),
				"drops" => ["1:0:1", "4:0:64"],
				"scale" => (int)$data[5],
				"commands" => ["boss cooldown $key 500"],
				"custom-item" => [1 => ["id" => "278:0:1", "chance" => 50,"name" => "§l§aSuper Pickaxe", "lore" => "§l§aRARITY:§e **", "enchantment" => ["17:5", "15:8"]]]
			];
			$this->main->getBossConfig()->save();
			$this->main->SaveBoss($key, $databoss);
		});

		$form->setTitle(TF::RED. TF::BOLD."§c§l• §9Cài Đặt Boss §c§l•");
		$form->addInput(TF::BLUE. TF::BOLD."§e§l↣§cType Skin", "Nhập Skin Boss");
		$form->addInput(TF::BLUE. TF::BOLD."§e§l↣§cTên", "Nhập Tên Boss", $player->getName(). " boss");
		$form->addInput(TF::BLUE. TF::BOLD."§e§l↣§cMáu", "Nhập Máu Của Boss", "100");
		$form->addInput(TF::BLUE. TF::BOLD."§e§l↣§cSát Thương", "Nhập Sát Thương Boss", "1.5");
		$form->addInput(TF::BLUE. TF::BOLD."§e§l↣§cTốc Độ", "Nhập Tốc Độ Boss");
		$form->addInput(TF::BLUE. TF::BOLD."§e§l↣§cKích Thước", "Kích Thước Boss", "1.5");
		$form->sendToPlayer($player);	
	}
}