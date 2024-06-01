<?php

declare(strict_types=1);

namespace xpocketmc;

use function define;
use function defined;
use function dirname;

// composer autoload doesn't use require_once and also pthreads can inherit things
if(defined('xpocketmc\_CORE_CONSTANTS_INCLUDED')){
	return;
}
define('xpocketmc\_CORE_CONSTANTS_INCLUDED', true);

define('xpocketmc\PATH', dirname(__DIR__) . '/');
define('xpocketmc\RESOURCE_PATH', dirname(__DIR__) . '/resources/');
define('xpocketmc\BEDROCK_DATA_PATH', dirname(__DIR__) . '/vendor/xpocketmc/bedrock-data/');
define('xpocketmc\LOCALE_DATA_PATH', dirname(__DIR__) . '/vendor/xpocketmc/locale-data/');
define('xpocketmc\BEDROCK_BLOCK_UPGRADE_SCHEMA_PATH', dirname(__DIR__) . '/vendor/xpocketmc/bedrock-block-upgrade-schema/');
define('xpocketmc\BEDROCK_ITEM_UPGRADE_SCHEMA_PATH', dirname(__DIR__) . '/vendor/xpocketmc/bedrock-item-upgrade-schema/');
define('xpocketmc\COMPOSER_AUTOLOADER_PATH', dirname(__DIR__) . '/vendor/autoload.php');