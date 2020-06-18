<?php
header('Content-Type: text/html; charset=iso-8859-1');
require_once ("config.php");

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
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

</head>
<body>

<div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Login</div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >
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
                            
                        <form id="loginform" class="form-horizontal" role="form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="Username">                                        
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="senha" placeholder="Password">
                                    </div>
                                    
                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                      <input type="submit" id="btn-login" class="btn btn-success" name="btn-entrar" value="Login"/>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                            Caso não tenha uma conta 
                                        <a href="registar.php" >
                                            Registe-se
                                        </a>
                                        </div>
                                    </div>
                                </div>    
                            </form>     



                        </div>                     
                    </div>  
        </div>
 
    </div>
	
</body>
</html>



    
    