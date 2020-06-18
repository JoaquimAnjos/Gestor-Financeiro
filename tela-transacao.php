<?php
header('Content-Type: text/html; charset=iso-8859-1');
require_once ("config.php");
// permitir entrar na página só se estiver logado na sessao
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
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link
	href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css"
	rel="stylesheet" id="bootstrap-css">
<script
	src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<!------ Include the above in your HEAD tag ---------->

<script
	src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<?php include_once 'header.php';?>

<div class="container">
	<div class="row">


		<div class="col-md-12">
			<h4>Transações</h4>

	<?php

if ($total > 0) {
    $results = $transacao->loadByIdUtilizador();
    ?>

			<div class="table-responsive">


				<table id="mytable" class="table table-bordred table-striped">

					<thead>

						<th>Descrição da Transação</th>
						<th>Valor</th>
						<th>Data</th>
						<th>Conta</th>
						<th>Tipo</th>
						<th>Editar</th>
						<th>Apagar</th>
					</thead>
					<tbody>
					<?php foreach ($results as $result) { ?>
					<tr>
							<td><?php echo utf8_decode($result['descricao']); ?></td>
							<td><?php echo $result['valor']; ?></td>
							<td><?php echo utf8_decode($result['data_transacao']); ?></td>
							<td><?php echo utf8_decode($result['conta']); ?></td>
							<td><?php echo utf8_decode($result['tipo_transacao']); ?></td>
							<td><p data-placement="top" data-toggle="tooltip" title="Editar">
									<a class="btn btn-primary btn-xs" href="form-editar-transacao.php?id=<?php echo $result['id'] ?>">
										<span class="glyphicon glyphicon-pencil"></span>
									</a>
								</p></td>
							<td><p data-placement="top" data-toggle="tooltip" title="Apagar">
									<a class="btn btn-danger btn-xs" href="apagar-transacao.php?id=<?php echo $result['id'] ?>" onclick="return confirm('Tem certeza de que deseja remover?');">
										<span class="glyphicon glyphicon-trash"></span>
									</a>
								</p></td>
						</tr>
					<?php } ?>
					</tbody>

				</table>

			</div>

		<?php } else { ?>
 
        <p>Nenhuma transação associada!</p>
 
        <?php } ?>
        
        </div>
	</div>
</div>
        

<?php include_once 'footer.php';?>


	

		