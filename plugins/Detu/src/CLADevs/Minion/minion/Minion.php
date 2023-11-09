<?php

declare(strict_types=1);

namespace CLADevs\Minion\minion;

use CLADevs\Minion\Main as Plu;
use pocketmine\command\Command;
use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\block\Block;
use pocketmine\block\Chest;
use pocketmine\entity\Human;
use pocketmine\entity\Skin;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\utils\Config;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\item\Item;
use pocketmine\level\Position;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\AnimatePacket;
use onebone\economyapi\EconomyAPI;
use DaPigGuy\PiggyCustomEnchants\CustomEnchants\CustomEnchants;
use pocketmine\item\enchantment\{Enchantment, EnchantmentInstance};
use DaPigGuy\PiggyCustomEnchants\Main as CE;
use pocketmine\entity\Entity;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat as C;
use SellHand\Main as el;
use function yaml_parse;

class Minion extends Human{

    protected $player;
    public $itemhand;
    public $inv;
    public $pointapi;
    public $picklv;
    public $eco;
    private $mode;
    protected $nosell;
	
    public function initEntity(): void{
        parent::initEntity();
        $this->player = $this->namedtag->getString("player");
        $this->setHealth(1);
        $this->setMaxHealth(1);
        $this->setNameTagAlwaysVisible();
        $this->setNameTag("§l§e•§cĐệ Tử§e•\n§e↣§aCủa§f: §6" . $this->player . "\n§e•§aCấp§f: §e" . $this->getLevelM());
        $this->setScale((float)Plu::get()->getConfig()->get("size"));
        $this->sendSpawnItems();
    }

    public function attack(EntityDamageEvent $source): void{
        $source->setCancelled();
        if($source instanceof EntityDamageByEntityEvent){
            $damager = $source->getDamager();
            if($damager instanceof Player){
            if($damager->getName() !== $this->player){
                if(!$damager->hasPermission("detu.openall")){
                    $damager->sendMessage(C::RED . "§l§e↣§cĐây Không Phải Đệ Tử Của Bạn");
                    return;
                }}
                $pos = new Position(intval($damager->getX()), intval($damager->getY()) + 2, intval($damager->getZ()), $damager->getLevel());
                $damager->addWindow(new HopperInventory($pos, $this));
            }
        }
    }

    public function entityBaseTick(int $tickDiff = 1): bool{
        $this->eco = Plu::get()->getServer()->getPluginManager()->getPlugin("EconomyAPI");
        
        $update = parent::entityBaseTick($tickDiff);
        if($this->getLevel()->getServer()->getTick() % $this->getMineTime() == 0){
            //Checks if theres a chest behind him
            if($this->getLookingBehind() instanceof Chest){
                $b = $this->getLookingBehind();
                $this->namedtag->setString("xyz", $b->getX() . ":" . $b->getY() . ":" . $b->getZ());
            }
            //Update the coordinates
            if($this->namedtag->getString("xyz") !== "n"){
                if(isset($this->getCoord()[1])){
                    $block = $this->getLevel()->getBlock(new Vector3(intval($this->getCoord()[0]), intval($this->getCoord()[1]), intval($this->getCoord()[2])));
                    if(!$block instanceof Chest){
                        $this->namedtag->setString("xyz", "n");
                    }
                    $k = $this->getLevel()->getBlock(new Vector3(intval($this->getCoord()[0] ?? 0), intval($this->getCoord()[1] ?? 0), intval($this->getCoord()[2] ?? 0)));
        $tile = $this->getLevel()->getTile($k);
        if($tile instanceof \pocketmine\tile\Chest){
            $inv = $tile->getInventory();
            $this->itemhand = $inv->getItem(0);
            $this->inv = $inv;
        $this->setNameTag("§l§e•§cĐệ Tử§e•\n§e↣§aCủa§f: §6" . $this->player . "\n§e•§aCấp§f: §e" . $this->getLevelM());
            Entity::registerEntity(Self::class, true);
            $player = $this->getLevel()->getServer()->getPlayer($this->player);
            $wood = Item::get(270);
            $stone = Item::get(274);
            $iron = Item::get(257);
            $gold = Item::get(285);
            $diamond = Item::get(278);
            $air = Item::get(Item::AIR);
        $this->getInventory()->setItemInHand($this->itemhand ?? $air);
        $this->getInventory()->sendHeldItem($this->getViewers());
        if($this->itemhand->getId() !== 278){
		if($player = Plu::get()->getServer()->getPlayer($this->player)){
            $player->sendPopup("§l§e↣§aĐệ Tử Cần Cúp Kim Cương");
            return false;
        }
        }
                }
            }
			}
            //Breaks
            if ($this->getLookingBlock()->getId() !== Block::AIR and $this->isChestLinked()){
                if($this->checkEverythingElse()){
                    $pk = new AnimatePacket();
                    $pk->entityRuntimeId = $this->id;
                    $pk->action = AnimatePacket::ACTION_SWING_ARM;
                    foreach (Server::getInstance()->getOnlinePlayers() as $p) $p->dataPacket($pk);
                    $this->breakBlock($this->getLookingBlock());
                }
            }
        }
        return $update;
    }

    public function sendSpawnItems(): void{
        $air = Item::get(Item::AIR);
        $this->getInventory()->setItemInHand($this->itemhand ?? $air);
        $this->getArmorInventory()->setHelmet( Item::get(Item::AIR));
        $this->getArmorInventory()->setChestplate(Item::get(Item::AIR));
        $this->getArmorInventory()->setLeggings(Item::get(Item::AIR));
        $this->getArmorInventory()->setBoots(Item::get(Item::AIR));
    }

    public function getLookingBlock(): Block{
        $block = Block::get(Block::AIR);
        switch($this->getDirection()){
            case 0:
                $block = $this->getLevel()->getBlock($this->add(1, 0, 0));
                break;
            case 1:
                $block = $this->getLevel()->getBlock($this->add(0, 0, 1));
                break;
            case 2:
                $block = $this->getLevel()->getBlock($this->add(-1, 0, 0));
                break;
            case 3:
                $block = $this->getLevel()->getBlock($this->add(0, 0, -1));
                break;
        }
        return $block;
    }

    public function getLookingBehind(): Block{
        $block = Block::get(Block::AIR);
        switch($this->getDirection()){
            case 0:
                $block = $this->getLevel()->getBlock($this->add(-1, 0, 0));
                break;
            case 1:
                $block = $this->getLevel()->getBlock($this->add(0, 0, -1));
                break;
            case 2:
                $block = $this->getLevel()->getBlock($this->add(1, 0, 0));
                break;
            case 3:
                $block = $this->getLevel()->getBlock($this->add(0, 0, 1));
                break;
        }
        return $block;
    }

    public function checkEverythingElse(): bool{
        $player = $this->getLevel()->getServer()->getPlayer($this->player);
        $damage = $this->itemhand->getDamage();
        if($damage >= 1560){
            if($player = Plu::get()->getServer()->getPlayer($this->player)){
        $player->sendPopup("§l§e↣§cCúp Của Đệ Tử Sắp Hỏng Hãy Sửa Chữa Để Đệ Tiếp Tục Đào");
            }
        return false;
        }
        $player = $this->getLevel()->getServer()->getPlayer($this->player);
        if(null == $player){
            return false;
        }
        $sellall = $this->getLevel()->getServer()->getPluginManager()->getPlugin("SellCommand");
        $sell = $sellall->sell;
        $block = $this->getLevel()->getBlock(new Vector3(intval($this->getCoord()[0]), intval($this->getCoord()[1]), intval($this->getCoord()[2])));
        $tile = $this->getLevel()->getTile($block);

        if($tile instanceof \pocketmine\tile\Chest){
            $inventory = $tile->getInventory();

            if(Plu::get()->getConfig()->getNested("blocks.normal")){
                foreach($block->getDropsForCompatibleTool($this->itemhand) as $drop){
                    if(!$inventory->canAddItem($drop)){
    $items = $inventory->getContents();
	$xu = 0;
						foreach($items as $item){
							if($sell->get($item->getId()) !== null && $sell->get($item->getId()) > 0){
								$price = $sell->get($item->getId()) * $item->getCount();
								
								if(Plu::get()->mode($this->player) == "on"){
								    if($player = Plu::get()->getServer()->getPlayer($this->player)){
                 $xu = $xu + $price;
							}
								}
                $inventory->remove($item);
							}
							}
                $player->sendMessage("§l§e↣§ađệ tử đã bán được §e[".$xu."]§a xu và gửi cho bạn");          			                EconomyAPI::getInstance()->addMoney($player, $xu);
                }
						}
    if($inventory->canAddItem($drop)){ return true;}elseif(!$inventory->canAddItem($drop)){ 
        if($player = Plu::get()->getServer()->getPlayer($this->player)){
        $player->sendMessage(C::RED . C::BOLD . "§l§e•> §cĐệ của bạn không bán dsược vật phẩm trong rương");
        return false;
        }
        }
            }elseif(!in_array($block->getId(), Plu::get()->getConfig()->getNested("blocks.cannot"))){
    if($player = Plu::get()->getServer()->getPlayer($this->player)){
        $player->sendMessage(C::RED . C::BOLD . "§l§e↣§cĐệ của bạn không phá được block này");
    }
        return false;
            }
            return false;
        }
        return false;
    }

    public function breakBlock(Block $block): bool{
		$i = $this->itemhand;
		$icn = $i->getCustomName();
		$pas = explode(" ", $icn);
        $player = $this->getLevel()->getServer()->getPlayer($this->player);
        $p = $player;
		$name = $p->getName();
        $b = $this->getLevel()->getBlock(new Vector3(intval($this->getCoord()[0]), intval($this->getCoord()[1]), intval($this->getCoord()[2])));
        $tile = $this->getLevel()->getTile($b);
        $damage = $this->itemhand->getDamage();
        $add5 = 0;
        if(($level2 = $this->itemhand->getEnchantmentLevel(Enchantment::UNBREAKING)) > 0){
            $add2 = rand(0, $level2);
            $add3 = rand(0, $add2);
            $add4 = rand(0, $add3);
            $add5 = rand(0, $add4);
        }
        $level = 0;
        if($add5 == 0){
        $dam = $this->itemhand->setDamage($damage + 1);
            $this->inv->setItem(0, $dam);
        }
        if($this->getAutoFix() === "yes"){
            if($damage >= 1500){
    $dam = $this->itemhand->setDamage(0);
            $this->inv->setItem(0, $dam);
        }
        }
        if($tile instanceof \pocketmine\tile\Chest){
            $inv = $tile->getInventory();
            if(Plu::get()->getConfig()->getNested("blocks.normal")){
                $drop = $block->getDrops($this->itemhand);
                /*foreach($drop as $drops){
                $inv->addItem($drops);
                }*/
               if(($level = $this->itemhand->getEnchantmentLevel(Enchantment::FORTUNE)) > 0 || $this->itemhand->getEnchantmentLevel(Enchantment::SILK_TOUCH) > 0){
                   if(in_array($block->getId(), [Item::NETHER_QUARTZ_ORE,Item::LEAVES,Item::EMERALD_ORE,Item::REDSTONE_ORE,Item::LAPIS_ORE,Item::DIAMOND_ORE,Item::COAL_ORE])){
					$add = rand(0, $level);
					switch($block->getId()){
						case Item::COAL_ORE:
						     if($silk = $this->itemhand->getEnchantmentLevel(Enchantment::SILK_TOUCH) > 0){$inv->addItem(Item::get(Item::COAL_ORE, 0, 1 + $add));}else{
						     $inv->addItem(Item::get(Item::COAL, 0, 1 + $add));}
						break;
						case Item::DIAMOND_ORE:
							if($this->itemhand->getEnchantmentLevel(Enchantment::SILK_TOUCH) > 0){$inv->addItem(Item::get(Item::DIAMOND_ORE, 0, 1 + $add));}else{
							$inv->addItem(Item::get(Item::DIAMOND, 0, 1 + $add));}
						break;
						case Item::LAPIS_ORE:
							if($this->itemhand->getEnchantmentLevel(Enchantment::SILK_TOUCH) > 0){$inv->addItem(Item::get(Item::LAPIS_ORE, 4, 1 + $add));}else{
							$inv->addItem(Item::get(Item::DYE, 4, rand(4, 8) + $add));}
						break;
						case Item::REDSTONE_ORE:
							if($this->itemhand->getEnchantmentLevel(Enchantment::SILK_TOUCH) > 0){$inv->addItem(Item::get(Item::REDSTONE_ORE, 0, 1 + $add));}else{
							$inv->addItem(Item::get(Item::REDSTONE_DUST, 0, rand(4, 8) + $add));}
						break;
						case Item::EMERALD_ORE:
							if($this->itemhand->getEnchantmentLevel(Enchantment::SILK_TOUCH) > 0){$inv->addItem(Item::get(Item::EMERALD_ORE, 0, 1 + $add));}else{
							$inv->addItem(Item::get(Item::EMERALD, 0, 1 + $add));}
						break;
						case Item::LEAVES:
							if(rand(0, 100) <= $level * 2){
							    if($this->itemhand->getEnchantmentLevel(Enchantment::SILK_TOUCH) > 0){$inv->addItem(Item::get(Item::LEAVES));}else{
								$inv->addItem(Item::get(Item::APPLE));}
							}
						break;
						case Item::NETHER_QUARTZ_ORE:
							if($this->itemhand->getEnchantmentLevel(Enchantment::SILK_TOUCH) > 0){$inv->addItem(Item::get(Item::NETHER_QUARTZ, 1, 1 + $add));}else{
							$inv->addItem(Item::get(Item::NETHER_QUARTZ, 1, rand(4, 8) + $add));}
						break;
					}
					if($this->getEter() === "no"){
					$this->getLevel()->setBlock($block, Block::get(Block::AIR), true, true);
					}
			    return false;
                   }
                }
						    if($this->itemhand->getEnchantmentLevel(Enchantment::SILK_TOUCH) > 0){
				        foreach($drop as $drops){
                $inv->addItem($drops);
				        }
				    }else{
                foreach($drop as $drops){
                $inv->addItem($drops);
				        }
                    if($this->getEter() === "no"){
						$this->getLevel()->setBlock($block, Block::get(Block::AIR), true, true);
                    }
                }
				    }
					}else{
                if(in_array($block->getId(), Plu::get()->getConfig()->getNested("blocks.cannot"))){
                    return false;
                //$inv->addItem(Item::get($block->getId(), $block->getDamage()));
            }
        }
        if($this->getEter() === "no"){
        $this->getLevel()->setBlock($block, Block::get(Block::AIR), true, true);
        }
        return true;
    }

    public function getMaxTime(): int{
        return (1 * Plu::get()->getConfig()->getNested("level.max")) + 1;
    }

    public function getMineTime(): int{
        return $this->getMaxTime() - (1 * $this->namedtag->getInt("level"));
    }

    public function getCost(): int{
        return Plu::get()->getConfig()->getNested("level.cost") * $this->getLevelM();
    }

    public function getLevelM(): int{
        return $this->namedtag->getInt("level");
    }
    
    public function getEter(): string{
        return $this->namedtag->getString("eternity") ?? "no";
    }
    
    public function getAutoFix(): string{
        return $this->namedtag->getString("autofix") ?? "no";
    }

    public function isChestLinked(): bool{
        return $this->namedtag->getString("xyz") === "n" ? false : true;
    }

    public function getChestCoordinates(): string{
        if(!isset($this->getCoord()[1])){
            return C::RED . "§l§e↣§cĐệ tử không tìm thấy rương kết nối";
        }
        $coord = C::YELLOW . "X: " . C::WHITE . $this->getCoord()[0] . " ";
        $coord .= C::YELLOW . "Y: " . C::WHITE . $this->getCoord()[1] . " ";
        $coord .= C::YELLOW . "Z: " . C::WHITE . $this->getCoord()[2] . " ";
        return $coord;
    }

    public function getCoord(): array{
        $coord = explode(":", $this->namedtag->getString("xyz"));
        return $coord;
    }
}
