<?php

class Usuario extends Dao implements Functions
{

    // Constantes
    const ENTIDADE = "usuario";

    const ID = Usuario::ENTIDADE . "_id";
    const NOME = Usuario::ENTIDADE . "_nome";
    const EMAIL = "email";
    const SENHA = "senha";
    // const TELEFONE = "telefone";
    const CIDADE = "cidade";
    const ESTADO = "estado";
    const STATUS = "status_ativo";
    const SEXO = "sexo";
    const TOKEN = "token";
    const PROFISSAO = "profissao";
    const ESCOLARIDADE = "escolaridade";
    const DESCRICAO = "descricao_perfil";
    const IMAGEM_URL = "imagem_url";

    const WHERE_USUARIO = "where usuario_id = :aid";
    const WHERE_EMAIL = "where email = :email";
    const WHERE_QUESTAO = "where questao_id = :questao_id";

    const SQL_MATERIAL_USUARIO_EQUIPE = "SELECT material.material_id, material.material_tipo
       
        from usuario
        join equipe_membro
        join equipe
        join material
    
        on usuario.usuario_id = equipe_membro.equipe_membro_usuario_id
        and equipe_membro.equipe_membro_equipe_id = equipe.equipe_id
        and equipe.equipe_id = material.material_equipe_id
    
        where equipe.equipe_id = :equipe_id or usuario.usuario_id = :usuario_id";

    const SQL_LOGIN = "SELECT usuario.usuario_id,
                            usuario.email,
                            usuario.senha,
                            usuario.usuario_nome
  
                            FROM usuario
                            INNER JOIN equipe
                            INNER JOIN equipe_membro
    
                            ON usuario.usuario_id = equipe_membro.equipe_membro_usuario_id
                            AND equipe.equipe_id = equipe_membro.equipe_membro_equipe_id
    
                            WHERE usuario.email = :email AND usuario.senha = :senha";

    const SQL_LOGIN_CLIENT = "where "  . Usuario::EMAIL . " = :email AND " . Usuario::SENHA . " = :senha";

    // Atributos 
    private $usuario_id;
    private $usuario_nome;
    private $email;
    private $senha;
    private $cidade;
    private $estado;
    private $status_ativo;
    private $sexo;
    private $token;
    private $profissao;
    private $escolaridade;
    private $descricao_perfil;
    private $imagem_url;

    // Getter's and Setter's
    public function getUsuario_id()
    {
        return $this->usuario_id;
    }

    public function setUsuario_id($usuario_id)
    {
        $this->usuario_id = $usuario_id;
    }

    public function getUsuario_nome()
    {
        return $this->usuario_nome;
    }

    public function setUsuario_nome($usuario_nome)
    {
        $this->usuario_nome = $usuario_nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function getStatus_ativo()
    {
        return $this->status_ativo;
    }

    public function setStatus_ativo($status_ativo)
    {
        $this->status_ativo = $status_ativo;
    }

    public function getSexo()
    {
        return $this->sexo;
    }

    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function getProfissao()
    {
        return $this->profissao;
    }

    public function setProfissao($profissao)
    {
        $this->profissao = $profissao;
    }

    public function getEscolaridade()
    {
        return $this->escolaridade;
    }

    public function setEscolaridade($escolaridade)
    {
        $this->escolaridade = $escolaridade;
    }

    public function getDescricao_perfil()
    {
        return $this->descricao_perfil;
    }

    public function setDescricao_perfil($descricao_perfil)
    {
        $this->descricao_perfil = $descricao_perfil;
    }

    public function getImagem_url()
    {
        return $this->imagem_url;
    }

    public function setImagem_url($imagem_url)
    {
        $this->imagem_url = $imagem_url;
    }

    // functions of class
    public function transform_array_to_object(array $data)
    {
        $usuario = new Usuario();
        isset($data[Usuario::ID]) ? $usuario->setUsuario_id($data[Usuario::ID]) : null;
        isset($data[Usuario::NOME]) ? $usuario->setUsuario_nome($data[Usuario::NOME]) : null;
        isset($data[Usuario::EMAIL]) ? $usuario->setEmail($data[Usuario::EMAIL]) : null;
        isset($data[Usuario::SENHA]) ? $usuario->setSenha($data[Usuario::SENHA]) : null;
        isset($data[Usuario::CIDADE]) ? $usuario->setCidade($data[Usuario::CIDADE]) : null;
        isset($data[Usuario::ESTADO]) ? $usuario->setEstado($data[Usuario::ESTADO]) : null;
        isset($data[Usuario::STATUS]) ? $usuario->setStatus_ativo($data[Usuario::STATUS]) : null;
        isset($data[Usuario::SEXO]) ? $usuario->setSexo($data[Usuario::SEXO]) : null;
        isset($data[Usuario::TOKEN]) ? $usuario->setToken($data[Usuario::TOKEN]) : null;
        isset($data[Usuario::PROFISSAO]) ? $usuario->setProfissao($data[Usuario::PROFISSAO]) : null;
        isset($data[Usuario::ESCOLARIDADE]) ? $usuario->setEscolaridade($data[Usuario::ESCOLARIDADE]) : null;
        isset($data[Usuario::DESCRICAO]) ? $usuario->setDescricao_perfil($data[Usuario::DESCRICAO]) : null;
        isset($data[Usuario::IMAGEM_URL]) ? $usuario->setImagem_url($data[Usuario::IMAGEM_URL]) : null;
        // retorna null para o a atributo result
        $usuario->setResult();
        return $usuario;
    }

    /**
     * Cria registro de usuário
     */
    public function create_new_account_of_user(array $data)
    {
        $result = $this->check_fields(USUARIO_A_K_N_N, $data);
        if (count($result) == 0) {
            $usuario = new Usuario();
            $data[Usuario::SENHA] = md5($data[Usuario::SENHA]);
            $obj = $usuario->transform_array_to_object($data);
            $usuario->create(Usuario::ENTIDADE, $obj);
            $db_result = $this->database_result($usuario);
            return $db_result;
        } else {
            $fields = $this->return_fields($result);
            return  TAG_MESSAGE . "&" . $fields;
        }
    }

    /**
     * @lacy_
     * login de admin ou membro de uma equipe
     */
    private function login_admin(array $data)
    {
        $usuario = new Usuario();
        $data[Usuario::SENHA] = md5($data[Usuario::SENHA]);
        $usuario->custom_query(Usuario::SQL_LOGIN, $data);
        if (count($usuario->getResult()) == 0) :
            return $bd_result_admin = null;
        else :
            return $bd_result_admin = $usuario->getResult()[0];
        endif;
    }

    /**
     * @lacy_
     * login de cliente
     */
    private function search_user(array $data)
    {
        $usuario = new Usuario();
        $data[Usuario::SENHA] = md5($data[Usuario::SENHA]);
        $usuario->custom_query_on_table(Usuario::ENTIDADE, Usuario::SQL_LOGIN_CLIENT, $data);
        if (count($usuario->getResult()) == 0) :
            return $bd_result_client = null;
        else :
            return $bd_result_client = $usuario->getResult()[0];
        endif;
    }

    /**
     * @lacy_
     * loga usuário
     */
    public function effect_login(array $data)
    {
        $result_user = $this->search_user($data);

        if ($result_user == null) :
            return TAG_ERROR;
        else :
            $bd_result_admin = $this->login_admin($data);
            if ($bd_result_admin == null) :
                return $result_user;
            else :
                return $bd_result_admin;
            endif;
        endif;
    }

    /** 
     * Gera chave de acesso para recuperação de login
     * 
     * Recebe o email como string
     * return email_usuario|md5(usuario_id + senha)
     */
    public function make_access_key_to_recover_login($email)
    {
        if (!empty($email)) {
            $usuario = new Usuario();
            $usuario->custom_query_on_table(Usuario::ENTIDADE, Usuario::WHERE_EMAIL, array(Usuario::EMAIL => $email));
            if ($usuario->getResult()) {
                return $usuario->getResult()[0][Usuario::EMAIL] . "|" . md5($usuario->getResult()[0][Usuario::ID] .
                    $usuario->getResult()[0][Usuario::SENHA]);
            } else {
                return TAG_ERROR;
            }
        }
    }

    /**
     * Atualiza o registro do usuário 
     * quando solicitado uma recuperação de senha
     */
    public function recover_login(array $data)
    {
        extract($data);
        if (!empty($email) && !empty($nova_senha) && !empty($confirma_nova_senha) && !empty($key)) {
            if ($nova_senha == $confirma_nova_senha) {
                $result = $this->validate_access_key($email, $key);
                if ($result) {
                    $usuario = new Usuario();
                    $user_update = $usuario->transform_array_to_object($result);
                    $user_update->setSenha(md5($nova_senha));
                    $usuario->update(Usuario::ENTIDADE, $user_update);
                    $db_result = $this->database_result($usuario);
                    return $db_result;
                } else {
                    return TAG_ERROR;
                }
            } else {
                return TAG_MESSAGE;
            }
        }
    }

    /**
     * Verifica se chave de acesso do usuário é válida
     * e retorna o array com as informações do usuário
     */
    private function validate_access_key($email, $key)
    {
        $usuario = new Usuario();
        $usuario->custom_query_on_table(Usuario::ENTIDADE, Usuario::WHERE_EMAIL, array(Usuario::EMAIL => $email));
        if ($usuario->getResult()) {
            $access_key = md5($usuario->getResult()[0][Usuario::ID] . $usuario->getResult()[0][Usuario::SENHA]);
            if ($access_key == $key) {
                return $usuario->getResult()[0];
            } else {
                return FALSE;
            }
        }
    }

    /**
     * Atualiza registro de usuário
     */
    public function update_account_of_user(array $data)
    {
        $usuario = new Usuario();
        $obj = $usuario->transform_array_to_object($data);
        $usuario->update(Usuario::ENTIDADE, $obj);
        $db_result = $this->database_result($usuario);
        return $db_result;
    }

    public function listUsuario()
    {
        $usuario = new Usuario();
        $usuario->list(USUARIO::ENTIDADE);
        return $usuario->getResult();
    }
}
