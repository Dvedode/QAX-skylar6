<?php


// add auto load 
require_once Q_ROOT . '/source/api/plugin/PluginCacheLocalFile.php';
require_once Q_ROOT . '/source/api/plugin/PluginLoader.php';
spl_autoload_register(['PluginLoader', 'loadByConfig'], false);

//code http://git-core03.qianxin-inc.cn:8080/
$url = 'http://git-core03.qianxin-inc.cn:8080/api/v1/userInfo?username=zhangyong04&password=Test#99@Skyeye'
function geturl($url){		
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	if (!empty($data)){
  	   curl_setopt($ch, CURLOPT_POST, TRUE);
  	   curl_setopt($ch, CURLOPT_POSTFIELDS);
	}
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	curl_close($ch);
	return 	$output=json_decode($output,true);	
}
geturl($url);

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
