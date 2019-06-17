<?php
header('Content-Type: text/html; charset=iso-8859-1');
require_once ("config.php");
//permitir entrar na página só se estiver logado na sessao
require_once ("config-sessao.php");


//Obtem os valores do formulário
$descricao = isset($_POST['descricao'])? $_POST['descricao'] : null;
$idConta = isset($_POST['contas'])? $_POST['contas'] : null;
$idTipoTransacao = isset($_POST['tipos_transacao'])? $_POST['tipos_transacao'] : null;
$valor = isset($_POST['valor'])? $_POST['valor'] : null;
$data = isset($_POST['data'])? $_POST['data'] : null;
$id = isset($_POST['id'])? $_POST['id'] : null;
// validação (bem simples, mais uma vez)
if (empty($descricao) || empty($idConta) || empty($idTipoTransacao) || empty($valor) || empty($data) || empty($id)) {
    echo "Volte e preencha todos os campos";
    exit;
}
echo $descricao."<br>";
echo $idConta."<br>";
echo $idTipoTransacao."<br>";
echo $valor."<br>";
echo $data."<br>";
echo $id."<br>";
// atualiza a transação
$transacao= new Transacao();
$transacao->setDescricao(utf8_encode($descricao));
$transacao->setIdConta($idConta);
$transacao->setIdTipo($idTipoTransacao);
$transacao->setValor(abs($valor));
$transacao->setData($data);
$transacao->setIdTransacao($id);
$stmt = $transacao->update();
if ($stmt->rowCount() > 0) {
    header('Location: tela-transacao.php');
} else {
    echo "Não houve alterações da Transação.<br>";
    echo "<button onclick=\"window.location.href='tela-transacao.php';\">Voltar</button>";
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body></body>
</html>    