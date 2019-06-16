<?php

header('Content-Type: text/html; charset=iso-8859-1');
require_once("config.php");
//permitir entrar na página só se estiver logado na sessao
require_once ("config-sessao.php");
 
$date = new DateTime();

$transacao = new Transacao();
$transacao->setIdUtilizador($_SESSION['id_utilizador']);
$resultContas = $transacao->getContas();
$resultTransacoes = $transacao->getTiposTransacao();

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Criação Conta</title>

<?php include_once 'header.php';?>

<h1>Crie as suas Transações</h1>
 <?php
 if (isset($_POST['criar-transacao'])) {
     $erros = array();
     $descricao = isset($_POST['descricao']) && !empty($_POST['descricao'])? $_POST['descricao'] : null;
     $tipoConta = isset($_POST['contas']) && !empty($_POST['contas'])? $_POST['contas'] : null;
     $tipoTransacao = isset($_POST['tipos_transacao']) && !empty($_POST['tipos_transacao'])? $_POST['tipos_transacao'] : null;
     $valor = isset($_POST['valor']) && !empty($_POST['valor'])? $_POST['valor'] : null;
     $data = isset($_POST['data']) && !empty($_POST['data'])? $_POST['data'] : null;
     
     $validacaoContas = $descricao != null && $tipoConta != null && $tipoTransacao != null && $valor != null && $data != null;
     
 
 if (!$validacaoContas) {
         $erros[] = "<li> Todos os campos precisam ser preenchidos</li>";
     }else{
         $transacao->setDescricao(utf8_encode($descricao));
         $transacao->setIdTipo($tipoTransacao);
         $transacao->setValor($valor);
         $transacao->setIdConta($tipoConta);
         $transacao->setData($data);
         $stmt = $transacao->insert();
 if ($stmt->rowCount() > 0) {
     echo "Gravado com sucesso";
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

<hr>
<form method="POST" name="form_criar_transacao" action="<?php echo $_SERVER['PHP_SELF'];?>">
<label>Descrição da Transação</label><input type="text" name="descricao"/><br>
<label>Banco onde deseja fazer a Transação</label>
<select name="contas">
<?php  
foreach ($resultContas as $result) {
    $idConta = $result['id_conta'];
    ?>
  <option value="<?php echo $idConta?>"><?php echo utf8_decode($result['nome']." - ".$result['tipo_conta'])?></option>
<?php }?>
 </select><br>
<label>Tipo de Transação que deseja efetuar</label>
 <select name="tipos_transacao">
<?php  
foreach ($resultTransacoes as $result) {
    $idTipoTransacao = $result['id_tipo_transacao'];
    ?>
  <option value="<?php echo $idTipoTransacao?>"><?php echo utf8_decode($result['descricao'])?></option>
<?php }?>
 </select><br>
<label>Valor da Transação</label><input type="number" name="valor"/><br>
<label>Data da Transação</label><input type="datetime-local" name="data" value="<?php echo $date->format('Y-m-d\TH:i');?>"/><br>
<input type ="submit" name="criar-transacao" value="Criar Transação">
</form>

<?php include_once 'footer.php';?>