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

use xpocketmc\command\Command;
use xpocketmc\command\CommandSender;
use xpocketmc\command\utils\InvalidCommandSyntaxException;
use xpocketmc\lang\KnownTranslationFactory;
use xpocketmc\permission\DefaultPermissionNames;
use xpocketmc\player\Player;
use xpocketmc\utils\TextFormat;
use function array_shift;
use function count;

class OpCommand extends VanillaCommand{

	public function __construct(){
		parent::__construct(
			"op",
			KnownTranslationFactory::xpocketmc_command_op_description(),
			KnownTranslationFactory::commands_op_usage()
		);
		$this->setPermission(DefaultPermissionNames::COMMAND_OP_GIVE);
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if(count($args) === 0){
			throw new InvalidCommandSyntaxException();
		}

		$name = array_shift($args);
		if(!Player::isValidUserName($name)){
			throw new InvalidCommandSyntaxException();
		}

		$sender->getServer()->addOp($name);
		if(($player = $sender->getServer()->getPlayerExact($name)) !== null){
			$player->sendMessage(KnownTranslationFactory::commands_op_message()->prefix(TextFormat::GRAY));
		}
		Command::broadcastCommandMessage($sender, KnownTranslationFactory::commands_op_success($name));
		return true;
	}
}