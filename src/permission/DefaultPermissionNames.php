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

namespace xpocketmc\permission;

final class DefaultPermissionNames{
	public const BROADCAST_ADMIN = "xpocketmc.broadcast.admin";
	public const BROADCAST_USER = "xpocketmc.broadcast.user";
	public const COMMAND_BAN_IP = "xpocketmc.command.ban.ip";
	public const COMMAND_BAN_LIST = "xpocketmc.command.ban.list";
	public const COMMAND_BAN_PLAYER = "xpocketmc.command.ban.player";
	public const COMMAND_CLEAR_OTHER = "xpocketmc.command.clear.other";
	public const COMMAND_CLEAR_SELF = "xpocketmc.command.clear.self";
	public const COMMAND_DEFAULTGAMEMODE = "xpocketmc.command.defaultgamemode";
	public const COMMAND_DIFFICULTY = "xpocketmc.command.difficulty";
	public const COMMAND_DUMPMEMORY = "xpocketmc.command.dumpmemory";
	public const COMMAND_EFFECT_OTHER = "xpocketmc.command.effect.other";
	public const COMMAND_EFFECT_SELF = "xpocketmc.command.effect.self";
	public const COMMAND_ENCHANT_OTHER = "xpocketmc.command.enchant.other";
	public const COMMAND_ENCHANT_SELF = "xpocketmc.command.enchant.self";
	public const COMMAND_GAMEMODE_OTHER = "xpocketmc.command.gamemode.other";
	public const COMMAND_GAMEMODE_SELF = "xpocketmc.command.gamemode.self";
	public const COMMAND_GC = "xpocketmc.command.gc";
	public const COMMAND_GIVE_OTHER = "xpocketmc.command.give.other";
	public const COMMAND_GIVE_SELF = "xpocketmc.command.give.self";
	public const COMMAND_HELP = "xpocketmc.command.help";
	public const COMMAND_KICK = "xpocketmc.command.kick";
	public const COMMAND_KILL_OTHER = "xpocketmc.command.kill.other";
	public const COMMAND_KILL_SELF = "xpocketmc.command.kill.self";
	public const COMMAND_LIST = "xpocketmc.command.list";
	public const COMMAND_ME = "xpocketmc.command.me";
	public const COMMAND_OP_GIVE = "xpocketmc.command.op.give";
	public const COMMAND_OP_TAKE = "xpocketmc.command.op.take";
	public const COMMAND_PARTICLE = "xpocketmc.command.particle";
	public const COMMAND_PLUGINS = "xpocketmc.command.plugins";
	public const COMMAND_SAVE_DISABLE = "xpocketmc.command.save.disable";
	public const COMMAND_SAVE_ENABLE = "xpocketmc.command.save.enable";
	public const COMMAND_SAVE_PERFORM = "xpocketmc.command.save.perform";
	public const COMMAND_SAY = "xpocketmc.command.say";
	public const COMMAND_SEED = "xpocketmc.command.seed";
	public const COMMAND_SETWORLDSPAWN = "xpocketmc.command.setworldspawn";
	public const COMMAND_SPAWNPOINT_OTHER = "xpocketmc.command.spawnpoint.other";
	public const COMMAND_SPAWNPOINT_SELF = "xpocketmc.command.spawnpoint.self";
	public const COMMAND_STATUS = "xpocketmc.command.status";
	public const COMMAND_STOP = "xpocketmc.command.stop";
	public const COMMAND_TELEPORT_OTHER = "xpocketmc.command.teleport.other";
	public const COMMAND_TELEPORT_SELF = "xpocketmc.command.teleport.self";
	public const COMMAND_TELL = "xpocketmc.command.tell";
	public const COMMAND_TIME_ADD = "xpocketmc.command.time.add";
	public const COMMAND_TIME_QUERY = "xpocketmc.command.time.query";
	public const COMMAND_TIME_SET = "xpocketmc.command.time.set";
	public const COMMAND_TIME_START = "xpocketmc.command.time.start";
	public const COMMAND_TIME_STOP = "xpocketmc.command.time.stop";
	public const COMMAND_TIMINGS = "xpocketmc.command.timings";
	public const COMMAND_TITLE_OTHER = "xpocketmc.command.title.other";
	public const COMMAND_TITLE_SELF = "xpocketmc.command.title.self";
	public const COMMAND_TRANSFERSERVER = "xpocketmc.command.transferserver";
	public const COMMAND_UNBAN_IP = "xpocketmc.command.unban.ip";
	public const COMMAND_UNBAN_PLAYER = "xpocketmc.command.unban.player";
	public const COMMAND_VERSION = "xpocketmc.command.version";
	public const COMMAND_WHITELIST_ADD = "xpocketmc.command.whitelist.add";
	public const COMMAND_WHITELIST_DISABLE = "xpocketmc.command.whitelist.disable";
	public const COMMAND_WHITELIST_ENABLE = "xpocketmc.command.whitelist.enable";
	public const COMMAND_WHITELIST_LIST = "xpocketmc.command.whitelist.list";
	public const COMMAND_WHITELIST_RELOAD = "xpocketmc.command.whitelist.reload";
	public const COMMAND_WHITELIST_REMOVE = "xpocketmc.command.whitelist.remove";
	public const GROUP_CONSOLE = "xpocketmc.group.console";
	public const GROUP_OPERATOR = "xpocketmc.group.operator";
	public const GROUP_USER = "xpocketmc.group.user";
}