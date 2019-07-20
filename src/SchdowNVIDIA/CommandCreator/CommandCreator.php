<?php
declare(strict_types = 1);

namespace SchdowNVIDIA\CommandCreator;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use SchdowNVIDIA\CommandCreator\commands\mtsCommand;

class CommandCreator extends PluginBase {

    public function onEnable()
    {
        $this->saveDefaultConfig();
        $this->saveResource("commands.yml");
        $this->init();
    }

    private function init() {
        $commandsConfig = new Config($this->getDataFolder()."commands.yml", Config::YAML);
        foreach ($commandsConfig->getNested("commands") as $command => $attribute) {

            $name = (string) $command;
            $alias = (array) $attribute["alias"];
            $description = (string) $attribute["description"];
            $type = (string) $attribute["type"];
            $permission = (string) $attribute["permission"];
            $usage = (string) $attribute["usage"];
            $execute = (string) $attribute["execute"];

            if($type === "mts") {
                $this->getServer()->getCommandMap()->register($name, new mtsCommand($this, $name, $description, $execute, $usage, $permission, $alias));
            }

        }
    }

}
