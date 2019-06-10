<?php 
header('Content-Type: text/html; charset=iso-8859-1');
require_once("config.php");

if (isset($_POST['registar'])) {
    $nome = isset($_POST['nome']) && ! empty($_POST['nome']) ? $_POST['nome'] : null;
    $username = isset($_POST['username']) && ! empty($_POST['username']) ? $_POST['username'] : null;
    $email = isset($_POST['email']) && ! empty($_POST['email']) ? $_POST['email'] : null;
    $senha = isset($_POST['senha']) && ! empty($_POST['senha']) ? $_POST['senha'] : null;

    $validacao = $nome != null && $username != null && $email != null && $senha != null;
    if ($validacao) {
        $utilizador = new Utilizador();
        $utilizador->setNome($nome);
        $utilizador->setUsername($username);
        $utilizador->setEmail($email);
        $utilizador->setSenha(md5($senha));
    }
}

?>


 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Cadastro</title>
 </head>
 <body>
 <h1>Registe-se:</h1>
 <?php
if (isset($_POST['registar'])) {
    if ($validacao) {
        $stmt = $utilizador->insert($utilizador);
        if ($stmt->rowCount() > 0) {
            header('Location: login.php');
        } else {
            echo "Erro ao registar-se!";
        }
    }
}
?>
<hr>
 <form method="POST" name="signup" action="<?php echo $_SERVER['PHP_SELF'];?>">
 <label>Nome: </label><input type="text" name="nome" />
 <label>Username:</label><input type="text" name="username" />
 <label>Email:</label> <input type="email" name="email" />
 <label>Senha:</label> <input type="password" name="senha" /><br>
 <input type="submit" name="registar" value="Registar"/>
 </form>
 <button onclick="window.location.href='index.php';">Voltar</button>
     
 </body>
 </html>