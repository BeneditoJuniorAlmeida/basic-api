<!-- perfil assunto -->
<div class="col-lg-12">
    <div class="profile-widget profile-widget-info">
        <div class="panel-body">
            <div class="col-lg-2 col-sm-2">
                <h4>
                    <?php echo "<span class='username'>{$info[0]}</span>"; ?>
                </h4>
                <div class="follow-ava">
                    <img alt="" src="<?= URL ?>/img/default-avatar-big.png"/>
                </div>
                <h6>Administrador</h6>
            </div>
            <div class="col-lg-4 col-sm-4 follow-info">
                <p>Olá, seja bem-vindo!</p>
                <p><i class="fa fa-envelope"></i> <?php echo "<span class='username'>{$info[1]}</span>"; ?></p>
            </div>

            <div class="col-lg-2 col-sm-6 follow-info weather-category">
                <ul>
                    <li class="active">
                        <?php
                        if ($statusAssunto->getRowCount() > 0) {
                            echo "<i class='fa fa-bell fa-2x'> </i><br> Você tem {$statusAssunto->getRowCount()} novo(s) assunto(s) aguardando análise";
                        } else {
                            echo "<i class='fa fa-bell fa-2x'> </i><br> Não há assuntos para análise";    
                        }
                            ?>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>

