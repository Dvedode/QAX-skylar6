<?php
error_reporting(E_ALL & ~E_NOTICE | E_STRICT);
ini_set('display_errors', 'On');

defined('TBG') or define('TBG', microtime(true));
defined('Q_ROOT') or define('Q_ROOT', dirname(__FILE__).DIRECTORY_SEPARATOR);
defined('IN_360') or define('IN_360', true);
define('YII_DEBUG', false);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',10);



//OEM初始化[START]
$all_config = Yii::app()->getComponents(false);

if(isset($all_config['oem_id']) && file_exists(Q_ROOT.'/oem/'.$all_config['oem_id'].'/config.php'))
{
	defined('OEM_ID')        or define('OEM_ID', $all_config['oem_id']);
	defined('OEM_BASE_PATH') or define('OEM_BASE_PATH', Q_ROOT.'oem'.DIRECTORY_SEPARATOR.OEM_ID.DIRECTORY_SEPARATOR);
	Yii::import('application.oem.'.OEM_ID.'.*');
	Yii::app()->setModules(array(
		OEM_ID => array('class' => ucfirst(OEM_ID).'Module'),
	));
	Yii::app()->setAliases(array(
		ucfirst(OEM_ID) => OEM_BASE_PATH,
	));
	Constants::$OEM_CONFIG = include_once(OEM_BASE_PATH.'config.php');
}

if(isset($all_config['oem_id']) && file_exists(Q_ROOT.'/oem/'.$all_config['oem_id'].'/config/version.php')){
	include(Q_ROOT.'/oem/'.$all_config['oem_id'].'/config/version.php');
}
if(is_file(Q_ROOT.'/config/version.php')){//设定版本号, 用于控制台右上角的显示
	include(Q_ROOT.'/config/version.php');
}
defined('PRODUCT_VER') or define('PRODUCT_VER','6.0.1');
//OEM初始化[END]


}
