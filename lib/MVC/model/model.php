<?php
	namespace lib\MVC\model;

	use 	config\db;

	abstract class model{

		public $db;
		public $tabel;
		public $where;
		public $col;
		public $set;
		public function __construct(){
			$db = new db();
			$config = $db->config();
			$con = "mysql:host=".$config['host'].";dbname=".$config['dbname'];
			$this->db = new \PDO($con,$config['user'],$config['pass']);
		}

		public function teskonek(){
			return $this->db;
		}

		public function select($p){
			$data = "";

			if(is_array($p)){

				foreach($p as $col){
					$data .= "`".$col."`,";
				}

			}else{

				$data = $p;

			}

			$this->col = $data;
		}
		public function from($p){

		$this->tabel = $p;

		}
		public function where($p1,$p2){

		$this->where = " WHERE `".$p1."` = '".$p2."'";

		}
		public function get(){
			$query = "SELECT ".trim($this->col,",")." FROM ".$this->tabel.$this->where;
			$tabel = $this->db->query($query);
			//return $query;
			return $tabel->fetchAll(\PDO::FETCH_ASSOC);
		}
		public function set($p){

			$data = "";

			foreach($p as $col => $value){
				$data .=" `".$col."` = '".$value."',";
			}

			$this->set= $data;

		}
		public function into($p){

			$this->tabel = $p;

		}
		public function insert(){

			$query = "INSERT INTO ".$this->tabel." SET".trim($this->set,",");
			$this->db->query($query);
		}
		public function update(){

			$query = "UPDATE `".$this->tabel."` SET".trim($this->set,",").$this->where;
			$this->db->query($query);


		}
		public function delete(){

			$query = "DELETE FROM ".$this->tabel.$this->where;
			$this->db->query($query);

		}
	}
 ?>
