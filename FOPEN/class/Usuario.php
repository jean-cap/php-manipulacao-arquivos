<?php


class Usuario
{
    private string $idusuario;
    private string $deslogin;
    private string $dessenha;
    private DateTime $dtcadastro;

    public function __construct(string $login = '', string $senha = '')
    {
        $this->setDeslogin($login);
        $this->setDessenha($senha);
    }

    public function setData($data)
    {
        $this->setIdusuario($data['idusuario']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro(new DateTime($data['dtcadastro']));
    }

    public function insert()
    {
        $sql = new Sql();
        $resultado = $sql->select('CALL sp_usuarios_insert(:LOGIN, :PASSWORD)', array(
            ':LOGIN' => $this->getDeslogin(),
            ':PASSWORD' => $this->getDessenha()
        ));

        if (isset($resultado[0])) {
            $this->setData($resultado[0]);
        }
    }

    public function update($login, $senha)
    {
        $this->setDeslogin($login);
        $this->setDessenha($senha);

        $sql = new Sql();
        $sql->query('UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :SENHA WHERE idusuario = :ID', array(
            ':LOGIN' => $this->getDeslogin(),
            ':SENHA' => $this->getDessenha(),
            ':ID' => $this->getIdusuario()
        ));
    }

    public function delete()
    {
        $sql = new Sql();
        $sql->query('DELETE FROM tb_usuarios WHERE idusuario = :ID', array(':ID' => $this->getIdusuario()));

        $this->setIdusuario(0);
        $this->setDeslogin('');
        $this->setDessenha('');
        $this->setDtcadastro(new DateTime());
    }

    public static function getList()
    {
        $sql = new Sql();
        return $sql->select('SELECT * FROM tb_usuarios ORDER BY deslogin');
    }

    public static function search($login)
    {
        $sql = new Sql();
        return $sql->select('SELECT * FROM tb_usuarios WHERE deslogin LIKE :LOGIN ORDER BY deslogin', array(':LOGIN' => '%' . $login . '%'));
    }

    public function loadById(int $id): void
    {
        $sql = new Sql();
        $resultado = $sql->select('SELECT * FROM tb_usuarios WHERE idusuario = :ID', array(':ID' => $id));

        if (isset($resultado[0])) {
            $this->setData($resultado[0]);
        }
    }

    public function login($login, $password)
    {
        $sql = new Sql();
        $resultado = $sql->select('SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD', array(
            ':LOGIN' => $login,
            ':PASSWORD' => $password
        ));

        if (isset($resultado[0])) {
            $this->setData($resultado[0]);
        } else {
            throw new Exception('Login ou senha inválidos!');
        }
    }

    public function __toString()
    {
        return json_encode(array(
            'idusuario' => $this->getIdusuario(),
            'deslogin' => $this->getDeslogin(),
            'dessenha' => $this->getDessenha(),
            'dtcadastro' => $this->getDtcadastro()->format('d/m/Y H:i:s')
        ));
    }

    /**
     * @return string
     */
    public function getIdusuario(): string
    {
        return $this->idusuario;
    }

    /**
     * @param string $idusuario
     */
    public function setIdusuario(string $idusuario): void
    {
        $this->idusuario = $idusuario;
    }

    /**
     * @return string
     */
    public function getDeslogin(): string
    {
        return $this->deslogin;
    }

    /**
     * @param string $deslogin
     */
    public function setDeslogin(string $deslogin): void
    {
        $this->deslogin = $deslogin;
    }

    /**
     * @return string
     */
    public function getDessenha(): string
    {
        return $this->dessenha;
    }

    /**
     * @param string $dessenha
     */
    public function setDessenha(string $dessenha): void
    {
        $this->dessenha = $dessenha;
    }

    /**
     * @return DateTime
     */
    public function getDtcadastro(): DateTime
    {
        return $this->dtcadastro;
    }

    /**
     * @param DateTime $dtcadastro
     */
    public function setDtcadastro(DateTime $dtcadastro): void
    {
        $this->dtcadastro = $dtcadastro;
    }
}