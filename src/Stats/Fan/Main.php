<?php

namespace Stats\Fan;

use pocketmine\command\Command;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener{

    public function onEnable(){
        $this->getLogger()->info("Plugin stats was succesfully loaded");
        $this->tk = new Config($this->getDataFolder() . "kill.yml", Config::YAML);
        $this->td = new Config($this->getDataFolder() . "death.yml", Config::YAML);
        $this->tj = new Config($this->getDataFolder() . "tempjeu.yml", Config::YAML);
        $this->fc = new Config($this->getDataFolder() . "firstco.yml", Config::YAML);
        $this->getServer()->getPluginManager()->registerEvents(new Events\PlayerDeath($this), $this);
        $this->getServer()->getPluginManager()->registerEvents(new Events\PlayerJoin($this), $this);
        $this->getServer()->getCommandMap()->register("topdeath", new Commands\topdeath($this));
        $this->getServer()->getCommandMap()->register("topkill", new Commands\topkill($this));
        $this->getServer()->getCommandMap()->register("stats", new Commands\stats($this));
    }

    public function onDisable(){
        $this->tk->save();
        $this->td->save();
        
    }
}