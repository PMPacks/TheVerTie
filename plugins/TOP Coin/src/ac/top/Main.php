<?php

namespace ac\top;

use pocketmine\plugin\PluginBase;
use pocketmine\Player; 
use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Config;

use ac\top\form\SimpleForm;

class Main extends PluginBase implements Listener {

	public $i;

    /**
     * @deprecated
     *
     * @param callable|null $function
     * @return SimpleForm
     */
    public function createSimpleForm(callable $function = null) : SimpleForm {
        return new SimpleForm($function);
    }

	public function onLoad(){
		$this->saveResource("setting.yml");  
  }

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getServer()->getLogger()->info("TopCoinUI By PIG");
		@mkdir($this->getDataFolder());
    $this->saveDefaultConfig();
		$this->config = new Config($this->getDataFolder() . "setting.yml", Config::YAML);
	}

	public function onCommand(CommandSender $sender, Command $command, $label, array $params) : bool{
		switch(array_shift($params)){
			default:
				$this->TopC($sender);
		}
		return true;
	}

	public function TopC($player){
		$coin = $this->getServer()->getPluginManager()->getPlugin("CoinAPI");
		$coin_top = $coin->getAllCoin();
		$message = "";
		$message1 = "";
		$topcoin = "     §l§6❖§a TOP Coin§e ✰     ";
		$topcoin1 = "     §l§6❖§a TOP Coin§e ✰     ";
		if(count($coin_top) > 0){
			arsort($coin_top);
			$i = 1;
			foreach($coin_top as $name => $coin){
				$message .= "§l§b[§e".$i."§b]§a ".$name."§c ↣ §e".$coin." §a".$this->config->get("unit")."\n";
				$message1 .= "§l§b[§e".$i."§b]§a ".$name."§c ↣ §e".$coin." §a".$this->config->get("unit")."\n";
				if($i >= 10){
					break;
					}
					++$i;
				}}
		$form = $this->createSimpleForm(function (Player $player, int $data = null){
			$result = $data;
			if($result === null){
				return true;
				}
				switch($result){
					case "0";
					break;
				}
			});
			$form->setTitle("".$this->config->get("title"));
			$form->setContent("".$message);
			$form->addButton("".$this->config->get("button"));
			$form->sendToPlayer($player);
			return $form;
	}
}
