<!--modal resposta-->
<div aria-hidden="true"  id="perfil" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Alerta</h4>
            </div>
            <div class="modal-body">
                <div class="col-lg-2">
                    <i class="fa fa-user"></i>
                </div>
                <h5>
                    <?php
                    if (isset($_SESSION['perfil']) && isset($_SESSION['nome'])) {
                        if ($_SESSION['perfil'] == 1) {
                            echo "<span class='username'>{$info[0]} o seu perfil é de administrador</span>";
                        } else if ($_SESSION['perfil'] == 2) {
                            echo "<span class='username'>{$info[0]} o seu perfil é de professor</span>";
                        } else if ($_SESSION['perfil'] == 3) {
                            echo "<span class='username'>{$info[0]} o seu perfil é de colaborador</span>";
                        }
                    }
                    ?>
                </h5>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" data-dismiss="modal" id="confirme">OK</button>
            </div>
        </div>
    </div>
</div>