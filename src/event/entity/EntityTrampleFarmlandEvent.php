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

namespace xpocketmc\event\entity;

use xpocketmc\block\Block;
use xpocketmc\entity\Living;
use xpocketmc\event\Cancellable;
use xpocketmc\event\CancellableTrait;

/**
 * @phpstan-extends EntityEvent<Living>
 */
class EntityTrampleFarmlandEvent extends EntityEvent implements Cancellable{
	use CancellableTrait;

	public function __construct(
		Living $entity,
		private Block $block
	){
		$this->entity = $entity;
	}

	public function getBlock() : Block{
		return $this->block;
	}
}