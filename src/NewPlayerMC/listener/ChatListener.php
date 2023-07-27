<?php

namespace NewPlayerMC\listener;

use NewPlayerMC\ChatLock;
use NewPlayerMC\commands\ChatLockCommand;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\Server;

class ChatListener implements \pocketmine\event\Listener
{
    public function onChat(PlayerChatEvent $event) {
        $player = $event->getPlayer();
        if (Server::getInstance()->isOp($player->getName()) === false or $player->hasPermission("chatlock.bypass.perm") === false and ChatLockCommand::$chatLock === true) {
            $player->sendMessage(ChatLock::getInstance()->getConfig()->get("chat-is-locked"));
            $event->cancel();
        }
    }

}