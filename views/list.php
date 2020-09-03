<?php
require "../_app/Config.inc.php";
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
        <a class="navbar-brand" href="<?= URL ?>/index.php">CRUD</a>
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
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <?php


            $usuario = new Usuario();
            $users = $usuario->listUsuarios();
            $user = (array) $users;
            foreach ($user as $user) {
            ?>
                <tbody>
                    <td data-id="<?= $user['usuario_id'] ?>"> <?= $user['usuario_id'] ?></td>
                    <td> <?= $user['usuario_nome'] ?></td>
                    <td><?= $user['email'] ?></td>

                    <td> <a name="editar" id="editar" class="btn btn-primary" role="button" href="<?=URL?>/views/edit.php?usuario_id=<?=$user['usuario_id']?>"><i class="icon-fixed-width icon-pencil">Editar</i></a></td>
                    <td> <a name="excluir" id="excluir" class="btn btn-danger" role="button"><i class="icon-trash icon-large"></i> Excluir</a></a></td>

                </tbody>
            <?php } ?>
        </table>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>

<script type="text/javascript">
    

 $(document).on('click', '#excluir', function() {

        var usuario_id = $(this).closest('tr').find('td[data-id]').attr('data-id');
        $.ajax({
            url: "<?= URL ?>/ws/controller-excluir.php",
            type: "POST",
            data: "usuario_id=" + usuario_id + "&action=excluirUsuario",
            success: function(resultado) {
                if (resultado == "success") {
                    alert("Usuario excluido com sucesso !");
                    document.location.reload(true);
                } else {
                    alert("Erro ao excluir usuario !");
                }
            }
        });
        return false;
    });
</script>

</html>