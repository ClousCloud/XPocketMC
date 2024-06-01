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

namespace xpocketmc\world\format\io;

use xpocketmc\nbt\tag\CompoundTag;
use xpocketmc\world\format\SubChunk;

final class ChunkData{

	/**
	 * @param SubChunk[]    $subChunks
	 * @param CompoundTag[] $entityNBT
	 * @param CompoundTag[] $tileNBT
	 */
	public function __construct(
		private array $subChunks,
		private bool $populated,
		private array $entityNBT,
		private array $tileNBT
	){}

	/**
	 * @return SubChunk[]
	 */
	public function getSubChunks() : array{ return $this->subChunks; }

	public function isPopulated() : bool{ return $this->populated; }

	/** @return CompoundTag[] */
	public function getEntityNBT() : array{ return $this->entityNBT; }

	/** @return CompoundTag[] */
	public function getTileNBT() : array{ return $this->tileNBT; }
}