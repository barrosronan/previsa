<?php

/**
 * Description of Delete.class
 *
 * @author Ronan
 */
class Delete extends Conn
{
    private $tabela;
    private $termos;
    private $places;
    private $result;
    private $Msg;
    
    /** @var PDOStatement */
    private $Delete;
    
    /** @var PDO */
    private $conn;

    public function exeDelete($tabela, $termos, $parseString)
    {
        $this->tabela = (string) $tabela;
        $this->termos = (string) $termos;
        
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
        return $this->Delete->rowCount();
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
        $this->Delete = $this->conn->prepare($this->Delete);
    }
    
    /** Monta a query corretamente passando os valores para os indices da query. */
    private function getSintaxe()
    {
        $this->Delete = "DELETE FROM {$this->tabela} {$this->termos}";
    }
    
    private function executar()
    {
        $this->connect();
        try{
            $this->Delete->execute($this->places);
            $this->result = true;

        } catch (PDOException $e) {
            $this->result = null;
            $this->Msg = $e->getMessage();
        }
    }
}