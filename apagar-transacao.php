
<?php
header('Content-Type: text/html; charset=iso-8859-1');
require_once ("config.php");
//permitir entrar na página só se estiver logado na sessao
require_once ("config-sessao.php");

// obter o ID da URL
$id = isset($_GET['id']) ? $_GET['id'] : null;
// valida o ID
if (empty($id))
{
    echo "ID não informado";
    exit;
}
// remove da base de dados
$transacao = new Transacao();
$transacao->setIdTransacao($id);
$result = $transacao->getValorById();
$valorTransacao = $result[0]['valor'];
$idConta = $result[0]['id_conta'];
$stmt = $transacao->delete();

if ($stmt->rowCount() > 0) {
    $conta = new Conta();
    $conta->setIdConta($idConta);
    if ($valorTransacao > 0) {
        $conta->setValorReceita(-$valorTransacao);
        $conta->updateReceita();
        $conta->updateSaldoAtual();  
    } else {
        $conta->setValorDespesa(-$valorTransacao);
        $conta->updateDespesa();
        $conta->updateSaldoAtual();  
    }
    header('Location: tela-transacao.php');
} else {
    echo "Erro ao remover";
    exit;
}


?>