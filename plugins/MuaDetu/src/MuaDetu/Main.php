<?php

namespace MuaDetu;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use onebone\coinapi\CoinAPI;
use pocketmine\utils\TextFormat as C;
use MuaDetu\Main;

class Main extends PluginBase implements Listener {

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->coin = $this->getServer()->getPluginManager()->getPlugin("CoinAPI");
	}
	
	public function onCommand(CommandSender $player, Command $command, string $label, array $args) : bool {
		switch($command->getName()){
			case "muadetu":
			if($player instanceof Player){
			    $this->OpenMenu($player);
			} else {
				$player->sendMessage("You can use this command only in-game.");
					return true;
			}
			break;
		}
	    return true;
	}

	public function OpenMenu(Player $sender){
		$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createSimpleForm(function (Player $sender, ?int $data = null){
		$result = $data;
		if($result === null){
			return;
		    }
			switch($result){
				case 0;
			    $this->MuaDeTu($sender);
					break;
			}
		});
		$coin = $this->coin->myCoin($sender);
		$form->setTitle("§l§6♦ §dMua Đệ Tử §6♦");
		$form->setContent("§l§c•§eCoin của bạn§f:§a $coin");
		$form->addButton("§l§c• §9Mua Đệ Tử §c•");		
		$form->sendToPlayer($sender);
			return $form;
    }
    
    public function MuaDeTu($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $sender, $data){
        $result = $data;
        if ($result == null) {
             }
             switch ($result) {
                 case 1:
                 $coin = $this->coin->myCoin($sender);
                 $name = $sender->getName();
                 $cost = 400;
                 if($coin >= $cost){
            
                 $this->coin->reduceCoin($sender, $cost);	
                 $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "detu ".$name."");
		         $sender->sendMessage("Mua thành công");
              return true;
            }else{
                $sender->sendMessage("Mua Thất Bại");
            }
                        break;
                    case 2:
                        break;
            }
        });
        $cost = 400;
		$form->setTitle("§l§6♦ §dXác Nhận Mua Đệ Tử §6♦");
        $form->setContent("§l§e•§aXác Nhận Mua Đệ Tử§e•\n§c↣§eĐệ Tử Giúp Bạn Farm Khoáng Sản\n§c↣§eKhả Năng Đệ Tử\n§c↣§fFarm Khoáng Sản\n§c↣§fCấp Độ Tối Đa§e: 5\n§c↣§fGiá Đệ Tử §6".$cost." §cCoin");
        $form->setButton1("§l§c•§9Có§c•", 1);
        $form->setButton2("§l§c•§9Không§c•", 2);
        $form->sendToPlayer($sender);
	}
}