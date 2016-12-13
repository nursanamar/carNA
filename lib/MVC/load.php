<?php
namespace lib\MVC;
use config\db;
class load{
	public $nmodel;
	public function __construct(){
		return "sukses";
	}
	public function model($name){
		$this->nmodel = $name;
		$ns = "\\model\\";
		$model = $ns.$this->nmodel;
		
		return new $model();
	}
}
 ?>