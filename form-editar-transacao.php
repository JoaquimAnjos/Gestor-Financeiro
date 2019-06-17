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
$dadosConta = $conta->getContaParaEditar();

?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
 
        <title>Editar Transação</title>
        
<?php include_once 'header.php';?>
 
        <h1>Editar dados da Transição</h1>
         
<form method="POST" name="form_editar_transacao" action="editar-transacao.php">
<label>Descrição da transação</label>
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
<label>Tipo de Transação</label>
<select name="tipos_transacao">
<?php  
foreach ($tiposTransacao as $tipoTransacao) {
    $idTipoTransacao = $tipoTransacao['id_tipo_transacao'];
    $descricaoTransacao = $tipoTransacao['descricao'];
    ?>
<option value="<?php echo $idTipoTransacao?>" <?= ($idTipoTransacao == $results[0]['id_tipo_transacao'])? 'selected':''?>><?php echo utf8_decode($descricaoTransacao)?></option>
<?php }?>
</select><br>

<label>Valor da Transação</label><input type="text" name="valor" value="<?php echo utf8_decode($results[0]['valor']);?>"/><br>
<input type="hidden" name="valor-anterior" value="<?php echo utf8_decode($results[0]['valor']);?>"/>
<label>Data da Transação</label><input type="datetime-local" name="data" value="<?php echo $date->format('Y-m-d\TH:i');?>"/><br>
<input type="hidden" name="id" value="<?php echo $id ?>">
<input type ="submit" name ="alterar" value="Alterar">
</form>
<button onclick="window.location.href='tela-transacao.php';">Voltar</button>
 
<?php include_once 'footer.php';?>