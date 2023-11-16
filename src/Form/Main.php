<?php

namespace Form;

use Form\Commands\infoCommand;
use Form\Events\EventsListener;
use pocketmine\event\Listener;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {
    public $points;

    public static $instance;

    public function onEnable(): void {
        self::$instance = $this;
        $this->getLogger()->alert(infoCommand::PREFIX . "Plugin form activée");


        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getPluginManager()->registerEvents(new EventsListener($this), $this);
    }

    public static function getInstance() {
        return self::$instance;
    }

    public static function getConfigName(string $fileName) {
        return new Config(Main::getInstance()->getDataFolder() . $fileName . "yml" . Config::YAML);
    }
}