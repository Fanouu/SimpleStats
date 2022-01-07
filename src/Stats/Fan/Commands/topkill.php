<?php

namespace Stats\Fan\Commands;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\Player;

use Stats\Fan\Main;

class topkill extends PluginCommand{

    private $plugin;

    public function __construct(Main $plugin){
        parent::__construct("topkill", $plugin);
        $this->setAliases(["tk"]);
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $player, string $commandLabel, array $args){

        $config = $this->plugin->tk;
        $config = $config->getAll();
        arsort($config);
        $top = 1;
        $player->sendMessage("§c- §6TopKill du server §c-");

        foreach ($config as $name => $value){
            if($top == 11)break;
            $player->sendMessage("§6#{$top} §f§c> §6{$name} §cavec §6{$value}§c kills");
            $top ++;
        }
        return true;
    }

}