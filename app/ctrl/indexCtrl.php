<?php
namespace app\ctrl;

class indexCtrl extends \core\diyphp
{
	public function index()
	{
		$data = 'hello world';
		$title = '视图文件';
		$this->assign('title', $title);
		$this->assign('data', $data);
		$this->display('index.html');
	}
}
