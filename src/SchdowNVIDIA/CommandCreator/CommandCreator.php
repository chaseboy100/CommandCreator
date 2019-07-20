<?php

/*
    CommandCreator:

    Copyright (C) 2019 SchdowNVIDIA
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

declare(strict_types = 1);

namespace SchdowNVIDIA\CommandCreator;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use SchdowNVIDIA\CommandCreator\commands\cecCommand;
use SchdowNVIDIA\CommandCreator\commands\gmCommand;
use SchdowNVIDIA\CommandCreator\commands\mtsCommand;
use SchdowNVIDIA\CommandCreator\commands\pecCommand;

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
            } else if($type === "gm") {
                $this->getServer()->getCommandMap()->register($name, new gmCommand($this, $name, $description, $execute, $usage, $permission, $alias));
            } else if($type === "cec") {
                $this->getServer()->getCommandMap()->register($name, new cecCommand($this, $name, $description, $execute, $usage, $permission, $alias));
            } else if($type === "pec") {
                $this->getServer()->getCommandMap()->register($name, new pecCommand($this, $name, $description, $execute, $usage, $permission, $alias));
            }

        }
    }

}
