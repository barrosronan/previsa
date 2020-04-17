<?php

/**
 * Description of Create.class
 *
 * @author Ronan
 */
class Create extends Conn
{
    private $tabela;
    private $dados;
    private $result;
    private $Msg;
    
    /** @var PDOStatement */
    private $Create;
    
    /** @var PDO */
    private $conn;

    /**
     * <b>exeCreate:</b> Executa um cadastro simplificado no banco de dados utilizando prepared statements.
     * Basta informar o nome da tabela e um array atribuitivo com nome da coluna e valor!
     * 
     * 
     * @param string $tabela = Tabela do banco de dados.
     * @param array $dados = Array atribuitivo. (Coluna => valor).
     */    
    public function exeCreate($tabela, array $dados)
    {
        $this->tabela = (string) $tabela;
        $this->dados = $dados;
        
        $this->getSintaxe();
        $this->executar();
        
    }
    
    public function getResult()
    {
        return $this->result;
    }

    public function getMsg()
    {
        return $this->Msg;
    }

    
    /**
     * ****************************************
     * *********** PRIVATE METHODS ************
     * ****************************************
     */
    
    /** Pega a conexão e prepara a query. */
    private function connect()
    {
        $this->conn = parent::getConn();
        $this->Create = $this->conn->prepare($this->Create);
    }
    
    /** Monta a query corretamente. */
    private function getSintaxe()
    {
        $fileds = implode(', ', array_keys($this->dados));
        $places = ':'.implode(', :', array_keys($this->dados));
        $this->Create = "INSERT INTO {$this->tabela} ({$fileds}) VALUES ({$places})";
    }
    
    private function executar()
    {
        $this->connect();
        try
        {
            $this->Create->execute($this->dados);
            $this->result = $this->conn->lastInsertId();
            
        } catch (PDOException $e) {
            $this->result = null;
            //trigger_error($e->getMessage(),E_USER_ERROR);
            $this->Msg = $e->getMessage();
        }
    }
    
}