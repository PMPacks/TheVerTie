<?php

namespace hachkingtohach1\Napthe;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\Command;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\Listener;
use onebone\coinapi\CoinAPI;

Class Napthe extends PluginBase implements Listener{

	/** @var self $instance */
	public static $instance;
	/**
	THESIEURE:
		ID: 4673357261
		KEY: df9751c4eff4070e9695b4d15bba7150
	TRUMTHE:
		ID: 2326357261
		KEY: 75682e5c7932acb0827cd6de91317822
	NHO DOI URL 2 CAI TASK
	2 web trên có cùng api nạp thẻ nên chỉ cần đổi id,key là đc
	*/
	public $partnerId = "5963369361";
	public $partnerKey = "ca5fb2afa9a8c8b8e5e353d00c1a520a";
	public $formapi;
	public function onEnable(){

		self::$instance = $this;
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onCommand(CommandSender $sender, Command $cmd,string $label, array $args) :bool{
		if($cmd->getName() == "napthe"){
			$this->formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			if($this->formapi == null){ 
				$sender->sendMessage("Thiếu thư viện, hãy báo lỗi admin");
				return true;
			}
			if(!$sender instanceof Player) return true;
			$this->mainform($sender);			
			return true;
		}
		return false;
	}
	public function mainform(Player $player){
			$form = $this->formapi->createSimpleForm(function (Player $player, int $data = null) {
			$result = $data;
			if ($result === null) {
				return true;
			}
			switch($result){			
					case "0";	
          $this->cardinfoForm($player);						
					break;				
          default:
          break;					
			}
			});
			$form->setTitle("§l§2• Nạp Thẻ •");
			$form->setContent("§e§l• Donate Ủng Hộ Server");
			$form->addButton("§l§2• Nạp Ngay •");
			$form->sendToPlayer($player);
			return $form;
	
	}
	public $chuyendoi =
	[
		"10000" => 10,
		"20000" => 20,
		"50000" => 50,
		"100000" => 110,
		"200000" => 250,
		"500000" => 600,
	];
	public function cardinfoForm(Player $player){
		$form = $this->formapi->createSimpleForm(function (Player $player, int $data = null){
			$result = $data;
			if ($result === null) {
				return true;
			}
			switch($result){				
					case "0";	                  
						$this->thecaoform($player);
					break;
					case "1";						
					break;				
          default:
          break;					
			}
			});
			$form->setTitle("§l§2• Nạp Thẻ •");
			$txt = 
			"§l§f•§cNếu chọn sai mệnh giá thì sẽ mất thẻ, bạn hãy chú ý!\n\n".
			"§l§f•§eBảng giá: \n\n".
			"§l§f   ➻ §a10.000đ §f= §e10 §cCoin\n\n".
			"§l§f   ➻ §a20.000đ §f= §e20 §cCoin\n\n".
			"§l§f   ➻ §a50.000đ §f= §e50 §cCoin\n\n".
			"§l§f   ➻ §a100.000đ §f= §e110 §cCoin\n\n".
			"§l§f   ➻ §a200.000đ §f= §e250 §cCoin\n\n".
			"§l§f   ➻ §a500.000đ §f= §e600 §cCoin\n\n".
			"§f•§l§eHiện tại đang có event x2 giá trị Coin nhận được !!!\n\n"
			;
			$form->setContent($txt);
			$form->addButton("§l§2• Nạp Ngay •");
			$form->addButton("§l§2• Thoát •");
			$form->sendToPlayer($player);
			return $form;
	}
	public function thecaoform(Player $player,string $loaithe = null,string $menhgia = null,string $seri = null,string $pin = null){
		$loaithe_arr = ["Viettel","Vnmobi","Zing"];
		$menhgia_arr = ["10000","20000","50000","100000","200000","500000"];
		$form = $this->formapi->createCustomForm(function (Player $player, $data) use ($loaithe_arr,$menhgia_arr){
			$result = $data;
			if ($result === null) {
				return true;
			}
			$telco = $loaithe_arr[$result[1]];
			$menhgia = $menhgia_arr[$result[2]];
			$seri = $result[3];
			$pin = $result[4];
			$thongtin = [$telco,$menhgia,$seri,$pin];
			$this->xacnhanform($player,$thongtin);
		});
		
		$form->setTitle("§l§2• Nạp Thẻ •");
		$form->addLabel(
			"§f•§l§aHãy đọc và điền thật kỹ các thông tin sau:");
		$form->addDropdown("§l§f✾§bLoại thẻ:",$loaithe_arr,(int) array_search($loaithe, $loaithe_arr));
		$form->addDropdown("§l§f✾§bMệnh Giá §f(§bchọn sai sẽ mất thẻ§f)§b:",$menhgia_arr,(int) array_search($menhgia, $menhgia_arr));
		$form->addInput("§l§f✾§bSố Seri §f(§bsố được in sẵn bên ngoài§f)§b:","",$seri);
		$form->addInput("§l§f✾§bMã thẻ §f(§bsố bên trong lớp cào§f)§b:","",$pin);		
		$form->sendToPlayer($player);
		return $form;
	}
	public function xacnhanform(Player $player, array $thongtin){
			$form = $this->formapi->createSimpleForm(function (Player $player, int $data = null) use($thongtin) {
			$result = $data;
			if ($result === null) {
				return true;
			}
			switch($result){				
					case "0";
						$player->sendTip("§l✾§aĐang check card , vui lòng không chat");					
						$this->getServer()->getAsyncPool()->submitTask(new NaptheTask([$this->partnerId,$this->partnerKey],strtoupper($thongtin[0]),(string) $thongtin[3],(string) $thongtin[2],(int)$thongtin[1],$player->getName()));			 
					break;
					case "1";
						$this->thecaoform($player,$thongtin[0],$thongtin[1],$thongtin[2],$thongtin[3]);
					break;
					case "2";                  						
					break;					
                    default:
                    break;					
			}
			});
			$form->setTitle("§2§l• Thông tin thẻ •");
			$txt = 
			"§l§f✾Loại thẻ: §l§c".$thongtin[0]."\n\n".
			"§l§f✾Mệnh Giá: §l§c".$thongtin[1]."\n\n".
			"§l§f✾Số Seri: §l§a".$thongtin[2]."\n\n".
			"§l§f✾Mã thẻ: §l§a".$thongtin[3]."\n\n";
			$form->setContent($txt);
			$form->addButton("§l§2• Nạp Ngay •");
			$form->addButton("§l§2• Quay lại •");
			$form->addButton("§l§2• Thoát •");
			$form->sendToPlayer($player);
			return $form;
	}
	public function onSuccess(Player $player,string $txt){
		$form = $this->formapi->createSimpleForm(function (Player $player, int $data = null){
			$result = $data;
			if ($result === null) {
				return true;
			}
			});
			$form->setTitle("§l§2• Thông tin •");
			$form->setContent($txt);
			$form->addButton("§l§2• Thoát •");
			$form->sendToPlayer($player);
			return $form;
		
	}
	
	public function napThanhCong(String $name,int $giatri, int $ucoin){
	  $player = $this->getServer()->getPlayerExact($name);
		$this->getServer()->broadcastMessage("§l\n=================\n\n§l✾§eCảm ơn bạn §a".$name."§e đã\nnạp thẻ (§a".$giatri."§e) ủng hộ server§r\n\n=================");				
		
		//event x2:
		$ucoin *=2;
		$this->getServer()->dispatchCommand(new ConsoleCommandSender(),'givecoin '.$name.' '.$ucoin);
		$totalmoney = $this->getConfig()->getNested("database.$name.totalmoney");
        if(!isset($totalmoney)){
            $this->getConfig()->setNested("database.$name.totalmoney",$giatri);
			$this->getConfig()->setNested("database.$name.ucoin",$ucoin);
        }else{
			$coin = $this->getConfig()->getNested("database.$name.ucoin");
			$this->getConfig()->setNested("database.$name.totalmoney",$totalmoney + $giatri);
			$this->getConfig()->setNested("database.$name.ucoin",$ucoin + $coin);
		}
        $this->getConfig()->save();
		if($player == null){
			return;
		}
		$txt = 
		"§f✾§aNạp thẻ thành công\n\n".
		"§f✾Mệnh giá: §e".$giatri." đồng\n\n".
		"§f✾Bạn nhận được §c".((int) $ucoin)." Coin\n\n".
		"§f✾§aCảm ơn bạn đã ủng hộ server!!!\n\n";
		$this->onSuccess($player,$txt);
	}
}