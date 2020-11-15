<?php

namespace DeadBush\BroadcastUi;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\event\Listener;

class main extends PluginBase implements Listener{
	
	public function onEnable(){
		
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, String $label, Array $args): bool {
		
		switch($cmd->getName()){
			case "bc":
			 if($sender->hasPermission("bc.use")){
				 if($sender instanceof Player){
					 $this->bc($sender);
				}
			 } else {
				 $sender->sendMessage("§cYou dont have permission to use this command");
			 }
		}
    return true;
	}
	
	public function bc($player){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
			if($data[0] == null){
				$player->sendMessage("§bYou need to type a message!");
				return true;
			}
			if($data[1] == true){
				$this->getServer()->broadcastMessage("§l§7[§4ALERT§7]§r §a$data[0]");
				return true;
			}
			if($data[2] == true){
				$this->getServer()->broadcastMessage("§l§7[§4ALERT§7]§r §c$data[0]");
				return true;
			}
			if($data[3] == true){
				$this->getServer()->broadcastMessage("§l§7[§4ALERT§7]§r §e$data[0]");
				return true;
			}
			$this->getServer()->broadcastMessage("§l§7[§4ALERT§7]§r $data[0]");
		});
		$form->setTitle("§4§kii§r§6§lBroadCast §e§lUI§r§4§kii§r");
		$form->addInput("§a>> §bType a message you want to broadcast");
		$form->addToggle("§aGreen", false);
		$form->addToggle("§cRed", false);
		$form->addToggle("§eYellow", false);
		$form->sendToPlayer($player);
		return $form;
	}
}