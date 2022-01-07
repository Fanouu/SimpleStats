<?php

namespace Stats\Fan\Events;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\Player;

use Stats\Fan\Main;

class PlayerDeath implements Listener{

    private $plugin;

    public function __construct(Main $plugin){
        $this->plugin = $plugin;
    }

    public function deathNetwork(PlayerDeathEvent $event){

    $player = $event->getPlayer();
    $name = $player->getName();
    $this->plugin->td->set($name, $this->plugin->td->get($name)+1);

    $cause = $player->getLastDamageCause()->getCause();
    if($cause == EntityDamageByEntityEvent::CAUSE_ENTITY_ATTACK){
    $attack = $player->getLastDamageCause()->getDamager();

    if($attack instanceof Player) {

    $name1 = $attack->getName();
    $this->plugin->tk->set($name1, $this->plugin->tk->get($name1)+1);
            }
        }
    }
}