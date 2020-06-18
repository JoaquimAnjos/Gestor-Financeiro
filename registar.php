<?php 
header('Content-Type: text/html; charset=iso-8859-1');
require_once("config.php");

if (isset($_POST['registar'])) {
    $erros = array();
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
    }else{
        $erros[] = "<li> Favor preencher os dados </li>";
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
     <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
 </head>
 <body>
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
<div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Registe-se</div>
                            <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="index.php">Login</a></div>
                        </div>  
                        <div class="panel-body" >
                         	<?php
                                if (! empty($erros)) {
                                    foreach ($erros as $erro) {?>
                                <div id="login-alert" class="alert alert-danger col-sm-12">
                                   <?php
                                        echo $erro;
                                        
                                    }
                                }
                                ?>
                                </div>
                            <form id="signupform" class="form-horizontal" role="form" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                                
                                <div class="form-group">
                                    <label for="nome" class="col-md-3 control-label">Nome</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="nome" required placeholder="Nome">
                                    </div>
                                </div>
                                    
                                <div class="form-group">
                                    <label for="username" class="col-md-3 control-label">Username</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="username" required placeholder="Username">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control" name="email" required placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-md-3 control-label">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="senha" required placeholder="Password">
                                    </div>
                                </div>
                                    
                                <div class="form-group">
                                    <!-- Button -->                                        
                                    <div class="col-md-offset-3 col-md-9">
                                     	<a href="index.php" class="btn btn-info">Cancelar</a>
                                        <input id="btn-signup" type="submit" class="btn btn-info" name="registar" value="Registar"/> 
                                    </div>
                                </div>
                                
                            </form>
                         </div>
                    </div>
         </div> 
 </body>
 </html>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
        