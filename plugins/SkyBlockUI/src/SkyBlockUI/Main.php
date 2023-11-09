<?php

namespace SkyBlockUI;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use jojoe77777\FormAPI;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\Listener;

class Main extends PluginBase implements Listener{
	
	public function onEnable(){
		$this->getServer()->getLogger()->Info("§bSkyBlockGUI - Enabled!");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
		$player = $sender->getPlayer();
		switch($cmd->getName()){
			case "sbui":
			$this->mainForm($player);
        }
        return true;
    }
	
	public function mainForm($player){
		if($player instanceof Player){
			$form = $this->formapi->createSimpleForm(function (Player $player, $data){
				$result = $data;
				if ($result == null) {
				}
				switch($result) {
                            case 0:
							break;	
							
							case 1:
								$command = "sb auto";
								$this->getServer()->dispatchCommand($player, $command);
							break;
							
							case 2:
								$command = "sb claim";
								$this->getServer()->dispatchCommand($player, $command);
							break;
				  
							case 3:
								$this->addForm($player);
							break;
								
							case 4:
								$this->removeForm($player);
							break;
								
							case 5:
								$this->homeForm($player);
							break;
								
							case 6:
								$this->warpForm($player);
							break;
								
							case 7:
								$this->giveForm($player);
							break;
				}
			});
			$form->setTitle("§l§2• Giao Diện SkyBlock •");
			$form->addButton("§l§2• Thoát •");
			$form->addButton("§l§2• Tìm Một Hòn Đảo Mới •");
      $form->addButton("§l§2• Nhận Đảo Đang Đứng •");			
      $form->addButton("§l§2• Thêm Người Chơi Vào Đảo •");	
			$form->addButton("§l§2• Xóa người chơi khỏi đảo •");
			$form->addButton("§l§2• Về đảo của bạn •");
			$form->addButton("§l§2• Dịch chuyển đến đảo khác •");
			$form->addButton("§l§2• Chuyển đảo cho người khác •");
			$form->sendToPlayer($player);
		}
	}
	
	public function addForm($player){
		if($player instanceof Player){
			
			$form = $this->formapi->createCustomForm(function (Player $player, $data){
					if($data === null)
			{
				return true;
			}
			$this->getServer()->dispatchCommand($player, "sb addhelper " . $data[0]);
			});
			$form->setTitle("§l§2• Thêm Người Vào Đảo Của Bạn");
			$form->addInput("§l§2• Nhập Tên Người Chơi Muốn Thêm");
			$form->sendToPlayer($player);
		}
	}
	
	public function removeForm($player){
		if($player instanceof Player){
			$form = $this->formapi->createCustomForm(function (Player $player, $data){
					if($data === null)
			{
				return true;
			}
			$this->getServer()->dispatchCommand($player, "sb removehelper " . $data[0]);
			});
			$form->setTitle("§l§2• Xóa Người Ra Khỏi Đảo Của Bạn");
			$form->addInput("§l§2• Nhập Tên Người Chơi Muốn Xóa");
			$form->sendToPlayer($player);
		}
	}

	public function homeForm($player){
		if($player instanceof Player){
			$form = $this->formapi->createCustomForm(function (Player $player, $data){
	if($data === null)
			{
				return true;
			}
			$this->getServer()->dispatchCommand($player, "sb home " . $data[0]);
			});
			$form->setTitle("§l§2• Về Đảo Của Bạn");
			$form->addInput("§l§2• Nhập Số Đảo Bạn Muốn về ( ví dụ 1 , 2 ,3 ) ");
			$form->sendToPlayer($player);
		}
	}
		
	public function warpForm($player){
		if($player instanceof Player){
				$form = $this->formapi->createCustomForm(function (Player $player, $data){

				if($data === null)
			{
				return true;
			}
			$this->getServer()->dispatchCommand($player, "sb warp " . $data[0]);
			});
			$form->setTitle("§l§2• Dịch Chuyển Đến Hòn Đảo Nào Đó");
			$form->addInput("§l§2• Nhập Theo Địa Chỉ X;Y");
			$form->sendToPlayer($player);
		}
	}

	public function giveForm($player){
		if($player instanceof Player){
				$form = $this->formapi->createCustomForm(function (Player $player, $data){
	if($data === null)
			{
				return true;
			}
			$this->getServer()->dispatchCommand($player, "sb give " . $data[0]);
			});
			$form->setTitle("§l§2• Chuyển Quyền Sở Hữu Đảo");
			$form->addInput("§l§2• Nhập Tên Người Muốn Chuyển");
			$form->sendToPlayer($player);
		}
	}
}
