
<?php
header('Content-Type: text/html; charset=iso-8859-1');
require_once ("config.php");
//permitir entrar na p�gina s� se estiver logado na sessao
require_once ("config-sessao.php");

// obter o ID da URL
$id = isset($_GET['id']) ? $_GET['id'] : null;
// valida o ID
if (empty($id))
{
    echo "ID n�o informado";
    exit;
}
// remove do banco
$transacao = new Transacao();
$transacao->setIdUtilizador($id);
$stmt = $transacao->delete();
if ($stmt->rowCount() > 0) {
    header('Location: tela-transacao.php');
} else {
    echo "Erro ao remover";
    exit;
}


?>