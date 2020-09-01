<?php

/** 
 * Retorna todos os campos de determinado formulário
 */
function retrieve_fields(){
    return filter_input_array(INPUT_POST, $_POST);
}

/**
 * Verifica se algum arquivo foi selecionado
 * 
 * Retorna booleano 'true' ou 'false'
 */
function check_file(){
    return isset($_FILES['file']) && $_FILES['file']['error'] != 4 ? true : false;
}

/**
 * @gnleo
 * Retorna mensagem de alerta para o usuario, quando a solicitacao de insert/update
 * e recusada por causa de campos obrigatorios nao informados.
 * 
 * $fields -> string no formato "message&campo1|campo2|campo3" e etc
 */
function define_output_for_user(string $fields){
    $campos = explode("&", $fields);
    $campos = explode("|", $campos[1]);
    
    if(sizeof($campos) == 1){
        echo "O campo obrigatório " . (string) $campos[0] . " não foi definido.";
    } else {
        $string = "";
        for($i=0; $i < sizeof($campos); $i++){
            if($i == (sizeof($campos) - 1)){
                $string = substr($string, 0, -2);
                $string .= " e " . $campos[$i] . " ";
            } else{
                $string .= $campos[$i] . ", ";
            }
        }
        echo "Os campos obrigatórios " . $string . " não foram definidos.";
    }
}

/**
 * @gnleo
 * Executa o upload de arquivos e midias
 * Quando executado retorna o path do arquivo criado no servidor
 * 
 * $data é um array associativo de configuração
 * ex: array('file' => $_FILES['file'], Equipe::ID => "1")
 */
function upload_file(array $data){
    $path = __DIR__;
    $path = explode("_", $path);

    // tipos de arquivos aceitos
    $extensoes = '/^.+(\.jpeg|\.jpg|\.png|\.mp3|\.mp4|\.docx|\.pdf)$/';
    
    // verifica se é um arquivo aceito
    $check_result = preg_match($extensoes, $data['file']['name']);
    if($check_result){
        //verifica tipo de arquivo
        $type = explode("/", $data['file']['type']);
        //recupera o tipo de extensão do arquivo
        $extensoes = explode('.', $data['file']['name']);
        //renomeia arquivo - evita duplicação de arquivo
        $data['file']['name'] = md5($data['file']['name'].date('Y/m/d H:m:s')) . '.' . $extensoes[1];
        // verifica e cria diretório de uploads da equipe
        if(!file_exists($path[0] . PATH_UPLOAD . $data[Equipe::ID])){
            mkdir($path[0] . PATH_UPLOAD . $data[Equipe::ID], 0777);
        }
        
        if($type[0] == 'image'){
            if(!file_exists($path[0] . PATH_UPLOAD . $data[Equipe::ID] . PATH_IMAGE)){
                mkdir($path[0] . PATH_UPLOAD . $data[Equipe::ID] . PATH_IMAGE, 0777);
            }   
            // cria arquivo no servidor
            move_uploaded_file($data['file']['tmp_name'], $path[0] . PATH_UPLOAD . $data[Equipe::ID] . PATH_IMAGE . $data['file']['name']);
            
            return PATH_UPLOAD . $data[Equipe::ID] . PATH_IMAGE . $data['file']['name'];
        } elseif($type[0] == 'video'){
            // verifica e cria diretório de video se este não existir
            if(!file_exists($path[0] . PATH_UPLOAD . $data[Equipe::ID] . PATH_VIDEO)){
                mkdir($path[0] . PATH_UPLOAD . $data[Equipe::ID] . PATH_VIDEO, 0777);
            }
            // cria arquivo no servidor
            move_uploaded_file($data['file']['tmp_name'], $path[0] . PATH_UPLOAD . $data[Equipe::ID] . PATH_VIDEO . $data['file']['name']);
            
            return PATH_UPLOAD . $data[Equipe::ID] . PATH_VIDEO . $data['file']['name'];
        } else{
            // verifica e cria diretório de video se este não existir
            if(!file_exists($path[0] . PATH_UPLOAD . $data[Equipe::ID] . PATH_ARQUIVO)){
                mkdir($path[0] . PATH_UPLOAD . $data[Equipe::ID] . PATH_ARQUIVO, 0777);
            }
            // cria arquivo no servidor
            move_uploaded_file($data['file']['tmp_name'], $path[0] . PATH_UPLOAD . $data[Equipe::ID] . PATH_ARQUIVO . $data['file']['name']);
            
            return PATH_UPLOAD . $data[Equipe::ID] . PATH_ARQUIVO . $data['file']['name'];
        }
    } else{
        return FALSE;
    }
}

/**
 * @gnleo
 * Retorna o tamanho do diretório em mega bytes
 */
function get_directory_size($path){
    $bytestotal = 0;
    $path = realpath($path);
    if($path !== false){
        foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $object){
            $bytestotal += $object->getSize();
        }
    }
    return $bytestotal / 1000000;
}

/**
 * @gnleo
 * Fatora uma data para cadastro no banco de dados
 * 
 * Retorna uma string no fomarto 'Y-m-d'
 */
function date_for_bd($date){
    $separador = explode("-", $date);
    if(count($separador) != 3){
        return $date;
    }
    $date_bd = "{$separador[2]}-{$separador[1]}-{$separador[0]}";
    return $date_bd;
}

/**
 * @gnleo
 * Fatora uma data para exibição em front-end
 * 
 * Retorna uma string no formato 'd-m-Y'
 */
function date_for_exibition($date){
    $separador = explode("-", $date);
    if(count($separador) != 3){
        return $date;
    }
    $date_exibition = "{$separador[2]}-{$separador[1]}-{$separador[0]}";
    return $date_exibition;
}

/**
 * @lacy
 * Fatora data e hora para exibição em front-end
 * 
 * 'Y-m-d H:i:s'
 * Retorna uma string no formato 'd-m-Y H:i:s'
 */
function date_hora_for_exibition($date){
    $separador = explode(" ", $date);
    if(count($separador) != 2):
        return $date;
    else:
        $data = explode('-', $separador[0]);
        if(count($data) != 3):
            return $data;
        endif;

        $date_hora_exibition = 'Em {$data[2]}-{$data[1]}-{$data[0]} às {$separador[1]}';
        return $date_hora_exibition;
    endif;
}
