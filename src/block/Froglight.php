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

use xpocketmc\block\utils\FroglightType;
use xpocketmc\data\runtime\RuntimeDataDescriber;

final class Froglight extends SimplePillar{

	private FroglightType $froglightType = FroglightType::OCHRE;

	public function describeBlockItemState(RuntimeDataDescriber $w) : void{
		$w->enum($this->froglightType);
	}

	public function getFroglightType() : FroglightType{ return $this->froglightType; }

	/** @return $this */
	public function setFroglightType(FroglightType $froglightType) : self{
		$this->froglightType = $froglightType;
		return $this;
	}

	public function getLightLevel() : int{
		return 15;
	}
}