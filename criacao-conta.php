<?php 
header('Content-Type: text/html; charset=iso-8859-1');
require_once("config.php");
//permitir entrar na página só se estiver logado na sessao
require_once ("config-sessao.php");
 
$conta = new Conta();
$results = $conta->getListTipoConta();
if (isset($_POST['criar-conta'])) {
    $erros = array();
    $nomeConta = isset($_POST['nome_conta']) && !empty($_POST['nome_conta'])? $_POST['nome_conta'] : null;
    $idTipoConta = isset($_POST['tipos_conta']) && !empty($_POST['tipos_conta'])? $_POST['tipos_conta'] : null;
    $valorInicial = isset($_POST['valor_inicial']) && !empty($_POST['valor_inicial'])? $_POST['valor_inicial'] : null;
    
    $validacao = $nomeConta != null && $idTipoConta != null && $valorInicial != null;
    
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Criação Conta</title>

<?php include_once 'header.php';?>

<h1>Insira a sua Conta Bancária</h1>
 <?php
 if (isset($_POST['criar-conta'])) {
     
     if (!$validacao) {
         $erros[] = "<li> Todos os campos precisam ser preenchidos</li>";
     }else{
         $conta->setNomeConta(utf8_encode($nomeConta));
         $conta->setIdTipoConta($idTipoConta);
         $conta->setValorInicial($valorInicial);//(double)
         $conta->setIdUtilizador($_SESSION['id_utilizador']);
         $stmt = $conta->insert();
 if ($stmt->rowCount() > 0) {
     echo "Gravado com sucesso";
     //$_POST['nome_conta'] = null;
     //$_POST['tipos_conta']= null;
     //$_POST['valor_inicial'] = null;
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
<form method="POST" name="form_criar_conta" action="<?php echo $_SERVER['PHP_SELF'];?>">
<label>Nome da Conta</label><input type="text" name="nome_conta"/><br>
<label>Tipo de Conta</label>
<select name="tipos_conta">
<?php  
foreach ($results as $result) {
    $idTipoConta = $result['id_tipo_conta'];
    ?>
<option value="<?php echo $idTipoConta?>"><?php echo utf8_decode($result['nome'])?></option>
<!-- O utf8_decode vai servir para permitir carateres especiais -->
<?php }?>
</select><br>
<label>Valor inicial da conta</label><input type="text" name="valor_inicial"/><br>
<input type ="submit" name="criar-conta" value="Criar Conta"><!-- não pode colocar o name com _  exemplo:criar_conta -->
</form>
<?php include_once 'footer.php';?>









