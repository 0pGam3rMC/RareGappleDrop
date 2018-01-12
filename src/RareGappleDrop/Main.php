<?php

namespace RareGappleDrop;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\Item;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as TF;

class Main extends PluginBase implements Listener
{

  public function onEnable()
  {
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->getLogger()->info(TF::DARK_PURPLE . "GappleDrop v1.2.7 has been Enabled by OPGamer");
  }

  public function onDeath(PlayerDeathEvent $event)
  {
    $entity = $event->getEntity();
    $cause = $entity->getLastDamageCause();
    if($cause instanceof EntityDamageByEntityEvent) {
      $killer = $cause->getDamager();
      if($killer instanceof Player) {
        $rand = mt_rand(1, 4);
        if($rand === 1) {
          $killer->getInventory()->addItem(Item::get(Item::GOLDEN_APPLE));
          $killer->getInventory()->addItem(Item::get(Item::ENCHANTED_GOLDEN_APPLE));
          $killer->sendMessage(TF::GREEN . "[SKYREALMPE]".TF::RED. " You have recieved several items for killing" . $entity->getDisplayName() . " ! ");
        }
      }
    }
  }

}
