<?php

declare(strict_types=1);

namespace CLADevs\Minion;

use CLADevs\Minion\minion\HopperInventory;
use CLADevs\Minion\minion\Minion;
use pocketmine\block\Chest;
use pocketmine\entity\Entity;
use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\inventory\transaction\action\SlotChangeAction;
use pocketmine\item\Item;
use pocketmine\nbt\tag\StringTag;
use pocketmine\utils\TextFormat as C;
use pocketmine\scheduler\ClosureTask;

use onebone\coinapi\CoinAPI;

class EventListener implements Listener{

    public $linkable = [];
    
    public function onInv(InventoryTransactionEvent $e): void{
        $tr = $e->getTransaction();
        foreach($tr->getActions() as $act){
            if($act instanceof SlotChangeAction){
                $inv = $act->getInventory();
                if($inv instanceof HopperInventory){
                    $player = $tr->getSource();
                    $entity = $inv->getEntity();
                    $e->setCancelled();
                    switch($act->getSourceItem()->getId()){
                        case Item::REDSTONE_DUST:
                            if(isset($this->linkable[$player->getName()])) unset($this->linkable[$player->getName()]);
                            if($entity->isAlive()){
                                    $this->seconds = 5;
                                    $this->entica = $entity->getLevelM();
                                    $this->autofix = $entity->getAutoFix();
                                    $this->eter = $entity->getEter();
                                    $this->playca = $player;
                                    $entity->flagForDespawn();
                                     $this->time = Main::get()->getScheduler()->scheduleRepeatingTask(new ClosureTask(function($_) : void{
            if(--$this->seconds === 0){
                $this->playca->sendMessage("§l§c♥ §aĐệ Tử§b → Thu Nhỏ Đệ Tử Thành Công");
                Main::get()->getScheduler()->cancelTask($this->time->getTaskId());
                            $this->playca->getInventory()->addItem(Main::get()->getItem($this->playca, $this->entica, $this->eter, $this->autofix));
            }}), 5);
                            }
                            break;
                        case Item::CHEST:
                            if($entity->getLookingBehind() instanceof Chest){
                                $player->sendMessage(C::RED . "§l§c♥ §aĐệ Tử§b → Vui lòng loại bỏ rương phía sau đệ Tử, để thiết lập rương liên kết mới.");
                                return;
                            }
                            if(isset($this->linkable[$player->getName()])){
                                $player->sendMessage(C::RED . "§l§c♥ §aĐệ Tử§b → Bạn Đã Kết Nối Rương Rồi");
                                return;
                            }
                            $this->linkable[$player->getName()] = $entity;
                            $player->sendMessage(C::LIGHT_PURPLE . "§l§c♥ §aĐệ Tử§b → Hãy Chọn Rương Kết Nối Tôi Sẽ Bỏ Đồ Vô Đó");
                            break;
                        case Item::EMERALD:
                            if($entity->getLevelM() >= Main::get()->getConfig()->getNested("level.max")){
                                $player->sendMessage(C::RED . "§l§c♥ §aĐệ Tử§b → Bạn Đã Nâng Cấp Lên Cấp Độ MAX");
                                $inv->onClose($player);
                                return;
                            }
                            if(CoinAPI::getInstance()->myCoin($player) < $entity->getCost()){
                                $player->sendMessage(C::RED . "§l§c♥ §aĐệ Tử§b → Bạn Không Đủ Coin Để Nâng Cấp");
                                return;
                            }
                            $entity->namedtag->setInt("level", $entity->namedtag->getInt("level") + 1);
                            $player->sendMessage(C::GREEN . "§l§c♥ §aĐệ Tử§b → Bạn Đã Nâng Lên Cấp Độ " . $entity->getLevelM());
                            CoinAPI::getInstance()->reduceCoin($player, $entity->getCost());
                            break;
                            case Item::ANVIL:
                            if($entity->getAutoFix() === "yes"){
                                $player->sendMessage(C::RED . "§l§c♥ §aĐệ Tử§b → Bạn Đã Mua AutoFix Rồi");
                                $inv->onClose($player);
                                return;
                            }
                            if(CoinAPI::getInstance()->myCoin($player) <= 400){
                                $player->sendMessage(C::RED . "§l§c♥ §aĐệ Tử§b → Bạn Không Đủ Coin Để Mua");
                                $inv->onClose($player);
                                return;
                            }
                            $entity->namedtag->setString("autofix", "yes");
                            $player->sendMessage(C::GREEN . "§l§c♥ §aĐệ Tử§b → Bạn Đã Mua AutoFix Thành Công");
                            CoinAPI::getInstance()->reduceCoin($player, 400);
                            break;
                            case Item::DRAGON_EGG:
                            if($entity->getEter() === "yes"){
                                $player->sendMessage(C::RED . "§l§c♥ §aĐệ Tử§b → Bạn Đã Mua Eternity Rồi");
                                $inv->onClose($player);
                                return;
                            }
                            if(CoinAPI::getInstance()->myCoin($player) <= 2000){
                                $player->sendMessage(C::RED . "§l§c♥ §aĐệ Tử§b → Bạn Không Đủ Coin Để Mua");
                                $inv->onClose($player);
                                return;
                            }
                            $entity->namedtag->setString("eternity", "yes");
                            $player->sendMessage(C::GREEN . "§l§c♥ §aĐệ Tử§b → Bạn Đã Mua Eternity Thành Công");
                            CoinAPI::getInstance()->reduceCoin($player, 2000);
                            break;
                    }
                    $inv->onClose($player);
                }
            }
        }
    }

    public function onInteract(PlayerInteractEvent $e): void{
        $player = $e->getPlayer();
        $item = $e->getItem();
        $dnbt = $item->getNamedTag();

        if(isset($this->linkable[$player->getName()])){
            if(!$e->getBlock() instanceof Chest){
                $player->sendMessage(C::RED . "§l§c♥ §aĐệ Tử§b → Hãy Kết Nối Vô Rương Không Phải Khối Này " . $e->getBlock()->getName());
                return;
            }
            $entity = $this->linkable[$player->getName()];
            $block = $e->getBlock();
            if($entity instanceof Minion) $entity->namedtag->setString("xyz", $block->getX() . ":" . $block->getY() . ":" . $block->getZ());
            unset($this->linkable[$player->getName()]);
            $player->sendMessage(C::GREEN . "§l§c♥ §aĐệ Tử§b → Bạn Đã Kết Nối Rương Thành Công");
            return;
        }

        if($dnbt->hasTag("summon", StringTag::class)){
            $nbt = Entity::createBaseNBT($player, null, (90 + ($player->getDirection() * 90)) % 360);
            $nbt->setString("eternity", ($dnbt->getString("eternity") ?? "no"));
            $nbt->setString("autofix", ($dnbt->getString("autofix") ?? "no"));
            $nbt->setInt("level", $dnbt->getInt("level"));
            $nbt->setString("player", $player->getName());
            $nbt->setString("xyz", $dnbt->getString("xyz"));
            $nbt->setTag($player->namedtag->getTag("Skin"));
            $entity = new Minion($player->getLevel(), $nbt);
            $entity->spawnToAll();
            $item->setCount($item->getCount() - 1);
            $player->getInventory()->setItemInHand($item);
        }
    }
    public function getEv($player){
		unset($this->linkable[$player->getName()]);
	}
}