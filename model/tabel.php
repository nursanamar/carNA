<?php
	namespace model;									//penting!!
	use lib\MVC\model\model;					//penting!!

	class tabel extends model{
		public function __construct(){
			parent::__construct();				//penting!!
		}
		public function ambil(){
			$col = array("nama","kelas");
			$this->select($col);
			$this->from("data");

			return $this->get();
		}
		public function tambah($p){
			$this->into("data");
			$this->set($p);

			$this->insert();
		}
		public function hapus($p1,$p2){
			$this->into("data");
			$this->where($p1,$p2);

			$this->delete();
		}
		public function ubah($p,$p2){

			$this->into("data");
			$this->set($p);
			$this->where("nama",$p2);

			$this->update();

		}
	}
 ?>