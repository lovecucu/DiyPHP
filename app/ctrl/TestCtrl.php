<?php
namespace app\ctrl;

class TestCtrl extends \core\diyphp
{
	public function index()
	{
		$data = 'hello world';
		$title = '正在调用test控制器的index方法';
		$this->assign('title', $title);
		$this->assign('data', $data);
		$this->display('index.html');
	}
}
