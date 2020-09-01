<?php

require "./_app/Config.inc.php";

$usuario = new Usuario();

$usuario = $usuario->effect_login(array(Usuario::EMAIL => "leo.widgeon16@gmail.com", Usuario::SENHA => "12345"));

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
    <form id="form-user" class="form-validate form-horizontal" method="post">
        <div class="container">

            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" name="nome" id="nome" aria-describedby="helpId" placeholder="Digite seu nome aqui !">
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" placeholder="Digite seu email aqui !">
            </div>

            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" name="senha" id="senha" placeholder="Digite sua senha aqui !">
            </div>

            <button id="cadastrar" class="btn btn-primary">Cadastrar</button>
        </div>

    </form>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


</body>

<script type="text/javascript">
  $(document).ready(function() {
        var working = false;
        $("#cadastrar").on("click", function() {
            $('#form-user').submit(function(e) {
                e.preventDefault();
                if ($("#nome").val() != "" && $("#email").val() != "" && $("#senha").val()) {         
                    setTimeout(function() {
                        $.ajax({
                            url: "<?= URL ?>/ws/controller-formulario.php",
                            type: "POST",
                            data: $("#form-user").serialize() + "&action=addUsuario",
                            success: function(resultado) {                              
                             /*   if (resultado == "error") {
                                    $this.find('button').removeAttr("disabled");
                                    $this.removeClass('ok loading');
                                    working = false;
                                    spinner.removeClass('spinner');
                                    $state.html('Cadastrar');
                                    spinner.removeClass('spinner');
                                    $("#erro").html("Não foi possível realizar esta operação!");
                                    $("#modalErro").modal("show");
                                } else if (resultado == "success") {
                                    $this.find('button').removeAttr("disabled");
                                    $this.removeClass('ok loading');
                                    working = false;
                                    spinner.removeClass('spinner');
                                    $state.html('Cadastrar');
                                    spinner.removeClass('spinner');
                                    $("#msgSucessoQuiz").html("Jogador cadastrado com sucesso!");
                                    $("#modalQuiz").modal("show");
                                }*/
                            }
                        });
                    }, 2000);
                } else {
                    alert("Preencha os campos solicitados!");
                   /* $("#aviso").html("Preencha os campos solicitados!");
                    $("#modalAviso").modal("show");*/
                }
            });
        });
    });


</script>

</html>