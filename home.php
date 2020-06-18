<?php
header('Content-Type: text/html; charset=iso-8859-1');
require_once ("config.php");
// permitir entrar na página só se estiver logado na sessao
require_once ("config-sessao.php");

$nome = $_SESSION['nome'];
$idUtilizador = $_SESSION['id_utilizador'];
$conta = new Conta();
$conta->setIdUtilizador($idUtilizador);
$count = $conta->countRows();
$total = $count[0]['total'];

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Home</title>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script	src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<link	href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css"	rel="stylesheet" id="bootstrap-css">
<script	src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<?php include_once 'header.php';?>

<div class="container">
	<div class="row">


		<div class="col-md-12">
			<h4>Contas</h4>

	<?php

if ($total > 0) {
    $results = $conta->loadByIdUtilizador($idUtilizador);
    ?>

		<div class="table-responsive">


				<table id="mytable" class="table table-bordred table-striped">

					<thead>
						<th>Nome da Conta</th>
						<th>Valor Inicial da Conta</th>
						<th>Tipo de Conta</th>
						<th>Valor atual da Conta</th>
						<th>Total de Receita da Conta</th>
						<th>Total de Despesa da Conta</th>
					</thead>
					<tbody>

						<?php foreach ($results as $result) { ?>
					<tr>
			<td><?php echo utf8_decode($result['nome']); ?></td>
			<td><?php echo $result['valor_inicial']; ?></td>
			<td><?php echo utf8_decode($result['tipo']); ?></td>
			<td><?php echo $result['valor_atual']; ?></td>
			<td><?php echo $result['total_receita']; ?></td>
			<td><?php echo $result['total_despesa']; ?></td>
		</tr>
					<?php } ?>

					</tbody>

				</table>

			</div>

		
		<?php } else { ?>
 
        <p>Nenhuma conta associada!</p>
 
        <?php } ?>

</div>
	</div>
</div>
<?php include_once 'footer.php';?>








			
