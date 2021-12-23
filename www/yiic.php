<?php


// add auto load 
require_once Q_ROOT . '/source/api/plugin/PluginCacheLocalFile.php';
require_once Q_ROOT . '/source/api/plugin/PluginLoader.php';
spl_autoload_register(['PluginLoader', 'loadByConfig'], false);

// install the hooks
HookManager::installWeb();

$cmds = require_once(dirname(__FILE__).'/config/cron.php');

$cmds = HookManager::doFilter(HookConstants::FILTER_CRON_CONFIG, $cmds);

if (isset($cmds[$_SERVER["argv"][1]])) {
	@putenv('YII_CONSOLE_COMMANDS='. dirname(__FILE__) . DIRECTORY_SEPARATOR  . $cmds[$_SERVER["argv"][1]]);
}
foreach ($_SERVER["argv"] as $key => $value) {
	if (strpos($value, 'singleton') === 0) {
		@putenv($value);
		unset($_SERVER["argv"][$key]);
		break;
	}
}

$time_start = microtime_float();
require_once($yiic);
$time_end = microtime_float();
$time = $time_end - $time_start;
echo sprintf(" %s sec elapsed\n", $time);
