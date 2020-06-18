<?php
header('Content-Type: text/html; charset=iso-8859-1');
require_once ("config.php");
// permitir entrar na p�gina s� se estiver logado na sessao
require_once ("config-sessao.php");

$date = new DateTime();

$idUtilizador = $_SESSION['id_utilizador'];
$transacao = new Transacao();
$transacao->setIdUtilizador($idUtilizador);
$resultContas = $transacao->getContas();
$resultTransacoes = $transacao->getTiposTransacao();

$conta = new Conta();
$conta->setIdUtilizador($idUtilizador);
$count = $conta->countRows();
$total = $count[0]['total'];

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Cria��o Transa��o</title>

<link
	href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css"
	rel="stylesheet" id="bootstrap-css">
<script
	src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script
	src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php include_once 'header.php';?>


 <?php
if ($total > 0) {
    if (isset($_POST['criar-transacao'])) {
        $erros = array();
        $mensagemGuardado = array();
        $descricao = isset($_POST['descricao']) && ! empty($_POST['descricao']) ? $_POST['descricao'] : null;
        $tipoConta = isset($_POST['contas']) && ! empty($_POST['contas']) ? $_POST['contas'] : null;
        $tipoTransacao = isset($_POST['tipos_transacao']) && ! empty($_POST['tipos_transacao']) ? $_POST['tipos_transacao'] : null;
        $valor = isset($_POST['valor']) && ! empty($_POST['valor']) ? $_POST['valor'] : null;
        $data = isset($_POST['data']) && ! empty($_POST['data']) ? $_POST['data'] : null;

        $validacaoTransacao = $descricao != null && $tipoConta != null && $tipoTransacao != null && $valor != null && $data != null;

        if (! $validacaoTransacao) {
            $erros[] = "<li> Todos os campos precisam ser preenchidos</li>";
        } else {
            $transacao->setDescricao(utf8_encode($descricao));
            $transacao->setIdTipo($tipoTransacao);
            $transacao->setValor($valor);
            $transacao->setIdConta($tipoConta);
            $transacao->setData($data);
            $stmt = $transacao->insert();
            if ($stmt->rowCount() > 0) {

                if ($transacao->getIdTipo() == 1) {
                    $conta = new Conta();
                    $conta->setIdConta($transacao->getIdConta());
                    $conta->setValorReceita($transacao->getValor());
                    $conta->updateReceita();
                    $conta->updateSaldoAtual();
                } else {
                    $conta = new Conta();
                    $conta->setIdConta($transacao->getIdConta());
                    $conta->setValorDespesa($transacao->getValor());
                    $conta->updateDespesa();
                    $conta->updateSaldoAtual();
                }

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
<center><h1>Crie as suas Transa��es</h1></center>
	<table class="table table-striped">
		<tbody>
			<tr>
				<td colspan="1">
					<form class="well form-horizontal" method="POST" name="form_criar_transacao"
	action="<?php echo $_SERVER['PHP_SELF'];?>">
	
						<fieldset>
							<div class="form-group">
								<label class="col-md-4 control-label">Descri��o da Transa��o</label>
								<div class="col-md-8 inputGroupContainer">
									<div class="input-group">
										<span class="input-group-addon"></span><input
											id="descricao" name="descricao"
											placeholder="" class="form-control"
											required="true" value="" type="text">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Banco onde deseja fazer a
									Transa��o</label>
								<div class="col-md-8 inputGroupContainer">
									<div class="input-group">
										<span class="input-group-addon"></span> <select
											class="selectpicker form-control" name="contas">
                                                                           <?php
                                                                        foreach ($resultContas as $result) {
                                                                            $idConta = $result['id_conta'];
                                                                            ?>
											<option value="<?php echo $idConta?>"><?php echo utf8_decode($result['nome']." - ".$result['tipo_conta'])?></option>
												<?php }?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Tipo de Transa��o que
									deseja efetuar</label>
								<div class="col-md-8 inputGroupContainer">
									<div class="input-group">
										<span class="input-group-addon"></span> <select
											class="selectpicker form-control" name="tipos_transacao">
                                                                           <?php
                                                                        foreach ($resultTransacoes as $result) {
                                                                            $idTipoTransacao = $result['id_tipo_transacao'];
                                                                            ?>
                                              <option
												value="<?php echo $idTipoTransacao?>"><?php echo utf8_decode($result['descricao'])?></option>
                                            <?php }?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Valor da Transa��o</label>
								<div class="col-md-8 inputGroupContainer">
									<div class="input-group">
										<span class="input-group-addon"></span><input
											id="id-valor" name="valor" placeholder=""
											class="form-control" required="true" value="" type="text">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Data da Transa��o</label>
								<div class="col-md-8 inputGroupContainer">
									<div class="input-group">
										<span class="input-group-addon"></span><input
											id="id-valor" name="data"
											class="form-control" required 
											type="datetime-local"
											value="<?php echo $date->format('Y-m-d\TH:i');?>">
									</div>
								</div>
							</div>
							<input type="submit" name="criar-transacao" class="btn btn-success"
								onclick="verificarValor();" value="Criar Transa��o">
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


<?php } else { ?>
 
        <p>Crie uma Conta para criar as suas Transa��es</p>
 
        <?php } ?>
<script type="text/javascript">
function verificarValor() {
  var valor = form_criar_transacao.valor.value;
  var campoValor = document.getElementById('id-valor');
  
  if (!isNaN(parseFloat(valor)) && isFinite(valor) && valor > 0.00) {
	  campoValor.setCustomValidity("");
  } else {
	  campoValor.setCustomValidity("Preencha o campo com valores num�ricos superiores a 0!");
  }
};    
</script>

<?php include_once 'footer.php';?>

