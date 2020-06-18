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

//Busca os dados do usuário a ser editado.
$conta = new Conta();
$results = $conta->loadById($id);
//Se o método fetch não retornar um array, significa que o ID não é de um usuário válido
if (!is_array($results)) {
	echo "Nenhuma conta encontrada!";
	exit;
}
$tipos = $conta->getListTipoConta();

?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
 
        <title>Editar Conta</title>
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
		<h1>Editar dados da Conta</h1>
	</center>
	<table class="table table-striped">
		<tbody>
			<tr>
				<td colspan="1">
					<form class="well form-horizontal" method="POST" name="form_editar_conta" action="editar-conta.php">
						<input type="hidden" name="id" value="<?php echo $id ?>">
						<fieldset>
							<div class="form-group">
								<label class="col-md-4 control-label">Nome da Conta</label>
								<div class="col-md-8 inputGroupContainer">
									<div class="input-group">
										<span class="input-group-addon"></span><input
											name="nome_conta" placeholder="Nome da Conta"
											class="form-control" required="true" value="<?php echo utf8_decode($results[0]['nome']);?>" type="text">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Tipo de Conta</label>
								<div class="col-md-8 inputGroupContainer">
									<div class="input-group">
										<span class="input-group-addon"></span> <select
											class="selectpicker form-control" name="tipos_conta">
                                                  <?php  
                                                foreach ($tipos as $tipo) {
                                                    $idTipoConta = $tipo['id_tipo_conta'];
                                                    $nomeTipoConta = $tipo['nome'];
                                                    ?>
                                                <option value="<?php echo $idTipoConta?>" <?= ($idTipoConta == $results[0]['id_tipo_conta'])? 'selected':''?>><?php echo utf8_decode($nomeTipoConta)?></option>
                                                <!-- O utf8_decode vai servir para permitir carateres especiais -->
                                                <?php }?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Valor inicial da conta</label>
								<div class="col-md-8 inputGroupContainer">
									<div class="input-group">
										<span class="input-group-addon"></span><input
											name="valor_inicial" id="valor"
											class="form-control" required value="<?php echo $results[0]['valor'];?>" type="text">
									</div>
								</div>
							</div>
							<a href="tela-conta.php" class="btn btn-info">Cancelar</a>
							<input type="submit" name="alterar" onclick="verificarValor();"
								class="btn btn-success"
								value="Alterar">
						</fieldset>
					</form>
				</td>
			</tr>
		</tbody>
	</table>
</div>


<script type="text/javascript">
function verificarValor() {
  var valor = form_editar_conta.valor_inicial.value;
  var campoValor = document.getElementById('valor');
  
  if (!isNaN(parseFloat(valor)) && isFinite(valor)) {
	  campoValor.setCustomValidity("");
  } else {
	  campoValor.setCustomValidity("Preencha o campo com valores numéricos!");
  }
};    
</script>   
 
<?php include_once 'footer.php';?>

 