<?php

declare(strict_types=1);

namespace CLADevs\Minion\minion;

use pocketmine\block\Block;
use pocketmine\inventory\CustomInventory;
use pocketmine\item\Item;
use pocketmine\level\Position;
use pocketmine\nbt\NetworkLittleEndianNBTStream;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\protocol\BlockActorDataPacket;
use pocketmine\network\mcpe\protocol\types\WindowTypes;
use pocketmine\Player;
use pocketmine\utils\TextFormat as C;

class HopperInventory extends CustomInventory{

    protected $holder;
    protected $entity;

    public function __construct(Position $position, Minion $entity){
        parent::__construct($position);
        $this->entity = $entity;
        $this->setItem(0, $this->getDestoryItem());
        $this->setItem(1, $this->getAutoFixItem());
        $this->setItem(2, $this->getChestItem());
        $this->setItem(3, $this->getEterItem());
        $this->setItem(4, $this->getLevelItem());
    }

    public function getName(): string{
        return "Hopper";
    }

    public function getDefaultSize(): int{
        return 5;
    }

    public function getNetworkType(): int{
        return WindowTypes::HOPPER;
    }

    public function onOpen(Player $who): void{
        $block = Block::get(Block::HOPPER_BLOCK);
        $block->x = $this->getHolder()->getX();
        $block->y = $this->getHolder()->getY();
        $block->z = $this->getHolder()->getZ();
        $block->level = $this->getHolder()->getLevel();
        $who->getLevel()->sendBlocks([$who], [$block]);
        $w = new NetworkLittleEndianNBTStream;
        $nbt = new CompoundTag("", []);
        $nbt->setString("id", "Hopper");
        $nbt->setString("CustomName", C::GOLD . "Settings");
        $pk = new BlockActorDataPacket();
        $pk->x = $this->getHolder()->getX();
        $pk->y = $this->getHolder()->getY();
        $pk->z = $this->getHolder()->getZ();
        $pk->namedtag = $w->write($nbt);
        $who->dataPacket($pk);
        parent::onOpen($who);
    }

    public function onClose(Player $who): void{
        $block = Block::get(Block::AIR);
        $block->x = $this->getHolder()->getX();
        $block->y = $this->getHolder()->getY();
        $block->z = $this->getHolder()->getZ();
        $block->level = $this->getHolder()->getLevel();
        $who->getLevel()->sendBlocks([$who], [$block]);
        parent::onClose($who);
    }
    
    public function onClose2(Player $who): bool{
        $block = Block::get(Block::AIR);
        $block->x = $this->getHolder()->getX();
        $block->y = $this->getHolder()->getY();
        $block->z = $this->getHolder()->getZ();
        $block->level = $this->getHolder()->getLevel();
        $who->getLevel()->sendBlocks([$who], [$block]);
        parent::onClose($who);
        return true;
    }

    public function getHolder(): Position{
        return $this->holder;
    }

    public function getEntity(): Minion{
        return $this->entity;
    }

    public function getDestoryItem(): Item{
        $item = Item::get(Item::REDSTONE_DUST);
        $item->setCustomName(C::RED . "§l§e•§cThu Hồi Đệ Tử§e•");
        return $item;
    }

    public function getChestItem(): Item{
        $islinked = $this->entity->isChestLinked() ? "Có" : "Không";
        $item = Item::get(Item::CHEST);
        $item->setCustomName(C::DARK_GREEN . "Kết Nối Rương");
        $item->setLore([" ",  C::YELLOW . "Đã Kết Nối: " . C::WHITE . $islinked, C::YELLOW . "Tọa Độ: " . C::WHITE . $this->entity->getChestCoordinates()]);
        return $item;
    }

    public function getLevelItem(): Item{
        $item = Item::get(Item::EMERALD);
        $item->setCustomName(C::LIGHT_PURPLE . "§l§e•§aCấp Độ: " . C::YELLOW . $this->entity->getLevelM());
        $item->setLore([C::LIGHT_PURPLE . "§l§e•§aGiá: " . C::YELLOW . "$" . $this->entity->getCost()]);
        return $item;
    }
    public function getAutoFixItem(): Item{
        $item = Item::get(Item::ANVIL);
        $item->setCustomName("§l§eAutoFix");
        if($this->entity->getAutoFix() === "no"){
                $item->setLore(["§9Bạn Chưa Mua.\n".C::LIGHT_PURPLE . "§l§fGiá: §r§f" . C::YELLOW . " 400 Coin"]);
        }else{
        $item->setLore(["§cBạn Đã Mua."]);
        }
        return $item;
    }
    public function getEterItem(): Item{
        $item = Item::get(Item::DRAGON_EGG);
        $item->setCustomName("§l§6Eternity");
        if($this->entity->getEter() === "no"){
        $item->setLore(["§9Bạn Chưa Mua.\n".C::LIGHT_PURPLE . "§l§fGiá: §r§f" . C::YELLOW . " 2000 Coin"]);
        }else{
        $item->setLore(["§cBạn Đã Mua."]);
        }
        return $item;
    }
}