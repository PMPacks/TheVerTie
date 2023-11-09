<?php

namespace Noob\Bank;

use pocketmine\plugin\PluginBase;
use pocketmine\Player; 
use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Event;
class Main extends PluginBase implements Listener {

	public $rate =  0.00000010000;//per sec
	
	//you add the thief rate like example, x/y with y is the maxpercent,
	//1/200 means for every 200 people joining in the server, there are 1 chances that a bank will be robbed
	public function onEnable(){
		$this->getLogger()->info("ngan hang enable");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$task = new profitMoney($this);
        $this->getScheduler()->scheduleRepeatingTask($task, 1200);
	}
	
	public function onCommand(CommandSender $sender, Command $command, String $label, array $args) : bool {
        if($sender instanceof Player){
		switch(strtolower($command->getName())){
            case "nganhang":
            $this->mainform($sender,"");
            break;
		}
		}
		return true;
	}
	
	public function profit($player,$err){
		
		 $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		 $form = $api->createSimpleForm(function (Player $player, int $data = null){
			$api2 = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
			 $result = $data;
			 if($result === null){
				$this->mainform($player,"");
				 return true;
			 }
			    if($result == 0){
				$n = $player->getName();

				 $profit = $this->getConfig()->getNested("bank.$n.profit") + $this->getConfig()->getNested("bank.$n.money") * $this->rate;
				 $api2->addMoney($player,$profit);
				 $this->getConfig()->setNested("bank.$n.profit", 0);
				 $this->getConfig()->setNested("bank.$n.checktime", time());
				 //$this->getConfig()->setAll($this->getConfig()->getAll());
				 $this->getConfig()->save();	
				 $this->mainform($player,"§l§3• §dLấy §clợi nhuận§a thành công: §e\n");
				}else{
					$this->mainform($player,"");
				}
				return false;
			 });
			 $n = $player->getName();
			 $profit = $this->getConfig()->getNested("bank.$n.profit"); 
			 $form->setTitle("§l§aLợi Nhuận");
			 $form->setContent(
				 "§l§3•§a Tổng lợi nhuận kiếm được: §e$profit \n".
				 "§l§3•§a Nhấp vào gửi để nhận lợi nhuận"
			 );
			 $form->addButton("§l§3•§2 Gửi §3•");
			 $form->addButton("§l§3•§4 Thoát §3•");
			 $form->sendToPlayer($player);
			 return $form;
		
	}

	public function withdraw($player,$err){ 
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$api2 = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
			$form = $api->createCustomForm(function (Player $player,$data){
				$result = $data;
				$api2 = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
				if($result === null){
					$this->mainform($player,"");
					return false;
				}else{
		            if(!isset($data[1]) || !is_numeric($data[1]) || $data[1] < 0 || !preg_match('/^[0-9]+$/', $data[1], $matches)){
						$this->withdraw($player,"§l§3• §cPhải là số.\n");		
					    return false;
					}
					if($data[1] > $this->getPlayerBankMoney($player)){
						$this->withdraw($player,"§l§3• §cKhông có đủ xu\n");		
					    return false;
					}
					
					$n = $player->getName();
					$this->getConfig()->setNested("bank.$n.money", (double) $this->getPlayerBankMoney($player) - $data[1]);
					//$this->getConfig()->setAll($this->getConfig()->getAll());
					$this->getConfig()->save();
					$api2->addMoney($player,$data[1]);
					$this->mainform($player,"§l§3• §dRút xu thành công\n");	
					return false;	
				}			
				});	
				$money = $api2->myMoney($player);	
				$bankmoney = $this->getPlayerBankMoney($player);
				$profit = round($this->getPlayerBankMoney($player) * $this->rate,6);
				$form->setTitle("§l§aRút Tiền");	
				$form->addLabel(
					"$err".
				"§l§3• §aTiền trên ngân hàng hiện tại của bạn: §e$bankmoney §7\n". 
				"§l§3• §cLợi nhuận kiếm được mỗi phút: §d$profit"
				);
				$form->addInput("§l§eNhập số tiền của bạn để rút:","100000");
				$form->sendToPlayer($player);
				return $form;
	}
	public function deposit($player,$err){ 
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$api2 = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
			$form = $api->createCustomForm(function (Player $player,$data){
				$result = $data;
				$api2 = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
				if($result === null){
					$this->mainform($player,"");
					return false;
				}else{
		            if(!isset($data[1]) || !is_numeric($data[1]) || $data[1] < 0 || !preg_match('/^[0-9]+$/', $data[1], $matches)){
						$this->deposit($player,"§l§3• §cPhải là số\n");		
					    return false;
					}
					if($data[1] > $api2->myMoney($player)){
						$this->deposit($player,"§l§3• §cKhông có đủ số xu\n");		
					    return false;
					}
					$n = $player->getName();
					$this->getConfig()->setNested("bank.$n.money", (double) $data[1] + $this->getPlayerBankMoney($player));
					//$this->getConfig()->setAll($this->getConfig()->getAll());
					$this->getConfig()->save();
					$api2->reduceMoney($player,$data[1]);
					$this->mainform($player,"§l§3• §dGửi xu thành công\n");	
					return false;	
				}			
				});	
				$money = $api2->myMoney($player);	
				$bankmoney = $this->getPlayerBankMoney($player);
				$profit = round($this->getPlayerBankMoney($player) * $this->rate,6);
				$form->setTitle("§l§bGửi Xu");	
				$form->addLabel(
					"$err".
				"§l§3• §aXu của bạn vào ngân hàng: §e$bankmoney §7\n". 
				"§l§3• §cLợi nhuận kiếm được mỗi phút: §d$profit"
				);
				$form->addInput("§l§eNhập số xu của bạn để gửi xu:","100000");
				$form->sendToPlayer($player);
				return $form;
	}
	
	public function mainform($player,$err){
	    $n = $player->getName();
	    $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$api2 = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
		$form = $api->createSimpleForm(function (Player $player, int $data = null){
			$result = $data;
			if($result === null){
				return true;
			}
			switch($result){				
					case "0";
                     $this->deposit($player,"");					
					break;	
					case "1";				
					 $this->withdraw($player,"");
					break;
					case "2";		
					$this->profit($player,"");		
					break;
					default:
					break;
			}
			});	
			$mon = $api2->myMoney($player);		
			$n = $player->getName();
			$money = $this->getConfig()->getNested("bank.$n.money"); 
			$profit = $this->getConfig()->getNested("bank.$n.profit"); 
			$rate2 = round($this->getPlayerBankMoney($player) * $this->rate,6);
            $rate = round(604800 * $this->rate,6) * 100;
			$form->setTitle("§l§eNgân Hàng");
			$form->setContent(
				"$err".
				"§l§3• §aXu ngân hàng: §e$money  \n".
				"§l§3• §aTổng lợi nhuận kiếm được: §e$profit \n".
				"§l§3• §cLợi nhuận kiếm được mỗi phút: §d$rate2"
			);
			$form->addButton("§l§3•§2 Tiền gửi §l§3•");
			$form->addButton("§l§3•§2 Rút tiền §l§3•");
			$form->addButton("§l§3•§2 Rút lãi §l§3•");
			$form->addButton("§l§3•§4 Thoát §l§3•");
			$form->sendToPlayer($player);
			return $form;
	}

   public function getPlayerBankMoney($p){
	   $n = $p->getName();
	if(null !== $this->getConfig()->getNested("bank.$n.money")){	
	  return abs($this->getConfig()->getNested("bank.$n.money"));
	}else{
		return 0;
	}
   }
   
   public function profitMoney(){
	foreach($this->getServer()->getOnlinePlayers() as $player) {
	   $n = $player->getName();
	   if($this->getConfig()->getNested("bank.$n.checktime") < time()){
		$profit = $this->getConfig()->getNested("bank.$n.money") * $this->rate;
		$this->getConfig()->setNested("bank.$n.profit", (double) $this->getConfig()->getNested("bank.$n.profit") + $profit);
		$this->getConfig()->setNested("bank.$n.checktime", time());
		//$this->getConfig()->setAll($this->getConfig()->getAll());
		$this->getConfig()->save();		
	   }
	}
   }
}