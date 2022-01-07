<?php

namespace Stats\Fan\Events;

use pocketmine\event\Listener;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\event\player\PlayerJoinEvent;

use Stats\Fan\Main;

class PlayerJoin implements Listener{

    public function __construct(Main $plugin){
        $this->plugin = $plugin;
    }

    public function onJoin(PlayerJoinEvent $event){
        $pname = $event->getPlayer()->getName();
        $this->plugin->tj->set($pname, 0);
        $this->plugin->tj->save();

        $this->plugin->tj->set($pname, time());
        $this->plugin->tj->save();

        if(!$event->getPlayer()->hasPlayedBefore()){
            $this->plugin->fc->set($pname, date());
            $this->plugin->fc->save();
        }
    }
}