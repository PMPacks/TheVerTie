<?php

namespace enchant;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

class Main extends PluginBase implements Listener{

 public function onEnable() : void{
   $this->getServer()->getPluginManager()->registerEvents($this , $this);
 }
 public function onCommand(CommandSender $sender, Command $cmd, String $label, array $args) : bool{
   switch($cmd->getName()){
     case "danhsachenchant":
      if ($sender instanceof Player);
       $sender->sendMessage("§e§l-----Danh Sách Enchant----------");
       $sender->sendMessage("§a§l
    armored: Giảm Sát thương từ kiếm
    autorepair: Tự động sửa chữa khi di chuyển
    tank: Giảm sát thương từ cung
    heavy: Giảm sát thương từ rìu
    berserker: Tăng sức mạnh khi đói
    focused: Giảm hiệu ứng buồn nôn
    frozen: Gây trói khi đánh kẻ thù
    glowing: Nhìn trong đêm
    jackpot: Tỷ lệ nhận ore xịn cao hơn khi đào ore
    enraged: Tăng sức mạnh khi được trang bị
    revive: Dùng 1 lv ec để hồi sinh 
    antiknockback: Kháng đẩy lùi
    antitoxin : Cho Phép Miễn Nhiễm Với Độc
    aerial: Khi trên không tăng sát thương
    backstab: Gây sát thương thêm khi đánh từ sau lưng
    blessed: Cho cơ hội loại bỏ hiệu ứng xâu khi đánh
    blaze: Bắn ra quả cầu lửa 
    blind: Gây mù khi đánh kẻ thù
    charge: Sát thương tăng khi chạy nhanh
    cripple: Gây buồn nôn và chậm chạp khi đánh
    cursed: Gây khô héo cho địch khi đánh mình
    deathbringer: Tăng sát thương gây ra
    deepwounds: Gây sát thương sâu chảy máu
    drunk: Gây deffbuff chậm nôn khi đụng trúng địch
    endershift: Nhận tốc độ + Hấp thụ khi yếu máu
    Famer : Tự trồng lại nông sản khi thu hoạch
    gooey: Hất tung kẻ địch khi đánh
    hardened: Gây sát thương vào điểm yếu kẻ thù
    poison: Gây độc
    poisoned: Gây độc cho kẻ thù khi bị đánh
    revulsion: Gây buồn nôn cho kẻ đánh mình
    wither: Khô héo    
    meditation: Cứ 20s sẽ hồi 1 lượng đói + máu khi đứng yên tăng theo lv
    lightning: Tỷ lệ ra sét khi đánh hoặc bắn 
    parachute:  Làm chậm thêm khi địch di chuyển 3 block
    paralyze: Gây chậm mù yếu khi đánh :3
    vampire: Chuyển đổi sát thương ra máu    
    starve: Gây yếu đuối làm chậm kẻ thù
    sloth: LÀm kẻ thù bị ngộ độc
    witherskull: Bắn ra đầu khô héo :3
    telepathy: Tự lụm đồ vào túi 
    overload: Tăng HP 1 lv bằng 1 máu 
    obsidianshield: Miễn nhiễm lửa chùa :))
    fertilizer: Cuốc đất 3x3    
    lifesteal: Hút máu
    molotov: Tạo ra lửa 2x2 khi mũi tên trúng kẻ thù
    enlighted: Nhận được hồi máu khi bị đánh    
    homing: Tên sẽ đuổi theo mục tiêu gần
    autociam: Tự động nhắm mục tiêu khi ngồi gần nhất
    driller: Khi đào sẽ khoan 3x3 
    shuffle: Chuyển đổi vị trí với mục tiêu    
    bountyhunter: Tỷ lệ nhận vật phẩm khi đánh
    cactus: Gây sát thương cho kẻ thù xung quanh
    cloaking: Tỷ lệ tàng hình khi bị đánh
    driller: Khi đào sẽ khoan 3x3
    grappling: Dịch chuyển theo mũi tên nếu bắn trúng địch sẽ tp lại địch
    grow: Tăng size khi lén lút phải mặc cả set 
    harvest: Thu hoạch 3x3
    headhunter: Gây sát thương chí tử khi chém vào đầu
    hallucination: Tỷ lệ nhốt kẻ thù trong nhà tù tàng hình
    jetpack: Tỷ lệ ramdon
    luckycharm: Tăng tỷ lệ kích hoạt ec hiệu ứng
    lumberjack: Ngồi xuống và chặt cây sẽ rơi toàn bộ cây
    magmawalker: Hiệu ứng đi trên lava sẽ thành hắc diện 
    missile: Tạo ra ntn khi mũi tên rơi chạm đất
    molten: Bắn lại kẻ thù khi bị bắn trúng :))
    piercing: Bỏ qua giáp khi đánh ( ố six )
    selfdestruct: Spawns TNT khi chết :))
    shielded: Tăng kháng 
    shrink: Tăng độ bền khi mất máu
    smelting: Tự nung khi đào ore 
    spider: Leo tường 
    springs: Nhả vọt xa
    stomp: Nhảy cao
    volley: Bắn 3 mũi tên 1 lần nhưng chia dame");
   return true;
   }
 }
 }