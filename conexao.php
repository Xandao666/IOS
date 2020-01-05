<?php
	$servidor = "localhost";
	$usuario = "Bancodedados";
	$senha = "@Hulk123";
	$dbname = "chks_bancodedados";
	
	//Criar a conexao
	$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
	
	if(!$conn){
		die("Falha na conexao: " . mysqli_connect_error());
	}else{
		//echo "Conexao realizada com sucesso";
	}	
	
?>