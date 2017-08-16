<?php
namespace core\lib\driver\log;
use core\lib\conf;
class file
{
	public $path;
	public function __construct()
	{
		$this->path = conf::get('OPTION', 'log')['PATH'].'/'.date('Ymd');
	}

	public function write($message, $file)
	{
		/**
		 * 1 确定目录是否存在
		 *  新建文件
		 * 2 写入日志
		 */
		if(! is_dir($this->path))
		{
			mkdir($this->path, '0777', true);
		}
		return file_put_contents($this->path.'/'.$file.'.php', date('Y-m-d H:i:s').json_encode($message).PHP_EOL, FILE_APPEND);
	}
}