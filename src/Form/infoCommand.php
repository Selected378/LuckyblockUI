<?php

namespace Form;

use Form\forms\BasicForm;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use test\Main;

class infoCommand extends Command {
    const PREFIX = "§0Serveur §f>> ";
    public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
        $this->setPermission("form.cmd");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if ($sender instanceof Player) {
            BasicForm::open($sender);
        } else {
            $sender->sendMessage(infoCommand::PREFIX . "Vous devez etre un joueur pour éxécuter cette commande");
        }
    }
}
