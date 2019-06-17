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
$valorAnterior = isset($_POST['valor-anterior'])? $_POST['valor-anterior'] : null;
$data = isset($_POST['data'])? $_POST['data'] : null;
$id = isset($_POST['id'])? $_POST['id'] : null;
// validação (bem simples, mais uma vez)
if (empty($descricao) || empty($idConta) || empty($idTipoTransacao) || empty($valor) || empty($valorAnterior) || empty($data) || empty($id)) {
    echo "Volte e preencha todos os campos";
    exit;
}
// atualiza a transação
$transacao= new Transacao();
$transacao->setDescricao(utf8_encode($descricao));
$transacao->setIdConta($idConta);
$transacao->setIdTipo($idTipoTransacao);
$transacao->setValor($valor);
$transacao->setData($data);
$transacao->setIdTransacao($id);
var_dump($transacao);
$stmt = $transacao->update();
if ($stmt->rowCount() > 0) {
    if ($valorAnterior != $transacao->getValor()) {
        $conta = new Conta();
        $conta->setIdConta($transacao->getIdConta());
        
        if($valorAnterior > 0 && $transacao->getValor() > 0) {
            $conta->setValorReceita($transacao->getValor() - $valorAnterior);
            var_dump($conta);
            $conta->updateReceita();
            $conta->updateSaldoAtual();  
        } else if ($valorAnterior > 0 && $transacao->getValor() < 0) {
            $conta->setValorReceita(-$valorAnterior);
            $conta->setValorDespesa($transacao->getValor());
            var_dump($conta);
            $conta->updateReceita();
            $conta->updateDespesa();
            $conta->updateSaldoAtual();  
        } else if ($valorAnterior < 0 && $transacao->getValor() > 0) {
            $conta->setValorReceita($transacao->getValor());
            $conta->setValorDespesa(-$valorAnterior);
            var_dump($conta);
            $conta->updateReceita();
            $conta->updateDespesa();
            $conta->updateSaldoAtual(); 
        } else if ($valorAnterior < 0 && $transacao->getValor() < 0) {
            var_dump($conta);
            $conta->setValorDespesa($transacao->getValor() - $valorAnterior);
            var_dump($conta);
            $conta->updateDespesa();
            $conta->updateSaldoAtual(); 
        }
    }
    header('Location: tela-transacao.php');
} else {
    echo "Não houve alterações da Transação.<br>";
    echo "<button onclick=\"window.location.href='tela-transacao.php';\">Voltar</button>";
}
?>
 