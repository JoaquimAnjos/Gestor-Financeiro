<?php
header('Content-Type: text/html; charset=iso-8859-1');
require_once ("config.php");
require_once ("config-sessao.php");

$conta = new Conta();
$results = $conta->getListTipoConta();
if (isset($_POST['criar-conta'])) {
    //vai servir para caso o utilizador crie uma conta com valor inicial a 0
    $valor = $_POST['valor_inicial']== '0'? '0.00': $_POST['valor_inicial'];
    $erros = array();
    $mensagemGuardado = array();
    $nomeConta = isset($_POST['nome_conta']) && ! empty($_POST['nome_conta']) ? $_POST['nome_conta'] : null;
    $idTipoConta = isset($_POST['tipos_conta']) && ! empty($_POST['tipos_conta']) ? $_POST['tipos_conta'] : null;
    $valorInicial = isset($valor) && ! empty($valor) ? $valor : null;
    $validacao = $nomeConta != null && $idTipoConta != null && $valorInicial != null;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Criação Conta</title>
<link
	href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css"
	rel="stylesheet" id="bootstrap-css">
<script
	src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script
	src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php include_once 'header.php';?>

 <?php
if (isset($_POST['criar-conta'])) {

    if (! $validacao) {
        $erros[] = "<li> Todos os campos precisam ser preenchidos</li>";
    } else {
        $conta->setNomeConta(utf8_encode($nomeConta));
        $conta->setIdTipoConta($idTipoConta);
        $conta->setValorInicial($valorInicial); // (double)number_format($valorInicial, 2)
        $conta->setIdUtilizador($_SESSION['id_utilizador']);
        $stmt = $conta->insert();
        if ($stmt->rowCount() > 0) {
            $mensagemGuardado[] = "Gravado com sucesso";
             
        } else {
            $erros[] = "<li>Erro ao criar conta!</li>";
        }
    }
    if (! empty($erros)) {
        foreach ($erros as $erro) {
            echo $erro;
        }
    }
}
?>

<div class="container">
	<center>
		<h1>Crie a sua conta</h1>
	</center>
	<table class="table table-striped">
		<tbody>
			<tr>
				<td colspan="1">
					<form class="well form-horizontal" method="POST"
						name="form_criar_conta"
						action="<?php echo $_SERVER['PHP_SELF'];?>">

						<fieldset>
							<div class="form-group">
								<label class="col-md-4 control-label">Nome da Conta</label>
								<div class="col-md-8 inputGroupContainer">
									<div class="input-group">
										<span class="input-group-addon"></span><input
											name="nome_conta" placeholder="Nome da Conta"
											class="form-control" required="true" value="" type="text">
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
                                                        foreach ($results as $result) {
                                                            $idTipoConta = $result['id_tipo_conta'];
                                                            ?>
                                                        <option value="<?php echo $idTipoConta?>"><?php echo utf8_decode($result['nome'])?></option>
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
											name="valor_inicial" id="valor" placeholder=""
											class="form-control" required value="" type="text">
									</div>
								</div>
							</div>
							<input type="submit" name="criar-conta" class="btn btn-success" onclick="verificarValor();" value="Criar Conta">
						</fieldset>
					</form>
				</td>
			</tr>
		</tbody>
	</table>
	<?php
            if (! empty($erros)) {
                foreach ($erros as $erro) {?>
            <div id="erro-alert" class="alert alert-danger col-sm-12">
               <?php
                    echo $erro;
                }
            }
            ?>
            </div>
            
            <?php
            if (! empty($mensagemGuardado)) {
                foreach ($mensagemGuardado as $mensagem) {?>
            <div id="erro-alert" class="alert alert-success col-sm-12">
               <?php
               echo $mensagem;
                }
            }
            ?>
            </div>
	
</div>
<script type="text/javascript">
function verificarValor() {
  var valor = form_criar_conta.valor_inicial.value;
  var campoValor = document.getElementById('valor');
  
  if (!isNaN(parseFloat(valor)) && isFinite(valor)) {
	  campoValor.setCustomValidity("");
  } else {
	  campoValor.setCustomValidity("Preencha o campo com valor numérico!");
  }
};    
</script>
<?php include_once 'footer.php';?>



