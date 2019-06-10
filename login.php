<?php
header('Content-Type: text/html; charset=iso-8859-1');
require_once ("config.php");

// botão enviar
if (isset($_POST['btn-entrar'])) {
    $erros = array();
    $username = $_POST['username'];
    $senha = $_POST['senha'];

    if (empty($username) || empty($senha)) {
        $erros[] = "<li> O campo login/senha precisa ser preenchido </li>";
    } else {
        $utilizador = new Utilizador();
        $results = $utilizador->loadByUsername($username);

        if (count($results) > 0) {

            $results = $utilizador->login($username, $senha);

            if (count($results) == 1) {
                $dados = $results;
                $_SESSION['logado'] = true;
                $_SESSION['id_utilizador'] = $dados[0]['id_utilizador'];
                $_SESSION['nome'] = $dados[0]['nome'];
                header('Location: home.php');
            } else {
                $erros[] = "<li> Utilizador e/ou senha inválido </li>";
            }
        } else {
            $erros[] = "<li> Utilizador inexistente </li>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Login</title>
</head>
<body>
	<h1>Login</h1>
	<?php
if (! empty($erros)) {
    foreach ($erros as $erro) {
        echo $erro;
    }
}
?>
	<hr>
	<form name="login_form" method="POST"
		action="<?php echo $_SERVER['PHP_SELF'];?>">
		<label>Username: </label> <input type="text" name="username"><br> 
		<label>Password:</label> <input type="password" name="senha"><br> 
		<input type="submit" name="btn-entrar" value="Entrar"> 
		<a href="cadastro.php">Registe-se</a>

	</form>
</body>
</html>