<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author xpocketmc Team
 * @link http://www.xpocketmc.net/
 *
 *
 */

declare(strict_types=1);

namespace xpocketmc\command\defaults;

use xpocketmc\command\CommandSender;
use xpocketmc\command\utils\InvalidCommandSyntaxException;
use xpocketmc\console\ConsoleCommandSender;
use xpocketmc\lang\KnownTranslationFactory;
use xpocketmc\permission\DefaultPermissionNames;
use xpocketmc\player\Player;
use xpocketmc\utils\TextFormat;
use function count;
use function implode;

class SayCommand extends VanillaCommand{

	public function __construct(){
		parent::__construct(
			"say",
			KnownTranslationFactory::xpocketmc_command_say_description(),
			KnownTranslationFactory::commands_say_usage()
		);
		$this->setPermission(DefaultPermissionNames::COMMAND_SAY);
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if(count($args) === 0){
			throw new InvalidCommandSyntaxException();
		}

		$sender->getServer()->broadcastMessage(KnownTranslationFactory::chat_type_announcement(
			$sender instanceof Player ? $sender->getDisplayName() : ($sender instanceof ConsoleCommandSender ? "Server" : $sender->getName()),
			implode(" ", $args)
		)->prefix(TextFormat::LIGHT_PURPLE));
		return true;
	}
}