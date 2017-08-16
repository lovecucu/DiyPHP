<?php
namespace app\ctrl;

class indexCtrl extends \core\diyphp
{
	public function index()
	{
		$model = new \app\model\msgboxModel();

		$data = $model->getAll();

		$this->assign('data', $data);
		$this->display('index.html');
	}

	public function add()
	{

	}

	public function save()
	{

	}
}
