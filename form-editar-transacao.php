<?php
header('Content-Type: text/html; charset=iso-8859-1');
require_once ("config.php");
//permitir entrar na página só se estiver logado na sessao
require_once ("config-sessao.php");


//Pega ID da URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
//Valida ID
if (empty($id)) {
    echo "ID para alteração não definido.";
    exit;
}

$transacao = new Transacao();
$transacao->setIdTransacao($id);
$conta = new Conta();
$conta->setIdUtilizador($_SESSION['id_utilizador']);
$results = $transacao->loadById();
$date = new DateTime($results[0]['data_transacao']);
//Se o método fetch não retornar um array, significa que o ID não é de uma transacao válido
if (!is_array($results)) {
    echo "Nenhuma transacao encontrada!";
    exit;
}
$tiposTransacao = $transacao->getTiposTransacao();

?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
 
        <title>Editar Transação</title>
        <link
	href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css"
	rel="stylesheet" id="bootstrap-css">
<script
	src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script
	src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php include_once 'header.php';?>
 
        <div class="container">
	<center>
		<h1>Editar dados da Transação</h1>
	</center>
	<table class="table table-striped">
		<tbody>
			<tr>
				<td colspan="1">
					<form class="well form-horizontal" method="POST" name="form_editar_transacao" action="editar-transacao.php">
						<input type="hidden" name="contas" value="<?php echo $results[0]['id_conta'] ?>">
						<input type="hidden" name="id" value="<?php echo $id ?>">
						<input type="hidden" name="valor-anterior" required value="<?php echo utf8_decode($results[0]['valor']);?>"/>
						<fieldset>
							<div class="form-group">
								<label class="col-md-4 control-label">Descrição da transação</label>
								<div class="col-md-8 inputGroupContainer">
									<div class="input-group">
										<span class="input-group-addon"></span><input
											name="descricao" placeholder="Descrição da transação"
											class="form-control" required="true" value="<?php echo utf8_decode($results[0]['descricao']);?>" type="text">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Tipo de Transação</label>
								<div class="col-md-8 inputGroupContainer">
									<div class="input-group">
										<span class="input-group-addon"></span> <select
											class="selectpicker form-control" name="tipos_transacao">
                                                  <?php  
                                                foreach ($tiposTransacao as $tipoTransacao) {
                                                    $idTipoTransacao = $tipoTransacao['id_tipo_transacao'];
                                                    $descricaoTransacao = $tipoTransacao['descricao'];
                                                    ?>
                                                <option value="<?php echo $idTipoTransacao?>" <?= ($idTipoTransacao == $results[0]['id_tipo_transacao'])? 'selected':''?>><?php echo utf8_decode($descricaoTransacao)?></option>
                                                <?php }?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Valor da Transação</label>
								<div class="col-md-8 inputGroupContainer">
									<div class="input-group">
										<span class="input-group-addon"></span><input
											name="valor" placeholder="Valor da Transação" id="valor"
											class="form-control" required="true" value="<?php echo abs($results[0]['valor']);?>" type="text">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Data da Transação</label>
								<div class="col-md-8 inputGroupContainer">
									<div class="input-group">
										<span class="input-group-addon"></span><input
											name="data" 
											class="form-control" required="true" value="<?php echo $date->format('Y-m-d\TH:i');?>" type="datetime-local">
									</div>
								</div>
							</div>
							<a href="tela-transacao.php" class="btn btn-info">Cancelar</a>
							<input type="submit" name="alterar" onclick="verificarValor();" class="btn btn-success" value="Alterar">
						</fieldset>
					</form>
				</td>
			</tr>
		</tbody>
	</table>
</div>

<script type="text/javascript">
function verificarValor() {
	var valor = form_editar_transacao.valor.value;
	  var campoValor = document.getElementById('valor');
	  
	  var regra = /^[0-9]+$/;
	  //if (valor.match(regra) && valor > 0.00) {
	  if (!isNaN(parseFloat(valor)) && isFinite(valor) && valor > 0.00) {
		  campoValor.setCustomValidity("");
	  } else {
		  campoValor.setCustomValidity("Preencha o campo com valores numéricos superiores a 0!");
	  }
};    
</script>
 
<?php include_once 'footer.php';?>


