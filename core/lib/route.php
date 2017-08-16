<?php
namespace core\lib;
use core\lib\conf;
class route
{
	public $ctrl;
	public $action;
	public function __construct()
	{
		# www.xxx.com/index.php/index/index
		/**
		 * 1.隐藏index.php（见.htaccess）
		 * 2.获取URL参数
		 * 3.获取控制器和方法
		 */
		if(isset($_SERVER['REQUEST_URI']) && $path = trim($_SERVER['REQUEST_URI'],'/')) {
			// 获取控制器和方法
			$pathArr = explode('/', $path);
			$this->ctrl = isset($pathArr[0]) ? $pathArr[0] : conf::get('CTRL', 'route');
			$this->action = isset($pathArr[1]) ? $pathArr[1] : conf::get('ACTION', 'route');

			// url多余部分作为GET参数
			$count = count($pathArr) + 2;
			$i = 2;
			while($i < $count) {
				if(isset($pathArr[$i + 1])) {
					$_GET[$pathArr[$i]] = $pathArr[$i + 1];
				}
				$i += 2;
			}
		} else {
			$this->ctrl = conf::get('CTRL', 'route');
			$this->action = conf::get('ACTION', 'route');
		}
	}
}