<?php
namespace core\lib;
use core\lib\conf;

class model extends \Medoo\Medoo
{
	public function __construct() 
	{
		$options = conf::all('database');
		parent::__construct($options);
	}

	public function getAll($where=array(), $fields='*')
	{
		return $this->select($this->table, $fields, $where);
	}

	public function getRow($where=array(), $fields='*')
	{
		return $this->get($this->table, $fields, $where);
	}

	public function add($data)
	{
		return $this->insert($this->table, $data);
	}

	public function up($data, $where)
	{
		return $this->update($this->table, $data, $where);
	}

	public function del($where)
	{
		return $this->delete($this->table, $where);
	}
}