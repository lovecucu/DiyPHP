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
		// log初始化
		\core\lib\log::init();

		// 初始化路由
		$route = new \core\lib\route();
		$ctrlClass = $route->ctrl;
		$action = $route->action;
		
		// 实例化控制器以及调用方法
		$ctrlFile = APP . '/ctrl/'. $ctrlClass . 'Ctrl.php';
		$ctrlName = MODULE. '\\ctrl\\' . $ctrlClass.'Ctrl';
		if (file_exists($ctrlFile)) {
			include $ctrlFile;
			$ctrl = new $ctrlName;
			$ctrl->$action();
			\core\lib\log::write('ctrl: '.$ctrlClass.'    action: '.$action);
		} else {
			throw new \Exception("controller ".$ctrlClass." not find!");
		}
	}

	/**
	 * [load 类自动函数]
	 * @param  [type] $class [description]
	 * @return [type]        [description]
	 */
	public static function load($class)
	{
		// 自动加载类库
		$class = str_replace('\\', '/', $class);
		if (isset(self::$classMap[$class])) {
			return true;
		} else {
			$sFile = DIYPHP . '/' . $class . '.php';
			if (is_file($sFile)) {
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
		$path = APP . '/view/'.$file;
		if(file_exists($path)) {
			// 引入twig
			$loader = new \Twig_Loader_Filesystem(APP . '/view');
			$twig = new \Twig_Environment($loader, array(
			    'cache' => DIYPHP . '/log/twig',
			    'debug' => DEBUG //可无视缓存
			));
			// 渲染页面
			echo $twig->render($file, $this->assign ? $this->assign : array());
		} 
	}
} 