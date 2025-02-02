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

use xpocketmc\block\utils\LeverFacing;
use xpocketmc\data\runtime\RuntimeDataDescriber;
use xpocketmc\item\Item;
use xpocketmc\math\Axis;
use xpocketmc\math\Facing;
use xpocketmc\math\Vector3;
use xpocketmc\player\Player;
use xpocketmc\utils\AssumptionFailedError;
use xpocketmc\world\BlockTransaction;
use xpocketmc\world\sound\RedstonePowerOffSound;
use xpocketmc\world\sound\RedstonePowerOnSound;

class Lever extends Flowable{
	protected LeverFacing $facing = LeverFacing::UP_AXIS_X;
	protected bool $activated = false;

	protected function describeBlockOnlyState(RuntimeDataDescriber $w) : void{
		$w->enum($this->facing);
		$w->bool($this->activated);
	}

	public function getFacing() : LeverFacing{ return $this->facing; }

	/** @return $this */
	public function setFacing(LeverFacing $facing) : self{
		$this->facing = $facing;
		return $this;
	}

	public function isActivated() : bool{ return $this->activated; }

	/** @return $this */
	public function setActivated(bool $activated) : self{
		$this->activated = $activated;
		return $this;
	}

	public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
		if(!$this->canBeSupportedAt($blockReplace, Facing::opposite($face))){
			return false;
		}

		$selectUpDownPos = function(LeverFacing $x, LeverFacing $z) use ($player) : LeverFacing{
			if($player !== null){
				return Facing::axis($player->getHorizontalFacing()) === Axis::X ? $x : $z;
			}
			return $x;
		};
		$this->facing = match($face){
			Facing::DOWN => $selectUpDownPos(LeverFacing::DOWN_AXIS_X, LeverFacing::DOWN_AXIS_Z),
			Facing::UP => $selectUpDownPos(LeverFacing::UP_AXIS_X, LeverFacing::UP_AXIS_Z),
			Facing::NORTH => LeverFacing::NORTH,
			Facing::SOUTH => LeverFacing::SOUTH,
			Facing::WEST => LeverFacing::WEST,
			Facing::EAST => LeverFacing::EAST,
			default => throw new AssumptionFailedError("Bad facing value"),
		};

		return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
	}

	public function onNearbyBlockChange() : void{
		if(!$this->canBeSupportedAt($this, Facing::opposite($this->facing->getFacing()))){
			$this->position->getWorld()->useBreakOn($this->position);
		}
	}

	public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null, array &$returnedItems = []) : bool{
		$this->activated = !$this->activated;
		$world = $this->position->getWorld();
		$world->setBlock($this->position, $this);
		$world->addSound(
			$this->position->add(0.5, 0.5, 0.5),
			$this->activated ? new RedstonePowerOnSound() : new RedstonePowerOffSound()
		);
		return true;
	}

	private function canBeSupportedAt(Block $block, int $face) : bool{
		return $block->getAdjacentSupportType($face)->hasCenterSupport();
	}

	//TODO
}