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

namespace xpocketmc\item;

use xpocketmc\data\runtime\RuntimeDataDescriber;

class SuspiciousStew extends Food{

	private SuspiciousStewType $suspiciousStewType = SuspiciousStewType::POPPY;

	protected function describeState(RuntimeDataDescriber $w) : void{
		$w->enum($this->suspiciousStewType);
	}

	public function getType() : SuspiciousStewType{ return $this->suspiciousStewType; }

	/**
	 * @return $this
	 */
	public function setType(SuspiciousStewType $type) : self{
		$this->suspiciousStewType = $type;
		return $this;
	}

	public function getMaxStackSize() : int{
		return 1;
	}

	public function requiresHunger() : bool{
		return false;
	}

	public function getFoodRestore() : int{
		return 6;
	}

	public function getSaturationRestore() : float{
		return 7.2;
	}

	public function getAdditionalEffects() : array{
		return $this->suspiciousStewType->getEffects();
	}

	public function getResidue() : Item{
		return VanillaItems::BOWL();
	}
}