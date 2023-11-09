<?php
namespace MCPEVN;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\scheduler\Task;
use _64FF00\PurePerms\PurePerms;
use pocketmine\event\player\PlayerJoinEvent;

class TickTask extends Task {
    public $p;
	
	public function __construct(SetVip $m) {
		$this->p = $m;
	}
	
	public function onRun($t) {
		
		$this->p->tick();
	}
}

class SetVip extends PluginBase implements Listener {
    public $time;
	public static $instance;
	public $prefix = "§b§l§6[§bHệ Thống§6]§e";
	public $pp;
	
    public function onEnable(){
		
		if(!is_dir($this->getDataFolder())) {
			
			mkdir($this->getDataFolder());
		}
		
		$this->pp = $this->getServer()->getPluginManager()->getPlugin("PurePerms");
		$this->time = new Config($this->getDataFolder() ."time.yml", Config::YAML, []);
		$this->getScheduler()->scheduleRepeatingTask(new TickTask($this), 20);
		self::$instance = $this;
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onJoin(PlayerJoinEvent $ev){
		$p = $ev->getPlayer();
		if($this->time->exists($p->getName())){
			$st = $this->time->get($p->getName())["current-vip"];
			$i = explode(",", $st);	
			$p->sendMessage("§l§c●§e Rank§a " . $i[2] . " §ecủa bạn còn§b " . $i[1] . " ngày");
			if(isset($this->time->get($p->getName())["holding-vip"])){
				$data = '';
				foreach($this->time->get($p->getName())["holding-vip"] as $str){
					$i = explode(",", $str);	
					$data .= "§l§c●§e Rank §a" . $i[1] . " §ecủa bạn còn§b ". $i[0] . " ngày\n";
				}
				$p->sendMessage($data);
			}
		}
	}	
	
    public function onCommand(CommandSender $s, Command $cmd, $label, array $args) :bool {
        if ($cmd->getName() == "setvip") {
            if ($s->hasPermission("setvip.cmd")) {
                if (count($args) == 3) {
                    $name = $args[0];
                    $rank = $args[1];
                    $time = $args[2];
                    $group = $this->pp->getGroup($rank);
                    if ($group == null) {
                        $s->sendMessage($this->prefix . "§c Rank không tồn tại ??:D??");
                        return true;
                    }
                    $all = $this->time->getAll();
                    if (isset($all[$name])) {
                        if (!isset($all[$name]["holding-vip"])) {
                            $i = explode(",", $all[$name]["current-vip"]);
                            $all[$name]["holding-vip"] = [implode(",", [$i[1], $i[2]]) ];
                        } else {
                            $i = explode(",", $all[$name]["current-vip"]);
                            $all[$name]["holding-vip"][] = implode(",", [$i[1], $i[2]]);
                        }
                    }
                    $all[$name]["current-vip"] = implode(",", [date("Y-m-d"), $time, $rank]);
                    $this->time->setAll($all);
                    $this->time->save();
                    $p = $this->pp->getPlayer($name);
                    $this->pp->setGroup($p, $group);
                    if ($p instanceof \pocketmine\Player) {
						$p->sendMessage("§l§f•§b Bạn đã nhận được vip: §e". $rank ." §atrong ". $time ." ngày");
                    }
                    settype($name, "string");
					$s->sendMessage("§l§f•§b Set VIP:§c ". $rank ." §athành công cho §b". $p->getName() ." §ctrong ". $time);
                    return true;
                }
                $s->sendMessage($this->prefix . " Cách Dùng: /setvip <tên> <rank> <ngày>");
                return true;
            }
            $s->sendMessage($this->prefix . "Bạn Không Được Sử Dụng Lệnh Này!");
            return true;
        }
	}
    public function tick() {
		
        $this->time->load($this->getDataFolder() . "time.yml", Config::YAML);
        $all = $this->time->getAll();
        if (count($all) >= 1) {
            foreach ($all as $name => $stuff) {
                if (!isset($all[$name]["current-vip"])) {
                    unset($all[$name]);
                    $this->time->setAll($all);
                }
                if (!isset($all[$name])) {
                    unset($all[$name]);
                }
                $st = $all[$name]["current-vip"];
                $i = explode(",", $st);
                $date1 = strtotime($i[0]);
                $date2 = strtotime(date("y-m-d"));
                $date3 = abs($date2 - $date1);
                $help = $date3 / 86400;
                $date4 = intval($help);
                if ($date4 >= 1) {
                    $i[1] = $i[1] - $date4;
                    $all[$name]["current-vip"] = implode(",", [date("y-m-d"), $i[1], $i[2]]);
                    $this->time->setAll($all);
                    $this->time->save();
                }
                if ($i[1] < 1) {
                    $p = $this->pp->getPlayer($name);
                    if ($p !== null && $this->getServer()->getPlayer($name) !== null) {
				$p->sendMessage("§l§f•§b ". $i[2] ."§e Của bạn đã hết hạn, nếu muốn tiếp tục có vip, xin bạn hãy mua thêm!");
                    }
                    $vperm = $this->pp->getGroup($i[2])->getGroupPermissions();
                    $this->pp->setGroup($p, $this->pp->getDefaultGroup());
                    $pcfg = $this->time->get($name);
                    unset($pcfg["current-vip"]);
                    $this->time->set($name, $pcfg);
                    $this->time->save();
                    if (isset($pcfg["holding-vip"])) {
                        if (count($pcfg["holding-vip"]) >= 1) {
                            $lastest = $pcfg["holding-vip"][(count($pcfg["holding-vip"]) - 1) ];
                            $is = explode(",", $lastest);
                            $group = $this->pp->getGroup($is[1]);
                            if ($group == null) {
                                if ($p !== null && $this->getServer()->getPlayer($name) !== null) {
								$p->sendMessage($this->prefix." ". $is[1] ." của bạn không tồn tại, đang xoá!");
                                }
                                $key = array_search($lastest, $all[$name]["holding-vip"]);
                                unset($all[$name]["holding-vip"][$key]);
                                $this->time->setAll($all);
                                $this->time->save();
                            }
                            $this->pp->setGroup($p, $this->pp->getDefaultGroup());
                            $key = array_search($lastest, $all[$name]["holding-vip"]);
                            unset($all[$name]["holding-vip"][$key]);
                            $this->time->setAll($all);
                            $this->time->save();
                            if (isset($all[$name]["holding-vip"])) {
                                if (count($all[$name]["holding-vip"]) == 0) {
                                    unset($all[$name]["holding-vip"]);
                                }
                            }
                            $all[$name]["current-vip"] = implode(",", [date("y-m-d"), $is[0], $is[1]]);
                            $this->time->setAll($all);
                            $this->time->save();
                            if (isset($pcfg["holding-vip"][$lastest])) {
                                unset($pcfg["holding-vip"][$lastest]);
                                $this->time->set($name, $pcfg);
                                $this->time->save();
                            }
                            break;
                        }
                    } else {
                        unset($all[$name]);
                        $this->time->setAll($all);
                        $this->time->save();
					}
				}
			}
		}
	}
    public static function getInstance() {
        return self::$instance;
    }
}