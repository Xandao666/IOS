<?php
	session_start();
		include_once("conexao.php");
$consulta = "SELECT * FROM usuarios";
$con = $conn->query($consulta) or die($conn->error);

if($_SESSION['usuarioNiveisAcessoId'] == "2"){
				header("Location: cliente.php");
			}elseif($_SESSION['usuarioNiveisAcessoId'] == "3"){
				header("Location: cliente.php");
			}elseif($_SESSION['usuarioNiveisAcessoId'] == null){
				header("Location: index.php");
			}
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="Cesar Szpak - Celke">
		<link rel="icon" href="imagens/favicon.ico">

		<title>Administrativo</title>
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
		<link href="css/theme.css" rel="stylesheet">
		<script src="js/ie-emulation-modes-warning.js"></script>
	</head>

	<body role="document">

    <!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">iOSCHECKERS</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="#">PAINEL ADMINISTRATIVO</a></li>
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuario <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#sobre"><?php echo "Nome: ". $_SESSION['usuarioNome']; ?></a></li>
                            <li><a href="#nivel"><?php if ($_SESSION['usuarioNiveisAcessoId'] == 1) {
        echo "Nivel: ADMIN";
    }elseif ($_SESSION['usuarioNiveisAcessoId'] == 2) {
        echo "Nivel: COLABORADOR";
    }else{
        echo "Nivel: CLIENTE";
    } ?></a></li>
                        </ul>
                    </li>
                    <li><a href="cliente.php">CHECKER</a></li>
                    <li><a href=""></a></li>
                    <li><a href="sair.php">SAIR</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
	<br>
	<div class="container theme-showcase" role="main">
		<div class="page-header">
			<h1>Usuários</h1>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>NOME</th>
							<th>EMAIL</th>
							<th>LIVES</th>
							<th>NIVEL</th>
							<th>DATA CADASTRO</th>
							<th>AÇÕES</th>
						</tr>
					</thead>
					<tbody>
						<?php while($dado = $con->fetch_array()){?>
						<tr>
							<td><?php echo $dado["id"];?></td>
							<td><?php echo $dado["nome"];?></td>
							<td><?php echo $dado["email"];?></td>
							<td><?php echo $dado["lives"];?></td>
							<td><?php echo $dado["niveis_acesso_id"];?></td>
							<td><?php echo date("d/m/Y", strtotime($dado["created"]));?></td>
							<td>
								<button type="button" class="btn btn-xs btn-primary">Visualizar</button>
								<button type="button" class="btn btn-xs btn-warning">Editar</button>
								<button type="button" class="btn btn-xs btn-danger">Apagar</button>
							</td>
						</tr>
						<?php } ?>              
					</tbody>
				</table>
			</div>
		</div>
	</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>

