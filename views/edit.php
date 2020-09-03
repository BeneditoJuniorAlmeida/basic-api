<?php

require "../_app/Config.inc.php";
$URL = $_GET['usuario_id'];
var_dump($URL);

$daoUsuario = new Usuario();
$daoUsuario->listUser($URL);
echo $usuario = $daoUsuario->getResult();


//$usuario = new Usuario();

//$usuario = $usuario->effect_login(array(Usuario::EMAIL => "leo.widgeon16@gmail.com", Usuario::SENHA => "12345"));

//$usuario = $usuario->listUsuario();
//var_dump($usuario);
?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
        <a class="navbar-brand" href="<?= URL_RAIZ ?>/index.php">CRUD</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation"></button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="<?= URL ?>/views/list.php">Registros</a> <span class="sr-only">(current)</span></a>
                </li>

            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav></br>

    <div class="container">
        <form id="form-user" class="form-validate form-horizontal" method="post">
            <div class="container">

                <div class="form-group">
                    <input type="hidden" class="form-control" name="usuario_id" id="usuario_id" value="<?= $usuario['usuario_id']; ?>" placeholder="Digite seu nome aqui !">
                </div>

                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" name="usuario_nome" id="usuario_nome" value="<?= $usuario['usuario_nome']; ?>" placeholder="Digite seu nome aqui !">
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?= $usuario['email']; ?>" placeholder="Digite seu email aqui !">
                </div>

                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" class="form-control" name="senha" id="senha" value="<?= $usuario['senha']; ?>" placeholder="Digite sua senha aqui !">
                </div>

                <button id="editar" class="btn btn-primary">Cadastrar</button>
            </div>

        </form>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


</body>

<script type="text/javascript">
    $(document).on('click', '#editar', function() {

        var usuario_id = $(this).closest('tr').find('td[data-id]').attr('data-id');
        $.ajax({
            url: "<?= URL ?>/ws/controller-editar.php",
            type: "POST",
            data: "usuario_id=" + usuario_id + "&action=editarUsuario",
            success: function(resultado) {
                alert(resultado);
                /*if (resultado == "success") {
                    alert("Usuario atualizado com sucesso !");
                    document.location.reload(true);
                } else {
                    alert("Erro ao atualizar usuario !");
                }*/
            }
        });
        return false;
    });
</script>

</html>