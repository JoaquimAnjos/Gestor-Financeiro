<?php

header('Content-Type: text/html; charset=iso-8859-1');
require_once("config.php");
//permitir entrar na página só se estiver logado na sessao
require_once ("config-sessao.php");
 
// $nome= $_SESSION['nome'];
$conta = new Conta();
$count = $conta->countRows();
$total = $count[0]['total'];

$results = $conta->loadAll();


?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Criação da Conta</title>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
<!-- <div id = "menu"> -->
<div id ="interface">
<nav id = "menu"> 
<ul>
<li><a href = "tela-transacao.php">Transações</a></li>
<li><a href = "tela-conta.php">Minhas Contas</a></li>
<li><a href = "criacao-transacao.php">Criar Transação</a></li>
<li><a href = "criacao-conta.php">Criar Conta</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</nav>
<!--  </div>-->
<h1>Contas</h1>

	<?php if ($total > 0) { ?>

		<table width="50%" border="1">
			<thead>
				<tr>
					<th>Nome da Conta</th>
					<th>Valor Inicial da Conta</th>
					<th>Tipo de Conta</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
			  	<?php foreach ($results as $result) { ?>
					<tr>
						<td><?php echo utf8_decode($result['nome']); ?></td>
	                    <td><?php echo utf8_decode($result['valor']); ?></td>
	                    <td><?php echo utf8_decode($result['tipo']); ?></td>
	                    <td>
                        <a href="form-editar.php?id=<?php echo $result['id'] ?>">Editar</a>
                        <a href="apagar-conta.php?id=<?php echo $result['id'] ?>" onclick="return confirm('Tem certeza de que deseja remover?');">Remover</a>
                    	</td>
					</tr>
					<?php } ?>
			</tbody>
		</table>

		<?php } else { ?>
 
        <p>Nenhuma conta associada!</p>
 
        <?php } ?>
</div>
</body>
</html>