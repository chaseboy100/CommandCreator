<?php
declare(strict_types = 1);

namespace SchdowNVIDIA\CommandCreator\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use SchdowNVIDIA\CommandCreator\CommandCreator;

class mtsCommand extends Command {

    private $plugin;
    private $execute;

    public function __construct(CommandCreator $plugin, string $name, string $description, string $execute, string $usage, string $permission, array $alias)
    {
        $this->execute = $execute;
        parent::__construct($name, $description, $usage, $alias);
        if($permission != "none") {
            $this->setPermission($permission);
        }
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        $sender->sendMessage($this->format_mts($sender, $this->execute));
    }

    private function format_mts(CommandSender $sender, string $toFormat) {
        $toReplace = str_replace("{PLAYER_NAME}", $sender->getName(), $toFormat);
        return $toReplace;
    }

}
