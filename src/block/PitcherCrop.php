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

use xpocketmc\block\utils\AgeableTrait;
use xpocketmc\block\utils\BlockEventHelper;
use xpocketmc\block\utils\CropGrowthHelper;
use xpocketmc\block\utils\StaticSupportTrait;
use xpocketmc\event\block\StructureGrowEvent;
use xpocketmc\item\Fertilizer;
use xpocketmc\item\Item;
use xpocketmc\item\VanillaItems;
use xpocketmc\math\Axis;
use xpocketmc\math\AxisAlignedBB;
use xpocketmc\math\Facing;
use xpocketmc\math\Vector3;
use xpocketmc\player\Player;
use xpocketmc\world\BlockTransaction;

final class PitcherCrop extends Flowable{
	use AgeableTrait;
	use StaticSupportTrait;

	public const MAX_AGE = 2;

	private function canBeSupportedAt(Block $block) : bool{
		return $block->getSide(Facing::DOWN)->getTypeId() === BlockTypeIds::FARMLAND;
	}

	protected function recalculateCollisionBoxes() : array{
		$widthTrim = $this->age === 0 ? 5 : 3;
		$heightTrim = $this->age === 0 ? 13 : 11;
		return [
			AxisAlignedBB::one()
				->trim(Facing::UP, $heightTrim / 16)
				->squash(Axis::X, $widthTrim / 16)
				->squash(Axis::Z, $widthTrim / 16)
				->extend(Facing::DOWN, 1 / 16) //presumably this is to correct for farmland being 15/16 of a block tall
		];
	}

	private function grow(?Player $player) : bool{
		if($this->age > self::MAX_AGE){
			return false;
		}

		if($this->age === self::MAX_AGE){
			$up = $this->getSide(Facing::UP);
			if($up->getTypeId() !== BlockTypeIds::AIR){
				return false;
			}

			$tx = new BlockTransaction($this->position->getWorld());
			$tx->addBlock($this->position, VanillaBlocks::DOUBLE_PITCHER_CROP()->setTop(false));
			$tx->addBlock($this->position->up(), VanillaBlocks::DOUBLE_PITCHER_CROP()->setTop(true));

			$ev = new StructureGrowEvent($this, $tx, $player);
			$ev->call();

			return !$ev->isCancelled() && $tx->apply();
		}

		return BlockEventHelper::grow($this, (clone $this)->setAge($this->age + 1), $player);
	}

	public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null, array &$returnedItems = []) : bool{
		if($item instanceof Fertilizer && $this->grow($player)){
			$item->pop();
			return true;
		}

		return false;
	}

	public function ticksRandomly() : bool{
		return true;
	}

	public function onRandomTick() : void{
		if(CropGrowthHelper::canGrow($this)){
			$this->grow(null);
		}
	}

	public function asItem() : Item{
		return VanillaItems::PITCHER_POD();
	}
}