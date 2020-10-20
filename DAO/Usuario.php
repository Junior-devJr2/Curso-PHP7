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

				$this->setData($results[0]);
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
				
				$this->setData($results[0]);

			} else {

				throw new Exception("Login e/ou senha invalidos");
				
			}
		}

		public function setData($data){

			$this->setIdusuario($data['IDUSUARIO']);
			$this->setDeslogin($data['DESLOGIN']);
			$this->setDessenha($data['DESSENHA']);
			$this->setDtcadastro(new DateTime($data['DTCADASTRO']));

		}

		public function insert(){

			$sql = new Sql();

			$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
				':LOGIN'=>$this->getDeslogin(),
				':PASSWORD'=>$this->getDessenha()
			));

			if (count($results) > 0) {
				$this->setData($results[0]);
			}
		}

		
		public function update($login, $password){

			$this->setDeslogin($login);
			$this->setDessenha($password);

			$sql = new Sql();

			$sql->query("UPDATE TB_USUARIOS SET DESLOGIN = :LOGIN, DESSENHA = :PASSWORD WHERE IDUSUARIO = :ID", array(':LOGIN'=>$this->getDeslogin(), 
				':PASSWORD'=>$this->getDessenha(),
				':ID'=>$this->getIdusuario()
			));
		}

		public function __construct($login = "", $password = ""){

			$this->setDeslogin($login);
			$this->setDessenha($password);
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