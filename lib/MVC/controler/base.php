<?php
namespace lib\MVC\controler;
use lib\MVC\load;
abstract class base{
	protected $urlparams;
	protected $action;
	public $load;
	public $model;
	public function __construct(){
		$this->load = new load();
	}
	public function model($p){
	
		$this->model = $this->load->model($p);
		
	}
	public function executeaction($action,$urlparams){
		$this->urlparams = $urlparams;
		$this->action = $action;
		return $this->{$this->action}();
	}
	public function view($file,$data){
		extract($data,EXTR_PREFIX_SAME,"w");
		$conten = __DIR__."/../../../view/".$file.".php";
		require $conten;
	}
}
 ?>