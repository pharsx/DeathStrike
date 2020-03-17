<?php

declare(strict_types=1);

namespace pharsx\deathstrike;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pharsx\deathstrike\Strike;

class Main extends PluginBase implements Listener{
	
	public function onEnable():void{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	public function onDeath(PlayerDeathEvent $event){
		$player=$event->getPlayer();
		if($player->isOnline()){
			Strike::send($player);
		}
	}
}
