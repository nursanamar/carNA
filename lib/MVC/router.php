<?php
	namespace lib\MVC;

	class router{
		private $controler;
		public $action;
		public $ulrparams;
		private $co_nspce = "\\controler\\";
		private $basecon = "lib\\MVC\\controler\\base";

		public function __construct($urlp){
			$param="";
			foreach ($urlp as $key => $value) {
				$param=$key;
			}
			$this->urlparams = explode("/",$param);
			 $this->controler = (empty($this->urlparams[1])) ? $this->co_nspce."home":$this->co_nspce.$this->urlparams[1];

			 $this->action = (empty($this->urlparams[2])) ? "index":$this->urlparams[2];

		}
		public function  getcontroler(){
			if(class_exists($this->controler)){
				$parent = class_parents($this->controler);
				if(in_array($this->basecon,$parent)){
					if(method_exists($this->controler,$this->action)){
						return new $this->controler();
					}else{
						throw new \Exception("aksi tidak di temukan");
					}
				}else{
					print_r($this->urlparams);
					print_r($this->controler);
					print_r($this->action);
					print_r($parent);
					print_r($this->basecon);
				}
			}else{
				throw new \Exception("controler tidak di temukan");
			}
		}
	}
 ?>
