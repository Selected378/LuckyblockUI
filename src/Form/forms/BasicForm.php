<?php

namespace Form\forms;

use Form\Commands\infoCommand;
use Form\Main;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\block\Block;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;

class BasicForm extends SimpleForm
{
    public static function open(Player $player, Block $block): void
    {
        $form = new SimpleForm(function (Player $player, $data) use ($block) {
            if ($data === null) {
                $player->sendMessage(infoCommand::PREFIX . "Vous n'avez choisi aucune action");
                return;
            }

            switch ($data) {
                case 0:
                    $player->sendMessage(infoCommand::PREFIX . "Vous venez d'ouvrir un LuckyBlock");
                    BasicForm::executeLuckyBlockCode($player);
                    $block->getPosition()->getWorld()->setBlock($block->getPosition()->asVector3(), VanillaBlocks::AIR());
                    break;
                case 1:
                    $player->sendMessage(infoCommand::PREFIX . "Vous venez d'ouvrir le menu des loots");
                    BasicForm::simpleForm($player);
                    break;
                default:
                    break;
            }
        });

        $form->setTitle("Lucky ui");
        $form->setContent("Page d'information du Lucky block");
        $form->addButton('Ouvrir le lucky');
        $form->addButton('Menu des loots');
        $form->sendToPlayer($player);
    }

    private static function simpleForm(Player $player)
    {
        $form = new SimpleForm(function (Player $player, $data) {
            // Handle form response if needed
        });

        $form->setTitle("Menu des loots");
        $form->setContent("Salut\nSalut");

        $form->sendToPlayer($player);
    }

    public static function executeLuckyBlockCode(Player $player)
    {
        $randomNumber = mt_rand(1, 10);
        $message = "";

        $server = Main::getInstance()->getServer();

        if ($server !== null) {
            switch ($randomNumber) {
                case 1:
                    $item = VanillaItems::DIAMOND_SWORD();
                    $player->getInventory()->addItem($item);
                    $message = infoCommand::PREFIX . "Vous venez de gagné une épée en diamand";
                    break;
                case 2:
                    $item = VanillaItems::IRON_SWORD();
                    $player->getInventory()->addItem($item);
                    $message = infoCommand::PREFIX . "Vous avez gagné une épée en fer";
                    break;
                case 3:
                    $item = VanillaItems::GOLD_INGOT();
                    $player->getInventory()->addItem($item);
                    $message = infoCommand::PREFIX . "Vous venez de gagnée un lingot d'or";
                default:
                    $message = infoCommand::PREFIX . "Rien ne s'est passé de spécial";
                    break;
            }
        } else {
            $message = infoCommand::PREFIX . "Erreur: Serveur non disponible.";
        }

        $player->sendMessage($message);
    }
}
