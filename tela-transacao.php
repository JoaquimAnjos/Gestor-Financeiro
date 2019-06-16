<?php

header('Content-Type: text/html; charset=iso-8859-1');
require_once("config.php");
//permitir entrar na página só se estiver logado na sessao
require_once ("config-sessao.php");

$transacao = new Transacao();
$transacao->setIdUtilizador($_SESSION['id_utilizador']);
$count = $transacao->countRows();
$total = $count[0]['total'];

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Transações</title>

<?php include_once 'header.php';?>

<h1>Transações</h1>

	<?php if ($total > 0) { 
	    $results = $transacao->loadByIdUtilizador();
	?>

		<table width="50%" border="1">
			<thead>
				<tr>
					<th>Descrição da Transação</th>
					<th>Valor</th>
					<th>Data</th>
					<th>Conta</th>
					<th>Tipo</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
			  	<?php foreach ($results as $result) { ?>
					<tr>
						<td><?php echo utf8_decode($result['descricao']); ?></td>
	                    <td><?php echo $result['valor']; ?></td>
	                    <td><?php echo utf8_decode($result['data_transacao']); ?></td>
	                    <td><?php echo utf8_decode($result['conta']); ?></td>
	                    <td><?php echo utf8_decode($result['tipo_transacao']); ?></td>
	                   	
	                    <td>
                        <a href="form-editar-transacao.php?id=<?php echo $result['id'] ?>">Editar</a>
                        <a href="apagar-transacao.php?id=<?php echo $result['id'] ?>" onclick="return confirm('Tem certeza de que deseja remover?');">Remover</a>
                    	</td>
					</tr>
					<?php } ?>
			</tbody>
		</table>

		<?php } else { ?>
 
        <p>Nenhuma transação associada!</p>
 
        <?php } ?>

<?php include_once 'footer.php';?>