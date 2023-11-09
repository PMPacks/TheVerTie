<?php 

namespace phuongaz\AuraBoss;

use pocketmine\event\entity\EntityDeathEvent;
use pocketmine\event\Listener;
use phuongaz\AuraBoss\Boss;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\Server;
use pocketmine\nbt\tag\IntTag;
use pocketmine\nbt\tag\FloatTag;
use pocketmine\nbt\tag\StringTag;
use phuongaz\AuraBoss\Entity\BossMain;
use pocketmine\utils\TextFormat as TF;
use phuongaz\AuraBoss\Entity\events\BossDeathEvent;
use pocketmine\Player;
//use phuongaz\CustomWings\Loader as Wing;
use pocketmine\item\Item;

Class EventListeners implements Listener{

	private $main; 

	public function __construct(Boss $main){
		$this->main = $main;
	}

	public function onDeath(EntityDeathEvent $event) {
		$entity = $event->getEntity();
		if(!$entity instanceof BossMain) return;
		if($entity->namedtag->hasTag('BossID', IntTag::Class)){
			$id = $entity->namedtag->getInt('BossID');
			$drops = $this->main->getDrops($id);
			$ct = $this->main->getCustomDrops($id);
			if(!is_null($ct)){
				foreach($ct["its"] as $item => $hi){
					if($item instanceof Item){
						$drops[] = $item;						
					}
					if($hi instanceof Item){
						$drops[] = $hi;
					}
				}
				foreach($ct["wings"] as $wing => $chance){
					var_dump($chance);
					if(Boss::getInstance()->chance((float)$chance)){
						//Wing::dropWing($wing, $entity->asPosition());
					}
				}
			}
			$event->setDrops($drops);
		}
		if($entity instanceof BossMain){
			if(($cause = $entity->getLastDamageCause()) instanceof EntityDamageByEntityEvent){
				$damager = $cause->getDamager();
				if($damager instanceof Player){
					$this->main->getServer()->getPluginManager()->callEvent(new BossDeathEvent($entity, $damager));
					$id = $entity->namedtag->getInt('BossID');
					$this->main->getManager()->execCommand($id, $damager);
				}
			}
		}
	}

    public function onDamage(EntityDamageEvent $event){
        if($event instanceof EntityDamageByEntityEvent){
            if($event->isCancelled()) return;
            $entity = $event->getEntity();
            $player = $event->getDamager();
            if($entity instanceof ViThu){
                if($player->isCreative()) return;
             	$entity->setNameTag($entity->name. "\n". $this->getManager()->getProgress((int)$entity->getHealth(), (int)$entity->getMaxHealth()));
            }
        }
    }
}