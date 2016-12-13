<?php
	namespace controler;							//penting!!
	use lib\MVC\controler\base;				//penting!!
	use model\tabel;									//penting!!
	class home extends base{
		public function __construct(){
				parent::__construct();			//penting!!
				$this->model("tabel"); 			//panggil model
		}
		public function index(){
			$data['hasil'] = $this->model->ambil();
			$this->view("view",$data);
		}
		public function tambah(){
			$data = array( "nama" => "rahmat","kelas" => "XII TKJ 2");
			$this->model->tambah($data);
			$this->index();
		}
		public function ubah(){
			$data = array("kelas" => "XII TKJ 1");
			$this->model->ubah($data);
		}
		public function hapus(){
			$this->model->hapus("nama","rahmat");
			redirect(index);
		}
	}
 ?>
