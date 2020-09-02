<!-- pefil  -->
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
                <h6>Professor</h6>
            </div>
            <div class="col-lg-4 col-sm-4 follow-info">
                <p>Olá, seja bem-vindo!</p>
                <p><i class="fa fa-envelope"></i> <?php echo "<span class='username'>{$info[1]}</span>"; ?></p>
            </div>

            <div class="col-lg-2 col-sm-6 follow-info weather-category">
                <ul>
                    <li class="active">
                        <?php
                        $status = 0;
                        $professorQuestao = new DaoQuestao();
                        $professorQuestao->showUsuarioStatusQuest(array ('usuario_id' => $info[2], 'status' => $status));
                        
                        if ($professorQuestao->getRowCount() > 0) {
                            echo "<i class='fa fa-bell fa-2x'> </i><br> Você submeteu {$professorQuestao->getRowCount()} questão(ões) para análise";
                        } else {
                            echo "<i class='fa fa-bell fa-2x'> </i><br> Não há questão para análise";    
                        }?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>




