<?php
header('Content-Type: text/html; charset=iso-8859-1');
require_once ("config.php");
//permitir entrar na página só se estiver logado na sessao
require_once ("config-sessao.php");

$valor = $_POST['valor_inicial'] == "0"?"0.00":$_POST['valor_inicial'];

//Obtem os valores do formulário
$nomeConta = isset($_POST['nome_conta'])? $_POST['nome_conta'] : null;
$idTipoConta = isset($_POST['tipos_conta'])? $_POST['tipos_conta'] : null;
$valorInicial = isset($valor)? $valor : null;
$id = isset($_POST['id'])? $_POST['id'] : null;

// validação para $valorInicial caso seja 0 não ser considerado vazio
if (empty($nomeConta) || empty($idTipoConta) || empty($valorInicial) || empty($id)) {
    echo "Volte e preencha todos os campos";
    exit;
}

// atualiza o banco
$conta= new Conta();
$conta->setNomeConta(utf8_encode($nomeConta));
$conta->setIdTipoConta($idTipoConta);
$conta->setValorInicial($valorInicial);
$conta->setIdConta($id);
$stmt = $conta->update();

if ($stmt->rowCount() > 0) {
    $conta->updateSaldoAtual();
    header('Location: tela-conta.php');
} else {
    echo "Não houve alterações da Conta.<br>";
    echo "<button onclick=\"window.location.href='tela-conta.php';\">Voltar</button>";
}

?>

