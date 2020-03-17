<?php

namespace pharsx\deathstrike;

use pocketmine\Player;
use pocketmine\entity\Entity;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;
use pocketmine\network\mcpe\protocol\AddActorPacket;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pharsx\deathstrike\Strike;

class Strike{
	
	public static function send(Player $player){
		$bolt=$player->getLevel();
		$bolt=new AddActorPacket();
		$bolt->type=93;
		$bolt->entityRuntimeId=Entity::$entityCount++;
		$bolt->metadata=array();
		$bolt->motion=null;
		$bolt->yaw=$player->getYaw();
		$bolt->pitch=$player->getPitch();
		$bolt->position=new Vector3($player->getX(), $player->getY(), $player->getZ());
		
		$impact=new PlaySoundPacket();
		$impact->soundName="ambient.weather.lightning.impact";
		$impact->x=$player->getX();
		$impact->y=$player->getY();
		$impact->z=$player->getZ();
		$impact->volume=0.7;
		$impact->pitch=1;
		
		$thunder=new PlaySoundPacket();
		$thunder->soundName="ambient.weather.thunder";
		$thunder->x=$player->getX();
		$thunder->y=$player->getY();
		$thunder->z=$player->getZ();
		$thunder->volume=1;
		$thunder->pitch=1;
		
		foreach($player->getLevel()->getPlayers() as $players){
			$players->dataPacket($bolt);
			$players->dataPacket($impact);
			$players->dataPacket($thunder);
		}
	}
}
