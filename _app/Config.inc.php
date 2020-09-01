<?php

date_default_timezone_set('America/Sao_Paulo');

// CONFIGURACOES DO SITE
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBSA', 'api');

// TAG'S DE CONTROLE
define('TAG_SUCCESS', 'success');
define('TAG_ERROR', 'error');
define('TAG_MESSAGE', 'message');
define('TAG_WARNING', 'warning');
define('TAG_ACTION', 'acao');
define('TAG_ADMIN', 'admin');
define('TAG_CLIENT', 'client');

//CONFIGURAÇÕES DO WEBSERVICE
define ('API_NAME', 'api_name');
define ('API_PARAMS', 'api_params');
define ('API_RESPONSE_CODE', 'response_code');
define ('API_RESULT', 'result');

// CONSTANTES DA APLICACAO
define('URL', 'http://localhost/basic-api');
define('URL_RAIZ', '/basic-api');
define('URL_LOGO', URL . "resources/imgs/Logo1.png");
define('NAME_SYSTEM', 'bitEdu');
define('EMAIL_SYSTEM', '');
define('PASSWORD_EMAIL_SYSTEM', '');
define('PATH_UPLOAD', 'uploads/team-');
define('PATH_ARQUIVO', '/arq/');
define('PATH_IMAGE', '/image/');
define('PATH_VIDEO', '/video/');

// AUTO LOAD DO ARQUIVO HELPERS 
require "helpers/arq_helpers.php";

// AUTO LOAD DE CLASSES
spl_autoload_register(function ($Class) {
    $cDir = ['api', 'database', 'helpers', 'library/phpMailer', 'models', 'models/entity'];
    $iDir = null;

    foreach ($cDir as $dirName):
        if (!$iDir && file_exists(__DIR__ . DIRECTORY_SEPARATOR . "{$dirName}" . DIRECTORY_SEPARATOR . "{$Class}.php") && !is_dir(__DIR__ . DIRECTORY_SEPARATOR . "{$dirName}" . DIRECTORY_SEPARATOR . "{$Class}.php")):

            include_once (__DIR__ . DIRECTORY_SEPARATOR . "{$dirName}" . DIRECTORY_SEPARATOR . "{$Class}.php");
            $iDir = true;

        endif;
    endforeach;

    if (!$iDir):
        trigger_error("Não foi possível incluir {$Class}.php", E_USER_ERROR);
        die;
    endif;
});

// A K N N -> array keys not null
define('USUARIO_A_K_N_N', array(Usuario::NOME, Usuario::EMAIL, Usuario::SENHA));
// define('USUARIO_LOGIN_A_K_N_N', array(Usuario::EMAIL, Usuario::SENHA));
// define('_A_K_N_N', array());