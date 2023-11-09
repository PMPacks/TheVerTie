<?php

namespace vbeemc\rankup;

use pocketmine\Player;
use pocketmine\Server;

use jojoe77777\FormAPI\SimpleForm;
use onebone\coinapi\CoinAPI;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use pocketmine\command\{Command, CommandSender, ConsoleCommandSender};

class Main extends PluginBase implements Listener{
  
  public function onEnable(){
    $this->getServer()->getLogger()->info("§a§lPLUGIN RANKUP BY VBEEMC CODE");
    $this->getServer()->getPluginManager()->registerEvents($this ,$this);
    $this->form = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
    $this->coinapi = $this->getServer()->getPluginManager()->getPlugin("CoinAPI");
  }
   public function onCommand(CommandSender $sender,Command $cmd ,string $label ,array $args) : bool{
    switch($cmd->getName()){
      case "muarank":
        $this->mainForm($sender);
    }
    return true;
   }
  public function mainForm($sender){
     if ($sender instanceof Player){
     $form = new SimpleForm(function(Player $sender, $data){
       $result = $data;
     if ($result == null){
     }
       switch($result){
         case 0:
         break;
         case 1:
           $this->muarank($sender);
           break;
         case 2:
           $this->thuerank($sender);
           break;
       }
       });
       $form->setTitle("§3§l• §2ShopRank §e•");
       $form->setContent("§e§lCảm ơn bạn đã sử dụng§e§l Mua Rank. Hãy chọn mục bên dưới §e§lĐể tiến hành mua rank");
       $form->addButton("§3§l• §2Thoát §3•",1,"https://cdn-icons-png.flaticon.com/512/1828/1828843.png");
       $form->addButton("§3§l• §2Mua Rank §3•",1,"https://cdn-icons-png.flaticon.com/512/1603/1603847.png");
       $form->addButton("§3§l• §2Thuê Rank §3•",1,"https://cdn-icons-png.flaticon.com/512/602/602270.png");
       $form->sendToPlayer($sender);
     }
  }
  public function muarank($sender){
    if ($sender instanceof Player){
     $form = new SimpleForm(function(Player $sender , $data){
      $result = $data;
    if ($result == null){
    }
      switch($result){
        case 0:
        break;
        case 1:
        $this->VIPI($sender);
        break;
        case 2:
        $this->VIPII($sender);
        break;
        case 3:
        $this->VIPIII($sender);
        break;
        case 4:
        $this->VIPIV($sender);
        break;
        case 5:
        $this->VIPV($sender);
        break;
        case 6:
        $this->VIPVI($sender);
        break;
        case 7:
        $this->VIPVII($sender);
        break;
      }
     });
     $form->setTitle("§3§l• §2Mua Rank §3•");
     $form->addButton("§3§l• §2Thoát §3•",1,"https://cdn-icons-png.flaticon.com/512/1828/1828843.png");
     $form->addButton("§3§l• §2Gói VIP 1 §3•",1,"https://cdn-icons-png.flaticon.com/512/3791/3791579.png");
     $form->addButton("§3§l• §2Gói VIP 2 §3•",1,"https://cdn-icons-png.flaticon.com/512/3791/3791579.png");
     $form->addButton("§3§l• §2Gói VIP 3 §3•",1,"https://cdn-icons-png.flaticon.com/512/3791/3791579.png");
     $form->addButton("§3§l• §2Gói VIP 4 §3•",1,"https://cdn-icons-png.flaticon.com/512/3791/3791579.png");
     $form->addButton("§3§l• §2Gói VIP 5 §3•",1,"https://cdn-icons-png.flaticon.com/512/3791/3791579.png");
     $form->addButton("§3§l• §2Gói VIP 6 §3•",1,"https://cdn-icons-png.flaticon.com/512/3791/3791579.png");
     $form->addButton("§3§l• §2Gói VIP 7 §3•",1,"https://cdn-icons-png.flaticon.com/512/3791/3791579.png");
     $form->sendToPlayer($sender);
    }
  }
  public function VIPI($sender){
   if ($sender instanceof Player){
     $form = new SimpleForm(function(Player $sender , $data){
      $result = $data;
    if ($result == null){
    }
    switch($result){
      case 0:
      $this->muarank($sender);
      break;
      case 1:
      $coin = $this->coinapi->myCoin($sender);
      if ($coin >= 1000){
      $this->coinapi->reduceCoin($sender, 1000);
      $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setgroup " .$sender->getName(). " VIPI");
      $this->getServer()->broadcastMessage("§e§lĐại Gia " .$sender->getName(). " §e§lVừa Mua Thành Công Gói §aVIPI");
      }else{
        $sender->sendMessage("§e§lBạn không có đủ §aCoin §eđể mua VIP I");
      }
      
      break;
    }
     });
     $form->setTitle("§a§l• VIP I •");
     $form->setContent("§e§l• Quyền Lợi VIP I\n§e§l• Fly : §aBay Trên Cao\n§e§l• Thời Hạn : §aVĩnh Viễn\n§e§l• Giá : §a1000 Coin\n\n");
     $form->addButton("§e§l• Quay Lại •");
     $form->addButton("§e§l• Mua Ngay •");
     $form->sendToPlayer($sender);
   }
  }
  public function VIPII($sender){
   if ($sender instanceof Player){
     $form = new SimpleForm(function(Player $sender , $data){
      $result = $data;
    if ($result == null){
    }
    switch($result){
      case 0:
      $this->muarank($sender);
      break;
      case 1:
      $coin = $this->coinapi->myCoin($sender);
      if ($coin >= 1200){
      $this->coinapi->reduceCoin($sender, 1200);
      $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setgroup " .$sender->getName()(). " VIPII");
      $this->getServer()->broadcastMessage("§e§lĐại Gia " .$sender->getName. " §e§lVừa Mua Thành Công Gói §aVIPII");
      }else{
        $sender->sendMessage("§e§lBạn không có đủ §aCoin §eđể mua VIP II");
      }
      
      break;
    }
     });
     $form->setTitle("§a§l• VIP II •");
     $form->setContent("§e§l• Quyền Lợi VIP II\n§e§l• Fly : §aBay Trên Cao\n§e§l• Heal : §aHồi HP Ngay\n§e§l• Thời Hạn : §aVĩnh Viễn\n§e§l• Giá : §a41200 Coin\n\n");
     $form->addButton("§e§l• Quay Lại •");
     $form->addButton("§e§l• Mua Ngay •");
     $form->sendToPlayer($sender);
    }
  }
  public function VIPIII($sender){
   if ($sender instanceof Player){
     $form = new SimpleForm(function(Player $sender , $data){
      $result = $data;
    if ($result == null){
    }
    switch($result){
      case 0:
      $this->muarank($sender);
      break;
      case 1:
      $coin = $this->coinapi->myCoin($sender);
      if ($coin >= 1400){
      $this->coinapi->reduceCoin($sender, 1400);
      $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setgroup " .$sender->getName(). " VIPIII");
      $this->getServer()->broadcastMessage("§e§lĐại Gia " .$sender->getName(). " §e§lVừa Mua Thành Công Gói §aVIPIII");
      }else{
        $sender->sendMessage("§e§lBạn không có đủ §aCoin §eđể mua VIP III");
      }
      
      break;
    }
     });
     $form->setTitle("§a§l• VIP III •");
     $form->setContent("§e§l• Quyền Lợi VIP III\n§e§l• Fly : §aBay Trên Cao\n§e§l• Heal : §aHồi HP Ngay\n§e§l• Feed : §aHồi Thức Ăn Ngay\n§e§l• Thời Hạn : §aVĩnh Viễn\n§e§l• Giá : §a1400 Coin\n\n");
     $form->addButton("§e§l• Quay Lại •");
     $form->addButton("§e§l• Mua Ngay •");
     $form->sendToPlayer($sender);
      }
    }
  public function VIPIV($sender){
   if ($sender instanceof Player){
     $form = new SimpleForm(function(Player $sender , $data){
      $result = $data;
    if ($result == null){
    }
    switch($result){
      case 0:
      $this->muarank($sender);
      break;
      case 1:
      $coin = $this->coinapi->myCoin($sender);
      if ($coin >= 1600){
      $this->coinapi->reduceCoin($sender, 1600);
      $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setgroup " .$sender->getName(). " VIPIV");
      $this->getServer()->broadcastMessage("§e§lNgười Chơi " .$sender->getName(). " §e§lVừa Mua Thành Công Gói §aVIPIV");
      }else{
        $sender->sendMessage("§e§lBạn không có đủ §aCoin §eđể mua VIP IV");
      }
      
      break;
    }
     });
     $form->setTitle("§a§l• VIP IV •");
     $form->setContent("§e§l• Quyền Lợi VIP IV\n§e§l• Fly : §aBay Trên Cao\n§e§l• Heal : §aHồi HP Ngay\n§e§l• Feed : §aHồi Thức Ăn Ngay\n§e§l• AutoSell : §aBán Đồ Tự Động\n§e§l• Thời Hạn : §aVĩnh Viễn\n§e§l• Giá : §a1600 Coin\n\n");
     $form->addButton("§e§l• Quay Lại •");
     $form->addButton("§e§l• Mua Ngay •");
     $form->sendToPlayer($sender);  
     }
    }
    public function VIPV($sender){
   if ($sender instanceof Player){
     $form = new SimpleForm(function(Player $sender , $data){
      $result = $data;
    if ($result == null){
    }
    switch($result){
      case 0:
      $this->muarank($sender);
      break;
      case 1:
      $coin = $this->coinapi->myCoin($sender);
      if ($coin >= 1800){
      $this->coinapi->reduceCoin($sender, 1800);
      $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setgroup " .$sender->getName(). " VIPV");
      $this->getServer()->broadcastMessage("§e§lĐại Gia " .$sender->getName(). " §e§lVừa Mua Thành Công Gói §aVIPV");
      }else{
        $sender->sendMessage("§e§lBạn không có đủ §aCoin §eđể mua VIPV");
      }
      
      break;
    }
     });
     $form->setTitle("§a§l• VIP V •");
     $form->setContent("§e§l• Quyền Lợi VIP V\n§e§l• Fly : §aBay Trên Cao\n§e§l• Heal : §aHồi HP Ngay\n§e§l• Feed : §aHồi Thức Ăn Ngay\n§e§l• AutoSell : §aBán Đồ Tự Động\n§e§l• Spider : §aLeo Tường\n§e§l• Thời Hạn : §aVĩnh Viễn\n§e§l• Giá : §a1800 Coin\n\n");
     $form->addButton("§e§l• Quay Lại •");
     $form->addButton("§e§l• Mua Ngay •");
     $form->sendToPlayer($sender);
  }
     }
     public function VIPVI($sender){
   if ($sender instanceof Player){
     $form = new SimpleForm(function(Player $sender , $data){
      $result = $data;
    if ($result == null){
    }
    switch($result){
      case 0:
      $this->muarank($sender);
      break;
      case 1:
      $coin = $this->coinapi->myCoin($sender);
      if ($coin >= 2000){
      $this->coinapi->reduceCoin($sender, 2000);
      $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setgroup " .$sender->getName(). " VIPVI");
      $this->getServer()->broadcastMessage("§e§lĐại Gia " .$sender->getName(). " §e§lVừa Mua Thành Công Gói §aVIPVI");
      }else{
        $sender->sendMessage("§e§lBạn không có đủ §aCoin §eđể mua VIPVI");
      }
      
      break;
    }
     });
     $form->setTitle("§a§l• VIP VI •");
     $form->setContent("§e§l• Quyền Lợi VIP VI\n§e§l• Fly : §aBay Trên Cao\n§e§l• Heal : §aHồi HP Ngay\n§e§l• Feed : §aHồi Thức Ăn Ngay\n§e§l• AutoSell : §aBán Đồ Tự Động\n§e§l• Spider : §aLeo Tường\n§e§l• Thời Hạn : §aVĩnh Viễn\n§e§l• Giá : §a2000 Coin\n\n");
     $form->addButton("§e§l• Quay Lại •");
     $form->addButton("§e§l• Mua Ngay •");
     $form->sendToPlayer($sender);
     }
   }
   public function VIPVII($sender){
   if ($sender instanceof Player){
     $form = new SimpleForm(function(Player $sender , $data){
      $result = $data;
    if ($result == null){
    }
    switch($result){
      case 0:
      $this->muarank($sender);
      break;
      case 1:
      $coin = $this->coinapi->myCoin($sender);
      if ($coin >= 2200){
      $this->coinapi->reduceCoin($sender, 2200);
      $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setgroup " .$sender->getName(). " VIPVII");
      $this->getServer()->broadcastMessage("§e§lĐại Gia " .$sender->getName(). " §e§lVừa Mua Thành Công Gói §aVIPVII");
      }else{
        $sender->sendMessage("§e§lBạn không có đủ §aCoin §eđể mua VIPVII");
      }
      
      break;
    }
     });
     $form->setTitle("§a§l• VIP VII •");
     $form->setContent("§e§l• Quyền Lợi VIP VII\n§e§l• Fly : §aBay Trên Cao\n§e§l• Heal : §aHồi HP Ngay\n§e§l• Feed : §aHồi Thức Ăn Ngay\n§e§l• AutoSell : §aBán Đồ Tự Động\n§e§l• Spider : §aLeo Tường\n§e§l• Tp : §aDịch Chuyển\n§e§l• Thời Hạn : §aVĩnh Viễn\n§e§l• Giá : §a2200 Coin\n\n");
     $form->addButton("§e§l• Quay Lại •");
     $form->addButton("§e§l• Mua Ngay •");
     $form->sendToPlayer($sender);
   }
   }
  public function thuerank($sender){
   if ($sender instanceof Player){
  $form = new SimpleForm(function(Player $sender, $data){
    $result = $data;
    switch($result){
      case 0:
      break;
      case 1:
      $this->VIP1($sender);
      break;
      case 2:
      $this->VIP2($sender);
      break;
      case 3:
      $this->VIP3($sender);
      break;
      case 4:
      $this->VIP4($sender);
      break;
      case 5:
      $this->VIP5($sender);
      break;
      case 6:
      $this->VIP6($sender);
      break;
      case 7:
      $this->VIP7($sender);
      break;
    }
  });
  $form->setTitle("§3§l• §2Thuê Rank §3•");
     $form->addButton("§3§l• §2Thoát §3•",1,"https://cdn-icons-png.flaticon.com/512/1828/1828843.png");
     $form->addButton("§3§l• §2Gói VIP I §3•",1,"https://cdn-icons-png.flaticon.com/512/6108/6108045.png");
     $form->addButton("§3§l• §2Gói VIP II §3•",1,"https://cdn-icons-png.flaticon.com/512/6108/6108045.png");
     $form->addButton("§3§l• §2Gói VIP III §3•",1,"https://cdn-icons-png.flaticon.com/512/6108/6108045.png");
     $form->addButton("§3§l• §2Gói VIP IV §3•",1,"https://cdn-icons-png.flaticon.com/512/6108/6108045.png");
     $form->addButton("§3§l• §2Gói VIP V §3•",1,"https://cdn-icons-png.flaticon.com/512/6108/6108045.png");
     $form->addButton("§3§l• §2Gói VIP VI §3•",1,"https://cdn-icons-png.flaticon.com/512/6108/6108045.png");
     $form->addButton("§3§l• §2Gói VIP VII §3•",1,"https://cdn-icons-png.flaticon.com/512/6108/6108045.png");
     $form->sendToPlayer($sender);
   }
  }
  public function VIP1($sender){
   if ($sender instanceof Player){
     $form = new SimpleForm(function(Player $sender , $data){
      $result = $data;
    if ($result == null){
    }
    switch($result){
      case 0:
      $this->thuerank($sender);
      break;
      case 1:
      $coin = $this->coinapi->myCoin($sender);
      if ($coin >= 30){
      $this->coinapi->reduceCoin($sender, 30);
      $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setvip " .$sender->getName(). " VIPI 3");
      $this->getServer()->broadcastMessage("§e§lNgười Chơi " .$sender->getName(). " §e§lVừa Thuê Thành Công Gói §aVIPI");
      }else{
        $sender->sendMessage("§e§lBạn không có đủ §aCoin §eđể mua VIP I");
      }
      
      break;
    }
     });
     $form->setTitle("§a§l• VIP I •");
     $form->setContent("§e§l• Quyền Lợi VIP I\n§e§l• Fly : §aBay Trên Cao\n§e§l• Thời Hạn : §a3 Ngày\n§e§l• Giá : §a30 Coin\n\n");
     $form->addButton("§e§l• Quay Lại •");
     $form->addButton("§e§l• Thuê Ngay •");
     $form->sendToPlayer($sender);
   }
  }
  public function VIP2($sender){
   if ($sender instanceof Player){
     $form = new SimpleForm(function(Player $sender , $data){
      $result = $data;
    if ($result == null){
    }
    switch($result){
      case 0:
      $this->thuerank($sender);
      break;
      case 1:
      $coin = $this->coinapi->myCoin($sender);
      if ($coin >= 60){
      $this->coinapi->reduceCoin($sender, 60);
      $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setvip " .$sender->getName(). " VIPII 5");
      $this->getServer()->broadcastMessage("§e§lNgười Chơi " .$sender->getName(). " §e§lVừa Thuê Thành Công Gói §aVIPII");
      }else{
        $sender->sendMessage("§e§lBạn không có đủ §aCoin §eđể mua VIP II");
      }
      
      break;
    }
     });
     $form->setTitle("§a§l• VIP II •");
     $form->setContent("§e§l• Quyền Lợi VIP II\n§e§l• Fly : §aBay Trên Cao\n§e§l• Heal : §aHồi HP Ngay\n§e§l• Thời Hạn : §a5 Ngày\n§e§l• Giá : §a60 Coin\n\n");
     $form->addButton("§e§l• Quay Lại •");
     $form->addButton("§e§l• Thuê Ngay •");
     $form->sendToPlayer($sender);
    }
  }
  public function VIP3($sender){
   if ($sender instanceof Player){
     $form = new SimpleForm(function(Player $sender , $data){
      $result = $data;
    if ($result == null){
    }
    switch($result){
      case 0:
      $this->thuerank($sender);
      break;
      case 1:
      $coin = $this->coinapi->myCoin($sender);
      if ($coin >= 90){
      $this->coinapi->reduceCoin($sender, 90);
      $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setvip " .$sender->getName(). " VIPIII 7");
      $this->getServer()->broadcastMessage("§e§lNgười Chơi " .$sender->getName(). " §e§lVừa Thuê Thành Công Gói §aVIPIII");
      }else{
        $sender->sendMessage("§e§lBạn không có đủ §aCoin §eđể mua VIP III");
      }
      
      break;
    }
     });
     $form->setTitle("§a§l• VIP III •");
     $form->setContent("§e§l• Quyền Lợi VIP III\n§e§l• Fly : §aBay Trên Cao\n§e§l• Heal : §aHồi HP Ngay\n§e§l• Feed : §aHồi Thức Ăn Ngay\n§e§l• Thời Hạn : §a7 Ngày\n§e§l• Giá : §a90 Coin\n\n");
     $form->addButton("§e§l• Quay Lại •");
     $form->addButton("§e§l• Thuê Ngay •");
     $form->sendToPlayer($sender);
      }
    }
  public function VIP4($sender){
   if ($sender instanceof Player){
     $form = new SimpleForm(function(Player $sender , $data){
      $result = $data;
    if ($result == null){
    }
    switch($result){
      case 0:
      $this->thuerank($sender);
      break;
      case 1:
      $coin = $this->coinapi->myCoin($sender);
      if ($coin >= 120){
      $this->coinapi->reduceCoin($sender, 120);
      $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setvip " .$sender->getName(). " VIPIV 10");
      $this->getServer()->broadcastMessage("§e§lNgười Chơi " .$sender->getName(). " §e§lVừa Thuê Thành Công Gói §aVIPV");
      }else{
        $sender->sendMessage("§e§lBạn không có đủ §aCoin §eđể mua VIP VIPIV");
      }
      
      break;
    }
     });
     $form->setTitle("§a§l• VIP IV •");
     $form->setContent("§e§l• Quyền Lợi VIP V\n§e§l• Fly : §aBay Trên Cao\n§e§l• Heal : §aHồi HP Ngay\n§e§l• Feed : §aHồi Thức Ăn Ngay\n§e§l• AutoSell : §aBán Đồ Tự Động\n§e§l• Thời Hạn : §a10 Ngày\n§e§l• Giá : §a120 Coin\n\n");
     $form->addButton("§e§l• Quay Lại •");
     $form->addButton("§e§l• Thuê Ngay •");
     $form->sendToPlayer($sender);  
     }
    }
    public function VIP5($sender){
   if ($sender instanceof Player){
     $form = new SimpleForm(function(Player $sender , $data){
      $result = $data;
    if ($result == null){
    }
    switch($result){
      case 0:
      $this->thuerank($sender);
      break;
      case 1:
      $coin = $this->coinapi->myCoin($sender);
      if ($coin >= 130){
      $this->coinapi->reduceCoin($sender, 130);
      $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setvip " .$sender->getName(). " VIPV 13");
      $this->getServer()->broadcastMessage("§e§lNgười Chơi " .$sender->getName(). " §e§lVừa Thuê Thành Công Gói §aVIPV");
      }else{
        $sender->sendMessage("§e§lBạn không có đủ §aCoin §eđể mua VIPV");
      }
      
      break;
    }
     });
     $form->setTitle("§a§l• VIP V •");
     $form->setContent("§e§l• Quyền Lợi VIP V\n§e§l• Fly : §aBay Trên Cao\n§e§l• Heal : §aHồi HP Ngay\n§e§l• Feed : §aHồi Thức Ăn Ngay\n§e§l• AutoSell : §aBán Đồ Tự Động\n§e§l• Spider : §aLeo Tường\n§e§l• Thời Hạn : §a13 Ngày\n§e§l• Giá : §a130 Coin\n\n");
     $form->addButton("§e§l• Quay Lại •");
     $form->addButton("§e§l• Thuê Ngay •");
     $form->sendToPlayer($sender);
  }
     }
     public function VIP6($sender){
   if ($sender instanceof Player){
     $form = new SimpleForm(function(Player $sender , $data){
      $result = $data;
    if ($result == null){
    }
    switch($result){
      case 0:
      $this->thuerank($sender);
      break;
      case 1:
      $coin = $this->coinapi->myCoin($sender);
      if ($coin >= 140){
      $this->coinapi->reduceCoin($sender, 140);
      $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setvip " .$sender->getName(). " VIPVI 15");
      $this->getServer()->broadcastMessage("§e§lNgười Chơi " .$sender->getName(). " §e§lVừa Thuê Thành Công Gói §aVIPVI");
      }else{
        $sender->sendMessage("§e§lBạn không có đủ §aCoin §eđể mua VIPVI");
      }
      
      break;
    }
     });
     $form->setTitle("§a§l• VIP VI •");
     $form->setContent("§e§l• Quyền Lợi VIP VI\n§e§l• Fly : §aBay Trên Cao\n§e§l• Heal : §aHồi HP Ngay\n§e§l• Feed : §aHồi Thức Ăn Ngay\n§e§l• AutoSell : §aBán Đồ Tự Động\n§e§l• Spider : §aLeo Tường\n§e§l• Thời Hạn : §a15 Ngày\n§e§l• Giá : §a140 Coin\n\n");
     $form->addButton("§e§l• Quay Lại •");
     $form->addButton("§e§l• Thuê Ngay •");
     $form->sendToPlayer($sender);
     }
   }
   public function VIP7($sender){
   if ($sender instanceof Player){
     $form = new SimpleForm(function(Player $sender , $data){
      $result = $data;
    if ($result == null){
    }
    switch($result){
      case 0:
      $this->thuerank($sender);
      break;
      case 1:
      $coin = $this->coinapi->myCoin($sender);
      if ($coin >= 150){
      $this->coinapi->reduceCoin($sender, 150);
      $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setvip " .$sender->getName(). " VIPVII 20");
      $this->getServer()->broadcastMessage("§e§lĐại Gia " .$sender->getName(). " §e§lVừa Thuê Thành Công Gói §aVIPVII");
      }else{
        $sender->sendMessage("§e§lBạn không có đủ §aCoin §eđể mua VIPVII");
      }
      
      break;
    }
     });
     $form->setTitle("§a§l• VIP VII •");
     $form->setContent("§e§l• Quyền Lợi VIP VII\n§e§l• Fly : §aBay Trên Cao\n§e§l• Heal : §aHồi HP Ngay\n§e§l• Feed : §aHồi Thức Ăn Ngay\n§e§l• AutoSell : §aBán Đồ Tự Động\n§e§l• Spider : §aLeo Tường\n§e§l• Tp : §aDịch chuyển\n§l§e• Thời Hạn : §a20 Ngày\n§e§l• Giá : §a150 Coin\n\n");
     $form->addButton("§e§l• Quay Lại •");
     $form->addButton("§e§l• Thuê Ngay •");
     $form->sendToPlayer($sender);
}
}
}