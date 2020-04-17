<?php

/**
 * Description of Update.class
 *
 * @author Ronan
 */
class Update extends Conn
{
    private $tabela;
    private $dados;
    private $termos;
    private $places;
    private $result;
    private $Msg;
    
    /** @var PDOStatement */
    private $Update;
    
    /** @var PDO */
    private $conn;

    public function exeUpdate($tabela, array $dados, $termos, $parseString)
    {
        $this->tabela = (string) $tabela;
        $this->dados = $dados;
        $this->termos = $termos;
        
        parse_str($parseString, $this->places);
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
     * Retorna a quantidade de registros selecionados.
     * 
     * @return int = quantidade de linhas.
     */
    public function getRowCount()
    {
        return $this->Update->rowCount();
    }

    /**
     * Converte a string para array(indice => valor).
     * 
     * @param string $parseString
     */
    public function setPlaces($parseString)
    {
        parse_str($parseString, $this->places);
        $this->getSintaxe();
        $this->executar();
    }

    /**
     * ****************************************
     * *********** PRIVATE METHODS ************
     * ****************************************
     */
    
    /** Estabelece a conexao. */
    private function connect()
    {
        $this->conn = parent::getConn();
        $this->Update = $this->conn->prepare($this->Update);
    }
    
    /** Monta a query corretamente passando os valores para os indices da query. */
    private function getSintaxe()
    {
        foreach ($this->dados as $key => $value)
        {
            //places aqui, não é o atributo.
            $places[] = $key.' = :'.$key;
        }
        
        $places = implode(', ', $places);
        $this->Update = "UPDATE {$this->tabela} SET {$places} {$this->termos}";
    }
    
    private function executar()
    {
        $this->connect();
        try{
            $this->Update->execute(array_merge($this->dados, $this->places));
            $this->result = true;
            
        } catch (PDOException $e) {
            $this->result = null;
            $this->Msg = $e->getMessage();
        }
    }
}