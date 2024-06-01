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

use xpocketmc\block\inventory\EnderChestInventory;
use xpocketmc\block\tile\EnderChest as TileEnderChest;
use xpocketmc\block\utils\FacesOppositePlacingPlayerTrait;
use xpocketmc\block\utils\SupportType;
use xpocketmc\item\Item;
use xpocketmc\math\AxisAlignedBB;
use xpocketmc\math\Facing;
use xpocketmc\math\Vector3;
use xpocketmc\player\Player;

class EnderChest extends Transparent{
	use FacesOppositePlacingPlayerTrait;

	public function getLightLevel() : int{
		return 7;
	}

	/**
	 * @return AxisAlignedBB[]
	 */
	protected function recalculateCollisionBoxes() : array{
		//these are slightly bigger than in PC
		return [AxisAlignedBB::one()->contract(0.025, 0, 0.025)->trim(Facing::UP, 0.05)];
	}

	public function getSupportType(int $facing) : SupportType{
		return SupportType::NONE;
	}

	public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null, array &$returnedItems = []) : bool{
		if($player instanceof Player){
			$enderChest = $this->position->getWorld()->getTile($this->position);
			if($enderChest instanceof TileEnderChest && $this->getSide(Facing::UP)->isTransparent()){
				$enderChest->setViewerCount($enderChest->getViewerCount() + 1);
				$player->setCurrentWindow(new EnderChestInventory($this->position, $player->getEnderInventory()));
			}
		}

		return true;
	}

	public function getDropsForCompatibleTool(Item $item) : array{
		return [
			VanillaBlocks::OBSIDIAN()->asItem()->setCount(8)
		];
	}

	public function isAffectedBySilkTouch() : bool{
		return true;
	}
}