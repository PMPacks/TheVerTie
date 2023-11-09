<?php
declare(strict_types = 1);

namespace Ifera\CoinAPIScore\listeners;

use Ifera\CoinAPIScore\Main;
use Ifera\ScoreHud\event\PlayerTagUpdateEvent;
use Ifera\ScoreHud\scoreboard\ScoreTag;
use onebone\coinapi\event\coin\CoinChangedEvent;
use pocketmine\event\Listener;
use pocketmine\Player;
use function is_null;
use function strval;

class EventListener implements Listener{

	/** @var Main */
	private $plugin;

	public function __construct(Main $plugin){
		$this->plugin = $plugin;
	}

	public function onCoinChange(CoinChangedEvent $event){
		$username = $event->getUsername();

		if(is_null($username)){
			return;
		}

		$player = $this->plugin->getServer()->getPlayer($username);

		if($player instanceof Player && $player->isOnline()){
			(new PlayerTagUpdateEvent($player, new ScoreTag("coinapiscore.coin", strval($event->getCoin()))))->call();
		}
	}
}