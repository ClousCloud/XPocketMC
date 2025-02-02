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

namespace xpocketmc\crash;

final class CrashDumpDataGeneral{

	/**
	 * @param string[] $composer_libraries
	 * @phpstan-param array<string, string> $composer_libraries
	 */
	public function __construct(
		public string $name,
		public string $base_version,
		public int $build,
		public bool $is_dev,
		public int $protocol,
		public string $git,
		public string $uname,
		public string $php,
		public string $zend,
		public string $php_os,
		public string $os,
		public array $composer_libraries,
	){}
}