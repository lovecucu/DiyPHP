<?php
namespace core\lib;
use core\lib\conf;
class log
{
	/**
	 * 1 确定日志的存储方式
	 * 2 写日志
	 * @var [type]
	 */
	static public $class;

	static public function init()
	{
		// 加载存储方式
		$driver = conf::get('DRIVER', 'log');
		$class = '\core\lib\driver\log\\'.$driver;
		self::$class = new $class();
	}

	static public function write($name, $file='log')
	{
		self::$class->write($name, $file);
	}
}