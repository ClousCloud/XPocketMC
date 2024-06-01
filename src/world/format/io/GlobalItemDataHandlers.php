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

use xpocketmc\data\bedrock\item\ItemDeserializer;
use xpocketmc\data\bedrock\item\ItemSerializer;
use xpocketmc\data\bedrock\item\upgrade\ItemDataUpgrader;
use xpocketmc\data\bedrock\item\upgrade\ItemIdMetaUpgrader;
use xpocketmc\data\bedrock\item\upgrade\ItemIdMetaUpgradeSchemaUtils;
use xpocketmc\data\bedrock\item\upgrade\LegacyItemIdToStringIdMap;
use xpocketmc\data\bedrock\item\upgrade\R12ItemIdToBlockIdMap;
use Symfony\Component\Filesystem\Path;
use const PHP_INT_MAX;
use const xpocketmc\BEDROCK_ITEM_UPGRADE_SCHEMA_PATH;

final class GlobalItemDataHandlers{
	private static ?ItemSerializer $itemSerializer = null;

	private static ?ItemDeserializer $itemDeserializer = null;

	private static ?ItemDataUpgrader $itemDataUpgrader = null;

	public static function getSerializer() : ItemSerializer{
		return self::$itemSerializer ??= new ItemSerializer(GlobalBlockStateHandlers::getSerializer());
	}

	public static function getDeserializer() : ItemDeserializer{
		return self::$itemDeserializer ??= new ItemDeserializer(GlobalBlockStateHandlers::getDeserializer());
	}

	public static function getUpgrader() : ItemDataUpgrader{
		return self::$itemDataUpgrader ??= new ItemDataUpgrader(
			new ItemIdMetaUpgrader(ItemIdMetaUpgradeSchemaUtils::loadSchemas(Path::join(BEDROCK_ITEM_UPGRADE_SCHEMA_PATH, 'id_meta_upgrade_schema'), PHP_INT_MAX)),
			LegacyItemIdToStringIdMap::getInstance(),
			R12ItemIdToBlockIdMap::getInstance(),
			GlobalBlockStateHandlers::getUpgrader()
		);
	}
}