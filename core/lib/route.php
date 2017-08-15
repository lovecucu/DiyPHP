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
		if(isset($_SERVER['REQUEST_URI']) && $path = trim($_SERVER['REQUEST_URI'],'/')) 
		{
			$pathArr = explode('/', $path);
			$this->ctrl = isset($pathArr[0]) ? $pathArr[0] : 'index';
			$this->action = isset($pathArr[1]) ? $pathArr[1] : 'index';

			# url多余部分作为GET参数
			$count = count($pathArr) + 2;
			$i = 2;
			while($i < $count) 
			{
				if(isset($pathArr[$i + 1])) 
				{
					$_GET[$pathArr[$i]] = $pathArr[$i + 1];
				}
				$i += 2;
			}
		} 
		else 
		{
			$this->ctrl = 'index';
			$this->action = 'index';
		}
	}
}