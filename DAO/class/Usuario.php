<?php 

	class Usuario {

		private $idusuario;
		private $deslogin;
		private $dessenha;
		private $dtcadastro;

		public function getIdusuario(){
			return $this->idusuario;
		}

		public function setIdusuario($value){
			$this->idusuario = $value;
		}


		public function getDeslogin(){
			return $this->deslogin;
		}

		public function setDeslogin($value){
			$this->deslogin = $value;
		}


		public function getDessenha(){
			return $this->dessenha;
		}

		public function setDessenha($value){
			$this->dessenha = $value;
		}


		public function getDtcadastro(){
			return $this->dtcadastro;
		}

		public function setDtcadastro($value){
			$this->dtcadastro = $value;
		}


		public function loadById($id){
			$sql = new Sql();

			$results = $sql->select("SELECT * FROM TB_USUARIOS WHERE IDUSUARIO = :ID", array(
				":ID"=>$id
			));

			if (count($results) > 0) {

				$row = $results[0];

				$this->setIdusuario($row['IDUSUARIO']);
				$this->setDeslogin($row['DESLOGIN']);
				$this->setDessenha($row['DESSENHA']);
				$this->setDtcadastro(new DateTime($row['DTCADASTRO']));
			}
		}

		public static function getList(){

			$sql = new Sql();

			return $sql->select("SELECT * FROM TB_USUARIOS ORDER BY DESLOGIN");
		}

		public static function search($login){

			$sql = new Sql();
			return $sql->select("SELECT * FROM TB_USUARIOS WHERE DESLOGIN LIKE :SEARCH ORDER BY DESLOGIN", array(
				'SEARCH'=>"%".$login."%"
			));
		}

		public function login($login, $password){

			$sql = new Sql();

			$results = $sql->select("SELECT * FROM TB_USUARIOS WHERE DESLOGIN = :LOGIN AND DESSENHA = :PASSWORD", array(
				":LOGIN"=>$login,
				":PASSWORD"=>$password
			));

			if (count($results) > 0) {

				$row = $results[0];

				$this->setIdusuario($row['IDUSUARIO']);
				$this->setDeslogin($row['DESLOGIN']);
				$this->setDessenha($row['DESSENHA']);
				$this->setDtcadastro(new DateTime($row['DTCADASTRO']));
			} else {

				throw new Exception("Login e/ou senha invalidos");
				
			}
		}



		public function __toString(){

			return json_encode(array(
				"IDUSUARIO"=>$this->getIdusuario(),
				"DESLOGIN"=>$this->getDeslogin(),
				"DESSENHA"=>$this->getDessenha(),
				"DTCADASTRO"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
			));
		}

	}

 ?>