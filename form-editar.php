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
    </head>
 
    <body>
 
        <h1>Editar dados do Banco</h1>
         
<form method="POST" name="form_editar_conta" action="editar-conta.php">
<label>Nome da Conta</label><input type="text" name="nome_conta" value="<?php echo utf8_decode($results[0]['nome']);?>" /><br>
<label>Tipo de Conta</label>
<select name="tipos_conta">
<?php  
var_dump($results[0]['id_tipo_conta']);
foreach ($tipos as $tipo) {
    $idTipoConta = $tipo['id_tipo_conta'];
    $nomeTipoConta = $tipo['nome'];
    ?>
<option value="<?php echo $idTipoConta?>" <?= ($idTipoConta == $results[0]['id_tipo_conta'])? 'selected':''?>><?php echo utf8_decode($nomeTipoConta)?></option>
<!-- O utf8_decode vai servir para permitir carateres especiais -->
<?php }?>
<!-- <option value="<?php //echo $results[0]['id_tipo_conta']?>"><?php //echo utf8_decode($results[0]['tipo'])?></option>-->
</select><br>
<label>Valor inicial da conta</label><input type="text" name="valor_inicial" value="<?php echo utf8_decode($results[0]['valor']);?>"/><br>
<input type="hidden" name="id" value="<?php echo $id ?>">
<input type ="submit" name ="alterar" value="Alterar">
</form>
<button onclick="window.location.href='tela-conta.php';">Voltar</button>
 
    </body>
</html>