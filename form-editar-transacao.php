<?php
header('Content-Type: text/html; charset=iso-8859-1');
require_once ("config.php");
//permitir entrar na p�gina s� se estiver logado na sessao
require_once ("config-sessao.php");


//Pega ID da URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
//Valida ID
if (empty($id)) {
    echo "ID para altera��o n�o definido.";
    exit;
}

$transacao = new Transacao();
$transacao->setIdTransacao($id);
$conta = new Conta();
$conta->setIdUtilizador($_SESSION['id_utilizador']);
$results = $transacao->loadById();
$date = new DateTime($results[0]['data_transacao']);
//Se o m�todo fetch n�o retornar um array, significa que o ID n�o � de uma transacao v�lido
if (!is_array($results)) {
    echo "Nenhuma transacao encontrada!";
    exit;
}
$tiposTransacao = $transacao->getTiposTransacao();
$dadosConta = $conta->getContaParaEditar();

?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
 
        <title>Editar Transa��o</title>
        
<?php include_once 'header.php';?>
 
        <h1>Editar dados da Transi��o</h1>
         
<form method="POST" name="form_editar_transacao" action="editar-transacao.php">
<label>Descri��o da transa��o</label>
<input type="text" name="descricao" value="<?php echo utf8_decode($results[0]['descricao']);?>" /><br>
 <!--<label>Conta</label>-->
<!--  <select name="contas">-->
<?php  
/*foreach ($dadosConta as $dadoConta) {
    $idConta = $dadoConta['id_conta'];
    $nomeConta = $dadoConta['conta'];
    */?>
<!--<option value="<?php //echo $idConta?>" <?php //=($idConta == $results[0]['id_conta'])? 'selected':''?>><?php //echo utf8_decode($nomeConta)?></option>-->
<?php //}?>
<!-- </select><br> -->
<label>Tipo de Transa��o</label>
<select name="tipos_transacao">
<?php  
foreach ($tiposTransacao as $tipoTransacao) {
    $idTipoTransacao = $tipoTransacao['id_tipo_transacao'];
    $descricaoTransacao = $tipoTransacao['descricao'];
    ?>
<option value="<?php echo $idTipoTransacao?>" <?= ($idTipoTransacao == $results[0]['id_tipo_transacao'])? 'selected':''?>><?php echo utf8_decode($descricaoTransacao)?></option>
<?php }?>
</select><br>

<label>Valor da Transa��o</label><input type="text" name="valor" value="<?php echo utf8_decode($results[0]['valor']);?>"/><br>
<input type="hidden" name="valor-anterior" value="<?php echo utf8_decode($results[0]['valor']);?>"/>
<label>Data da Transa��o</label><input type="datetime-local" name="data" value="<?php echo $date->format('Y-m-d\TH:i');?>"/><br>
<input type="hidden" name="id" value="<?php echo $id ?>">
<input type ="submit" name ="alterar" value="Alterar">
</form>
<button onclick="window.location.href='tela-transacao.php';">Voltar</button>
 
<?php include_once 'footer.php';?>