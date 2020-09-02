<header class="header dark-bg">
    <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
    </div>

    <!--logo start-->
    <a href="<?= URL ?>/home"><img id="icone" src="<?= URL ?>/img/icons/gamepi_3.png"></a>
    <!--logo end-->

    <div class="top-nav notification-row">
        <ul class="nav pull-right top-menu">
            <!-- alert notification start-->
            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 1) { ?>
                <li id="alert_notificatoin_bar" class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                    </a>
                    <ul class="dropdown-menu extended notification">
                        <div class="notify-arrow notify-arrow-blue"></div>
                        <li>

                        </li>
                        <li>

                        </li>
                    </ul>
                </li>
            <?php } ?>
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="profile-ava">
                        <img alt="" src="<?= URL ?>/img/default-avatar.png" />
                    </span>
                    <?php
                    if (isset($_SESSION['nome']) && !empty($_SESSION['nome'])) {
                        $info = explode("&", $_SESSION['nome']);
                        echo "<span class='username'>{$info[0]}</span>";
                    }
                    ?>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                    <div class="log-arrow-up"></div>
                    <li class="eborder-top">
                        <a href="#perfil" data-toggle="modal"><i class="icon_profile"></i> Meu perfíl</a>
                    </li>
                    <li>
                        <a href="<?= URL ?>/sobre"><i class="icon_info_alt"></i> Sobre</a>
                    </li>
                    <li>
                        <a href="<?= URL ?>?sair=true"><i class="fa fa-power-off"></i>Logout</a>
                    </li>
                </ul>
            </li>
            <!-- user login dropdown end -->
        </ul>
        <!-- notificatoin dropdown end-->
    </div>
</header>