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
			$data = $this->model->ambil();
			$json = json_encode($data);
			echo $json;
		}
		public function pos() {
			$this->view('form',null);
		}
		public function table()
		{
			$this->view('home',null);
		}
		public function tambah(){
			$data = array( "nama" => $_POST['nama'],"kelas" => $_POST['kelas']);
			$this->model->tambah($data);
			$res = json_encode($_POST);
			echo $res;
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