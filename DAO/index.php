<?php 

	require_once("config.php");

	/*$sql = new Sql();

	$usuarios = $sql->select("SELECT * FROM TB_USUARIOS");

	echo json_encode($usuarios); */

	/* carrega um usuario
	$root = new Usuario();	
	$root->loadById(1);*/

	//carrega uma lista de usuarios
	//$lista = Usuario::getList();

	//echo json_encode($lista);
	
	//carrega uma lista de usuarios buscando pelo login
	//$search = Usuario::search("O");
	//echo json_encode($search);

	//carrega um usuario usando o login e a senha
	//$usuario = new Usuario();
	//$usuario->login("JOSE","ABC123");
	//echo $usuario;

	/* criando um novo usuario (insert)
	$aluno = new Usuario();
	$aluno->setDeslogin("aluno");
	$aluno->setDessenha("@lun0");

	$aluno->insert();

	echo $aluno;
	*/

	/* alterar um usuario
	$usuario = new Usuario();

	$usuario->loadById(3);

	$usuario->update("professor", "apsd#$$@ws23");

	echo $usuario;
	*/
	$usuario = new Usuario();

	$usuario->loadById(2);

	$usuario->delete();

	echo $usuario;

 ?>