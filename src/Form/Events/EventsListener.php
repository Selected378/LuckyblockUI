<?php

namespace Form\Events;

use Form\forms\BasicForm;
use Form\Main;
use pocketmine\block\Sponge;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\Listener;

/**
 * Class EventListener
 */
Class EventsListener implements Listener{
    private Main $plugin;
    private array $openedForms = [];

    public function __construct(Main $plugin){
        $this->plugin = $plugin;
    }

    public function onInteract(PlayerInteractEvent $ev): void {
        $player = $ev->getPlayer();
        $block = $ev->getBlock();
        if($ev->getAction() !== PlayerInteractEvent::RIGHT_CLICK_BLOCK) return;
            if ($block instanceof Sponge) {
                BasicForm::open($player, $block);
            }
       }
   }
