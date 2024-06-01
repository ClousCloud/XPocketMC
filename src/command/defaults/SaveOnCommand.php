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
use xpocketmc\lang\KnownTranslationFactory;
use xpocketmc\permission\DefaultPermissionNames;

class SaveOnCommand extends VanillaCommand{

	public function __construct(){
		parent::__construct(
			"save-on",
			KnownTranslationFactory::xpocketmc_command_saveon_description()
		);
		$this->setPermission(DefaultPermissionNames::COMMAND_SAVE_ENABLE);
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		$sender->getServer()->getWorldManager()->setAutoSave(true);

		Command::broadcastCommandMessage($sender, KnownTranslationFactory::commands_save_enabled());

		return true;
	}
}