<?php
namespace core;

class diyphp
{
	public static $classMap = array();
	public $assign;
	/**
	 * [run 框架启动]
	 * @return [type] [description]
	 */
	public static function run()
	{
		# 初始化路由
		$route = new \core\lib\route();
		$ctrlClass = $route->ctrl;
		$action = $route->ctrl;
		
		# 实例化控制器以及调用方法
		$ctrlFile = APP . '/ctrl/'. $ctrlClass . 'Ctrl.php';
		$ctrlName = MODULE. '\\ctrl\\' . $ctrlClass.'Ctrl';
		if(file_exists($ctrlFile)) {
			include $ctrlFile;
			$ctrl = new $ctrlName;
			$ctrl->$action();
		} else {
			throw new Exception("找不到控制器".$ctrlClass);
		}
	}

	/**
	 * [load 类自动函数]
	 * @param  [type] $class [description]
	 * @return [type]        [description]
	 */
	public static function load($class)
	{
		# 自动加载类库
		$class = str_replace('\\', '/', $class);
		if(isset(self::$classMap[$class])) {
			return true;
		} else {
			$sFile = DIYPHP . '/' . $class . '.php';
			if(file_exists($sFile)) {
				include $sFile;
				self::$classMap[$class] = $class;
			} else {
				return false;
			}
		}
	}

	/**
	 * [assign 视图变量分配]
	 * @param  [type] $name  [变量名]
	 * @param  [type] $value [变量值]
	 * @return [type]        [description]
	 */
	public function assign($name, $value) 
	{
		$this->assign[$name] = $value;
	}

	/**
	 * [display 展示视图]
	 * @param  [type] $file [视图文件]
	 * @return [type]       [description]
	 */
	public function display($file)
	{
		$file = APP . '/views/'.$file;
		if(file_exists($file)) {
			extract($this->assign);
			include $file;
		} 
	}
} 