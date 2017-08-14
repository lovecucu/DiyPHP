<?php
namespace core\lib;

class route
{
	public $ctrl;
	public $action;
	public function __construct()
	{
		# www.xxx.com/index.php/index/index
		/**
		 * 1.隐藏index.php
		 * 2.获取URL参数
		 * 3.获取控制器和方法
		 */
		if(isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/') 
		{
			$path = $_SERVER['REQUEST_URI'];
			$pathArr = explode('/', trim($path, '/'));
			if(isset($pathArr[0])) {
				$this->ctrl = $pathArr[0];
				unset($pathArr[0]);
			} 

			if(isset($pathArr[1])) {
				$this->action = $pathArr[1];
				unset($pathArr[1]);	
			}

			# url多余部分作为GET参数
			$count = count($pathArr) + 2;
			$i = 2;
			while($i < $count) {
				if(isset($pathArr[$i + 1])) {
					$_GET[$pathArr[$i]] = $pathArr[$i + 1];
				}
				$i += 2;
			}
		} else {
			$this->ctrl = 'index';
			$this->action = 'index';
		}
	}
}