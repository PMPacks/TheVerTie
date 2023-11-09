<?php
declare(strict_types = 1);

namespace Ifera\ClanScore\listeners;

use Ifera\ClanScore\Main;
use Ifera\ScoreHud\event\PlayerTagUpdateEvent;
use Ifera\ScoreHud\scoreboard\ScoreTag;
use instantlyta\fcaclan\event\ClanChangeEvent;
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

	public function onClanChange(ClanChangeEvent $event){
		$player = $event->getPlayer();
			(new PlayerTagUpdateEvent($player, new ScoreTag("clanscore.clan", strval($event->getclanName()))))->call();
		}
	}
