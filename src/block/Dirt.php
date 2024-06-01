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

use xpocketmc\block\utils\DirtType;
use xpocketmc\data\runtime\RuntimeDataDescriber;
use xpocketmc\item\Fertilizer;
use xpocketmc\item\Hoe;
use xpocketmc\item\Item;
use xpocketmc\item\Potion;
use xpocketmc\item\PotionType;
use xpocketmc\item\SplashPotion;
use xpocketmc\math\Facing;
use xpocketmc\math\Vector3;
use xpocketmc\player\Player;
use xpocketmc\world\sound\ItemUseOnBlockSound;
use xpocketmc\world\sound\WaterSplashSound;

class Dirt extends Opaque{
	protected DirtType $dirtType = DirtType::NORMAL;

	public function describeBlockItemState(RuntimeDataDescriber $w) : void{
		$w->enum($this->dirtType);
	}

	public function getDirtType() : DirtType{ return $this->dirtType; }

	/** @return $this */
	public function setDirtType(DirtType $dirtType) : self{
		$this->dirtType = $dirtType;
		return $this;
	}

	public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null, array &$returnedItems = []) : bool{
		$world = $this->position->getWorld();
		if($face !== Facing::DOWN && $item instanceof Hoe){
			$up = $this->getSide(Facing::UP);
			if($up->getTypeId() !== BlockTypeIds::AIR){
				return true;
			}

			$item->applyDamage(1);

			$newBlock = $this->dirtType === DirtType::NORMAL ? VanillaBlocks::FARMLAND() : VanillaBlocks::DIRT();
			$center = $this->position->add(0.5, 0.5, 0.5);
			$world->addSound($center, new ItemUseOnBlockSound($newBlock));
			$world->setBlock($this->position, $newBlock);
			if($this->dirtType === DirtType::ROOTED){
				$world->dropItem($center, VanillaBlocks::HANGING_ROOTS()->asItem());
			}

			return true;
		}elseif($this->dirtType === DirtType::ROOTED && $item instanceof Fertilizer){
			$down = $this->getSide(Facing::DOWN);
			if($down->getTypeId() !== BlockTypeIds::AIR){
				return true;
			}

			$item->pop();
			$world->setBlock($down->position, VanillaBlocks::HANGING_ROOTS());
			//TODO: bonemeal particles, growth sounds
		}elseif(($item instanceof Potion || $item instanceof SplashPotion) && $item->getType() === PotionType::WATER){
			$item->pop();
			$world->setBlock($this->position, VanillaBlocks::MUD());
			$world->addSound($this->position, new WaterSplashSound(0.5));
			return true;
		}

		return false;
	}
}