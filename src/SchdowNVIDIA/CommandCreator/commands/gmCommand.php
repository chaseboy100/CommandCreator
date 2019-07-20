<?php
declare(strict_types = 1);

namespace SchdowNVIDIA\CommandCreator\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use SchdowNVIDIA\CommandCreator\CommandCreator;

class gmCommand extends Command {

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
        $this->plugin->getServer()->broadcastMessage($this->format_gm($sender, $args, $this->execute));
    }

    private function format_gm(CommandSender $sender, array $args, string $toFormat) {
        $toFormat = str_replace("{ARGS_0}", $args[0], $toFormat);
        $toFormat = str_replace("{ARGS_1}", $args[0], $toFormat);
        $toFormat = str_replace("{ARGS_2}", $args[0], $toFormat);
        $toFormat = str_replace("{ARGS_3}", $args[0], $toFormat);
        $toFormat = str_replace("{ARGS_4}", $args[0], $toFormat);
        $toFormat = str_replace("{ARGS_5}", $args[0], $toFormat);
        $toFormat = str_replace("{ARGS_ALL}", implode(" ", $args), $toFormat);
        $toFormat = str_replace("{PLAYER_NAME}", $sender->getName(), $toFormat);

        return $toFormat;

    }

}