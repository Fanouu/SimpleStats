<?php

namespace Stats\Fan\Commands;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\Player;

use Stats\Fan\Main;

class stats extends PluginCommand{

    private $plugin;

    public function __construct(Main $plugin){
        parent::__construct("stats", $plugin);
        $this->setAliases(["st"]);
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){

        $this->pureperms = $sender->getServer()->getPluginManager()->getPlugin("PurePerms");
        $this->economy = $sender->getServer()->getPluginManager()->getPlugin("EconomyAPI");

        if($this->plugin->tk->get($sender->getName()) == null){
            $this->plugin->tk->set($sender->getName(), 0);
            $this->plugin->tk->save();
        }

        if($this->plugin->td->get($sender->getName()) == null){
            $this->plugin->td->set($sender->getName(), 0);
            $this->plugin->td->save();
        }

        if($this->plugin->fc->get($sender->getName()) == null){
            $this->plugin->fc->set($sender->getName(), "Non trouvé....");
            $this->plugin->fc->save();
        }

        $player = $sender;
        $player->sendMessage("§c- §6Vos stats §c-");
        $player->sendMessage("§cName§l> §r§6" . $sender->getName());
        $player->sendMessage("§cGrade§l> §r§6" . $this->pureperms->getUserDataMgr()->getData($player)['group']);
        $player->sendMessage("§cArgent§l> §r§6" . $this->economy->myMoney($sender));
        $player->sendMessage("§ckill/death§l> §r§6" . $this->plugin->tk->get($player->getName()) . "§c/§6" $this->plugin->td->get($player->getName()));
        $player->sendMessage("§cRatio kill/death§l> §r§6" . $this->plugin->tk->get($player->getName()) / $this->plugin->td->get($player->getName()));
        $player->sendMessage("§cPremière connection§l> §r§6" . $this->plugin->fc->get($player->getName()));

        return true;
    }

    public function tempjeu($player){
        $time = $this->plugin->tj->get($player->getName());

        $t = $time - time();
        $day = intval(abs($t / 86400));
        $t = $t - ($day * 86400);
        $hours = intval(abs($t / 3600));
        $t = $t - ($hours * 3600);
        $minuts = intval(abs($t / 60));
        $seconds = intval(abs($t - $minuts * 60));

        return $player->sendMessage("§cTemp de jeu§l> §r§6" . $hours ."h/" . $minuts . "m/" . $seconds . "s");
    }

}