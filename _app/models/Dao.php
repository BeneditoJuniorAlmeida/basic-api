<?php

/**
 * author: @gnleo
 */

class Dao {

    var $result;
    
    public function getResult(){
        return $this->result;
    }

    public function setResult(){
        $this->result = null;
    }
    

    /**
     * Executa uma operação create no banco de dados
     * Inicializa um novo registro na ENTIDADE
     * 
     * $entidade -> recebe o nome da tabela onde será executada a operação
     * $obj -> recebe uma instância de objeto da tabela
     */
    public function create(string $entidade, $obj){
        $dados_objeto = (array) $obj;

        // retira primeiro elemento do array -> atributo 'id'
        array_shift($dados_objeto);
        // retira último elemento do array -> atributo 'result'
        array_pop($dados_objeto);

        $delimiter = $this->control_entity_for_explode($entidade);

        foreach ($dados_objeto as $key => $value) {
            if(!empty($value)){
                $chave = explode($delimiter, $key);
                $dados[trim($chave[1])] = $value;
            }
        }


        $create = new Create();
        $create->ExeCreate($entidade, $dados);
        $this->result = $create->getResult();
    }


    /**
     * Executa uma operação update no banco de dados
     * Atualiza um registro específico da ENTIDADE
     * 
     * $entidade -> recebe o nome da tabela onde será executada a operação
     * $obj -> recebe uma instância de objeto da tabela
     */
    public function update(string $entidade, $obj){
        $dados_objeto = (array) $obj;
        // retira último elemento do array -> atributo 'result'
        array_pop($dados_objeto);
        $delimiter = $this->control_entity_for_explode($entidade);

        foreach ($dados_objeto as $key => $value) {
            if(!empty($value)){
                $chave = explode($delimiter, $key);

                if(trim($chave[1]) == $entidade."_id"){
                    $id = $value;
                } else{
                    if(isset($chave[1])){
                        $dados[trim($chave[1])] = $value;
                    }
                }
            }
        }

        $update = new Update();
        // ':aid' é um link simbolico
        $update->ExeUpdate($entidade, $dados, "WHERE ".$entidade."_id = :aid", "aid={$id}");
        $this->result = $update->getResult();
    }

    
    /**
     * Executa uma operação read no banco de dados
     * Retorna todos os registros da ENTIDADE
     * 
     * $entidade -> recebe o nome da tabela que será consultada
     */
    public function list(string $entidade){
        $list = new Read();
        $list->ExeRead($entidade);
        $this->result = $list->getResult();
     
    }


    /**
     * Executa uma operação read personalizada no banco de dados
     * Retorna todos os atributos do registro consultado
     * 
     * $entidade -> recebe o nome da tabela que será consultada
     * $where -> recebe o SQL da consulta
     * $params -> recebe um array que especifica os atributos que definem a sequência de análise
     * 
     * Ex1:  $where = "where email = :email and senha = :senha"
     *       $params = array("email" => "teste@gmail.com", "senha" => md5("12345")
     * 
     * Ex2:  $where = "where usuario_id = :aid"
     *       $params = array("aid" => 1)
     */
    public function custom_query_on_table(string $entidade, string $where, array $params){
        if(!empty($params)){
            $parse_string = $this->define_parse_string($params);
            $list = new Read();
            $list->ExeRead($entidade, $where, $parse_string);
            $this->result = $list->getResult();
        }
    }


    /**
     * Executa uma consulta personalizada no banco de dados - INNER JOIN
     * Retorna os campos desejados na consulta
     * 
     * $where -> recebe o SQL da consulta (especifica os campos desejados)
     * $params -> recebe um array que especifica os atributos que definem a sequência de análise
     */
    public function custom_query(string $where, array $params){
        if(!empty($params)){
            $parse_string = $this->define_parse_string($params);
            $read = new Read();
            $read->FullRead($where, $parse_string);
            $this->result = $read->getResult();
        } else{
            $this->result = false;
        }
    }
    

    /**
     * Executa uma exclusão no banco de dados
     * 
     * $entidade -> recebe o nome da tabela que deverá executar a operação
     * $id -> recebe o número do registro que será excluído
     */
    public function delete(string $entidade, string $id){
        $delete = new Delete();
        // ':aid' é um link simbolico
        $delete->ExeDelete($entidade, "WHERE ".$entidade."_id = :aid", "aid={$id}");
        $this->result = $delete->getResult();
    }


    /**
     * Define a sequência de análise para se executar uma consulta
     * Retorna uma string no formato: "link=value&link2=value2"
     * Ex: $parse_string = "email=teste@email.com&senha=827ccb0eea8a706c4c34a16891f84e7b"
     * 
     * $params -> recebe um array que especifica os atributos que definem a sequência de análise
     */
    private function define_parse_string(array $params){
        if(count($params) == 1){
            // echo "1 params<br/>";
            return $parse_string = key($params) . "=" . $params[key($params)];
        } else{
            // echo "2/+ params<br/>";
            $parse_string = "";
            foreach($params as $key => $value){
                $parse_string .= $key . "=" . $value . "&";
            }
            // retira último elemento da string: '&'
            return $parse_string = substr($parse_string, 0, -1); 
        }
    }


    /**
     * Gera delimitador para recuperar o atributo do objeto
     * Retorna uma string
     * 
     * $entidade -> recebe o nome da tabela que deverá ser modificado
     * Ex: $entidade = "usuario" => result = "Usuario"
     *     $entidade = "equipe_membro" => result = "EquipeMembro"
     */
    private function control_entity_for_explode(string $entidade){
        $ent = explode("_", $entidade);
        if(isset($ent[2])){
            $ent = ucfirst($ent[0]) . ucfirst($ent[1]) . ucfirst($ent[2]);
        } elseif (isset($ent[1])){
            $ent = ucfirst($ent[0]) . ucfirst($ent[1]);
        }else{
            $ent = ucfirst($entidade);
        }
        return $ent;
    }


    /**
     * Verifica se os campos obrigatórios da entidade estão preenchidos
     * Retorna: um array vazio se os campos foram preenchidos | 
     *          um array com as chaves dos campos nao preenchidos
     * 
     * $keys -> constante definida no arquivo Config.inc
     */
    protected function check_fields(array $keys, array $data) {
        $chaves_nao_nulas = $keys;
        $result = [];
        foreach ($chaves_nao_nulas as $key) {
            if(array_key_exists($key, $data)){
                if(empty($data[$key])){
                    $result[] = $key;
                }
            }
        }
        return $result;
    }


    /**
     * Retorna os campos obrigatórios da entidade que nao foram informados
     * 
     * $result = campo1|campo2  ->  etc..
     */
    protected function return_fields(array $fields) {
        $string = "";
        foreach($fields as $erro){
            $string .= $erro . "|";
        }
        // retira ultimo elemento da string: '|'
        return $string = substr($string, 0, -1); 
    }


    /**
     * Verifica se insert/update foi efetuado no banco de dados
     */
    protected function database_result($entity_instance) {
        if($entity_instance->getResult()){
            return TAG_SUCCESS;
        } else {
            return TAG_ERROR;
        }
    }

}

