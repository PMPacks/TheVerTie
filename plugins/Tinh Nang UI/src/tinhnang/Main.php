<?php

namespace tinhnang;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener {
    
    public function onEnable(){
        $this->getLogger()->info("Tính Năng Đã Bật");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->checkDepends();
    }

    public function checkDepends(){
        $this->formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        if(is_null($this->formapi)){
            $this->getLogger()->info("§4Hãy Cài Plugin FormAPI Để Được Trải Nghiệm");
            $this->getPluginLoader()->disablePlugin($this);
        }
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool
    {
        switch($cmd->getName()){
        case "tinhnang":
        if(!($sender instanceof Player)){
                return true;
        }
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 0:
                        break;

                    case 1:
					$command = "clan";
					           $this->getServer()->getCommandMap()->dispatch($sender, $command);                       
					    break;
					case 2:
					$command = "napthe";
					           $this->getServer()->getCommandMap()->dispatch($sender, $command);
					    break;
					case 3:
					$command = "muadetu";
					           $this->getServer()->getCommandMap()->dispatch($sender, $command);
					    break;
					case 4:
					$command = "muarank";
					           $this->getServer()->getCommandMap()->dispatch($sender, $command);
					    break;
					case 5:
					$this->getServer()->getCommandMap()->dispatch($sender, "nganhang");
					    break;
					case 6:
					$this->getServer()->getCommandMap()->dispatch($sender, "choden");
					    break;
					case 7:
					$this->getServer()->getCommandMap()->dispatch($sender, "luat");
                    break;
					case 8:
					$this->getServer()->getCommandMap()->dispatch($sender, "huongdan");
                    break;
					case 9:
					$this->shop($sender);
                    break;
                    case 10:
                    $this->khuvuc($sender);
                    break;
            }
        });
    $form->setTitle("§l§a• §3Tính Năng §a•");
    $form->setContent("§l§c↣§e Tính Năng Server");
    $form->addButton("§l§2• Thoát •");
		$form->addButton("§2§l• Bang Hội •");
		$form->addButton("§2§l• Donate Ủng Hộ Máy Chủ •");
		$form->addButton("§2§l• Mua Đệ Tử Miner •");
		$form->addButton("§2§l• Mua Rank VIP •");
		$form->addButton("§2§l• Ngân Hàng •");
		$form->addButton("§2§l• Chợ Đen •");
		$form->addButton("§2§l• Luật Máy Chủ •");
		$form->addButton("§2§l• Hướng Dẫn Chơi •");
		$form->addButton("§2§l• Cửa Hàng •");
        $form->addButton("§2§l• Khu Vực •");
        $form->sendToPlayer($sender);
        }
        return true;
    }

    public function shop($sender)
{
        if ($sender instanceof Player){
    
}
    $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
    $form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result === null) {
            
            return true;
            }
            switch ($result) {
    case 0:
    $this->getServer()->getCommandMap()->dispatch($sender, "shopui");
    break;
    case 1:
    $this->getServer()->getCommandMap()->dispatch($sender, "shopcoin");
	 break;
    }
    });
    $form->setTitle("§a§l• §3Shop§a •");
    $form->addButton("§2§l• Shop Xu •");
    $form->addButton("§2§l• Shop Coin •");
    $form->sendToPlayer($sender);
    }

  public function khuvuc(Player $sender){
    $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
    $form = $api->createSimpleForm(function(Player $sender , $data){
    if($data === null){
     
     return true;
     }
        switch($data){
        case 0:
        $this->getServer()->getCommandMap()->dispatch($sender, "hub");
        break;
        case 1:
        $this->getServer()->getCommandMap()->dispatch($sender, "warp trade");
        break;
        case 2:
        $this->getServer()->getCommandMap()->dispatch($sender, "warp pvp");
        break;
        case 3:
        $this->getServer()->getCommandMap()->dispatch($sender, "warp boss");
        break;
        case 4:
        $this->getServer()->getCommandMap()->dispatch($sender, "warp daugia");
        break;
        case 5:
        $this->getServer()->getCommandMap()->dispatch($sender, "warp dabong");
        break;
        case 6:
        $this->getServer()->getCommandMap()->dispatch($sender, "warp moruong");
        break;
    }
});
    $form->setTitle("§2§l• Khu Vực •");
    $form->addButton("§2§l• Khu Lobby •");
    $form->addButton("§2§l• Khu Trade •");
    $form->addButton("§2§l• Khu Pvp •");
    $form->addButton("§2§l• Khu Đánh Boss •");
    $form->addButton("§2§l• Khu Đấu Giá •");
    $form->addButton("§2§l• Khu Đá Bóng •");
    $form->addButton("§2§l• Khu Quay Đồ •");
    $form->sendToPlayer($sender);
     }
    }