<?php

namespace Wertzui123\RenameItems;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use Wertzui123\RenameItems\commands\rename;

class Main extends PluginBase implements Listener{

	public function onEnable() : void{
	    $this->ConfigUpdater(1.0);
	    $this->getServer()->getCommandMap()->register("RenameItems", new rename($this));
	}

public function Config(){
	    $cfg = new Config($this->getDataFolder()."config.yml", 2);
	    return $cfg;
}

public function getMSGS(){
	    $msgs = new Config($this->getDataFolder()."messages.yml", 2);
	    return $msgs;
}

public function ConfigUpdater($version){
	    $cfgpath = $this->getDataFolder()."config.yml";
	    $msgpath = $this->getDataFolder()."messages.yml";
	    if(file_exists($cfgpath)){
	        $cfgversion = $this->Config()->get("version");
	        if($cfgversion !== $version){
	            $this->getLogger()->info("配置文件从 ".$cfgversion." 更新到 ".$version." 原配置文件改名为 config-".$cfgversion.".yml 原消息文件改名为 messages-".$cfgversion.".yml.");
	            rename($cfgpath, $this->getDataFolder()."config-".$cfgversion.".yml");
                rename($msgpath, $this->getDataFolder()."messages-".$cfgversion.".yml");
                $this->saveResource("config.yml");
                $this->saveResource("messages.yml");
	        }
        }else{
            $this->saveResource("config.yml");
            $this->saveResource("messages.yml");
        }
}

}