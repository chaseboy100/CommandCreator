<?php
declare(strict_types = 1);

namespace SchdowNVIDIA\CommandCreator\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\Player;
use SchdowNVIDIA\CommandCreator\CommandCreator;

class cecCommand extends Command
{

    private $plugin;
    private $execute;

    public function __construct(CommandCreator $plugin, string $name, string $description, string $execute, string $usage, string $permission, array $alias)
    {
        $this->execute = $execute;
        parent::__construct($name, $description, $usage, $alias);
        if ($permission != "none") {
            $this->setPermission($permission);
        }
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if(!$sender instanceof Player) {
            $sender->sendMessage("§cERROR: §fcecCommands can be only executed in-game!");
            return;
        }
        $this->plugin->getServer()->dispatchCommand(new ConsoleCommandSender(), $this->format_cec($sender, $args, $this->execute));
    }

    private function format_cec(CommandSender $sender, array $args, string $toFormat) {

        if(isset($args[0])) {
            $toFormat = str_replace("{ARGS_0}", $args[0], $toFormat);
            $toFormat = str_replace("{ARGS_ALL}", implode(" ", $args), $toFormat);
        }
        if(isset($args[1])) {
            $toFormat = str_replace("{ARGS_1}", $args[1], $toFormat);
        }
        if(isset($args[2])) {
            $toFormat = str_replace("{ARGS_2}", $args[2], $toFormat);
        }
        if(isset($args[3])) {
            $toFormat = str_replace("{ARGS_3}", $args[3], $toFormat);
        }
        if(isset($args[4])) {
            $toFormat = str_replace("{ARGS_4}", $args[4], $toFormat);
        }
        if(isset($args[5])) {
            $toFormat = str_replace("{ARGS_5}", $args[5], $toFormat);
        }

        $toFormat = str_replace("{PLAYER_NAME}", $sender->getName(), $toFormat);

        return $toFormat;
    }
}