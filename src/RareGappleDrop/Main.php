<?php

namespace RareGapplDrop;

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
    $this->getLogger()->info(TF::GREEN . "RareGappleDrop v0.1 has been Enabled!");
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
          $killer->sendMessage(TF::GREEN . "[RareGappleDrop] You have received a rare golden apple for killing " . $entity->getDisplayName() . " ! ");
        }
      }
    }
  }

}
