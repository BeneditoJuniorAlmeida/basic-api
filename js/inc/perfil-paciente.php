<!-- profil de disciplina -->
<div class="col-lg-12">
    <div class="profile-widget profile-widget-info">
        <div class="panel-body">
            <div class="col-lg-2 col-sm-2">
                <h4>
                    <?php echo "<span class='username'>{$info[0]}</span>"; ?>
                </h4>
                <div class="follow-ava">
                    <img alt="" src="<?= URL ?>/img/default-avatar-big.png" />
                </div>
                <h6>
                    <?php if ($_SESSION['perfil'] == 1) {
                        echo "Administrador";
                    } else if ($_SESSION['perfil'] == 2) {
                        echo "Usuario";

                    }?>
                </h6>
            </div>
            <div class="col-lg-4 col-sm-4 follow-info">
                <p>Olá, seja bem-vindo!</p>
                <p><i class="fa fa-envelope"></i> <?php echo "<span class='username'>{$info[1]}</span>"; ?></p>
            </div>

            <div class="col-lg-2 col-sm-6 follow-info weather-category">
                <ul>
                    <li class="active">
                        <?php
                        $paciente = new DaoPaciente();
                        $paciente->readPaciente();
                        if ($paciente->getRowCount() > 0) {
                            echo "<i class='fa fa-flag fa-2x'> </i><br> O sistema apresenta um total de {$paciente->getRowCount()} paciente(s) cadastrados";
                        } else {
                            echo "<i class='fa fa-bell fa-2x'> </i><br> Não há pacientes cadastrados";
                        }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
        <?php
        if (isset($_SESSION['update']) && !empty($_SESSION['update'])) {
            echo "<button id='btn-update' class='btn btn-primary' data-url='" . URL . "/apostila'>Atualizar</button>";
        }
        ?>
    </div>
</div>