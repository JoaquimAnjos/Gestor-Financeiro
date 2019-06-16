<?php

header('Content-Type: text/html; charset=iso-8859-1');
require_once("config.php");
//permitir entrar na página só se estiver logado na sessao
require_once ("config-sessao.php");
 
// $nome= $_SESSION['nome'];
$idUtilizador = $_SESSION['id_utilizador'];
$conta = new Conta();
$count = $conta->countRows($idUtilizador);
$total = $count[0]['total'];

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Criação da Conta</title>

<?php include_once 'header.php';?>

<h1>Contas</h1>

	<?php if ($total > 0) { 
	    $results = $conta->loadByIdUtilizador($idUtilizador);
	?>

		<table width="50%" border="1">
			<thead>
				<tr>
					<th>Nome da Conta</th>
					<th>Valor Inicial da Conta</th>
					<th>Tipo de Conta</th>
					<th>Valor atual da Conta</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
			  	<?php foreach ($results as $result) { ?>
					<tr>
						<td><?php echo utf8_decode($result['nome']); ?></td>
	                    <td><?php echo $result['valor_inicial']; ?></td>
	                    <td><?php echo utf8_decode($result['tipo']); ?></td>
	                    <td><?php echo $result['valor_atual']; ?></td>
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
    	<?php include_once 'footer.php';?>
