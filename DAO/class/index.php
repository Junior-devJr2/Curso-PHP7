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
	$usuario = new Usuario();
	$usuario->login("JOSE","ABC123");

	echo $usuario;


 ?>