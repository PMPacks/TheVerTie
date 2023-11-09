<?php

namespace phuongaz\OreGenerator\UpgradeHandler;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\nbt\tag\IntTag;
use onebone\economyapi\EconomyAPI;
use jojoe77777\FormAPI\{SimpleForm, CustomForm, ModalForm};
use pocketmine\item\Item;

Class UpgradeForm{

	/** @var Player $player*/
	private $player;

	public function __construct(Player $player){
		$this->player = $player;
	}

	public function init() :void{
		$form = new SimpleForm(function(Player $player, ?int $data){
			if(is_null($data));
			if($data == 0) $this->upgradeForm();
		});
		$form->setTitle("§l§a• Shop Generator •");
		$form->addButton("§l§e• Nâng Cấp •");
		$form->sendToPlayer($this->player);
	}

	public function upgradeForm() :void{
		$inv = $this->player->getInventory();
		$item = $inv->getItemInHand();
		if($item->getId() !== 245){
			$form = new CustomForm(function(Player $player, ?array $data){});
			$form->setTitle("§l§a• Nâng Cấp •");
			$form->addLabel("§e§l• Vui Lòng Cầm Generator Trên Tay");
			$form->sendToPlayer($this->player);
			return;
		}
		$nbt = $item->getNamedTag();
		if($nbt->hasTag("generator", IntTag::class)){
            $level = $nbt->getInt("generator");
        }else $level = 1;
        $nbt->setInt("generator", $level);
		$next = ($nbt->getInt("generator"))+1;
		$price = (30000 * $next) * $item->getCount();
		$form = new ModalForm(function(Player $player, ?bool $data) use ($inv, $item, $nbt, $next, $price){
			if($data){
				if($nbt->hasTag("generator", IntTag::class)){
					$nbt->setInt("generator", $next);
					if(EconomyAPI::getInstance()->myMoney($player) >= $price){
						if($next == 10){
							$player->sendMessage("§e§lGenerator đã đạt cấp độ max");
							return;
						}
						$item->setNamedTag($nbt);
						$item->setCustomName("Generator (".$next.")");
						$inv->setItemInHand($item);
						EconomyAPI::getInstance()->reduceMoney($player, $price);
						$player->sendMessage("§e§l• Nâng Cấp Thành Công : ". $next);
						return;
					}
					$player->sendMessage("Bạn không đủ tiền để nâng cấp");
				}
			}
		});
		$form->setTitle("§0§l• Nâng Cấp •");
		$content = "";
		$content .= "§l§a• Bạn có muốn nâng generator lên cấp : §c".$next." không ?\n";
		$content .= "§lGIÁ : $price ";
		$form->setContent($content);
		$form->setButton1("§l§e• Đồng Ý •");
		$form->setButton2("§l§e• Thoát •");
 	  $form->sendToPlayer($this->player);
	}
}