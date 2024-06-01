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

namespace xpocketmc\block;

use xpocketmc\block\utils\PillarRotationTrait;
use xpocketmc\block\utils\WoodTypeTrait;
use xpocketmc\data\runtime\RuntimeDataDescriber;
use xpocketmc\item\Axe;
use xpocketmc\item\Item;
use xpocketmc\math\Vector3;
use xpocketmc\player\Player;
use xpocketmc\world\sound\ItemUseOnBlockSound;

class Wood extends Opaque{
	use PillarRotationTrait;
	use WoodTypeTrait;

	private bool $stripped = false;

	public function describeBlockItemState(RuntimeDataDescriber $w) : void{
		$w->bool($this->stripped);
	}

	public function isStripped() : bool{ return $this->stripped; }

	/** @return $this */
	public function setStripped(bool $stripped) : self{
		$this->stripped = $stripped;
		return $this;
	}

	public function getFuelTime() : int{
		return $this->woodType->isFlammable() ? 300 : 0;
	}

	public function getFlameEncouragement() : int{
		return $this->woodType->isFlammable() ? 5 : 0;
	}

	public function getFlammability() : int{
		return $this->woodType->isFlammable() ? 5 : 0;
	}

	public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null, array &$returnedItems = []) : bool{
		if(!$this->stripped && $item instanceof Axe){
			$item->applyDamage(1);
			$this->stripped = true;
			$this->position->getWorld()->setBlock($this->position, $this);
			$this->position->getWorld()->addSound($this->position, new ItemUseOnBlockSound($this));
			return true;
		}
		return false;
	}
}