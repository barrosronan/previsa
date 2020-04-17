<?php

/**
 * Description of Read.class
 *
 * @author Ronan
 */
class Read extends Conn
{
    private $select;
    private $places;
    private $result;
    private $Msg;
    
    /** @var PDOStatement */
    private $Read;
    
    /** @var PDO */
    private $conn;

    /**
     * Prepara a query e manda executar.
     * 
     * @param type $tabela = Nome da tabela.
     * @param type $termos = Condições ex: WHERE.
     * @param type $parseString = Valores que serão passados para os indices na string.
     */
    public function exeRead($tabela, $termos = null, $parseString = null)
    {
        if(!empty($parseString))
        {
            parse_str($parseString, $this->places);
        }
        
        $this->select = "SELECT * FROM {$tabela} {$termos}";
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
        return $this->Read->rowCount();
    }
    
    /**
     * Te dá o direito de criar uma query completa.
     * 
     * @param string $query = Query a ser executada.
     * @param string $parseString = Valores que serão passados para os indices na string.
     */
    public function fullRead($query, $parseString = null)
    {
        $this->select = (string) $query;
        
        if(!empty($parseString))
        {
            parse_str($parseString, $this->places);
        }
        
        $this->executar();
    }
    
    /**
     * Converte a string para array(indice => valor).
     * 
     * @param string $parseString
     */
    public function setPlaces($parseString)
    {
        parse_str($parseString, $this->places);
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
        $this->Read = $this->conn->prepare($this->select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
    }
    
    /** Monta a query corretamente passando os valores para os indices da query. */
    private function getSintaxe()
    {
        if($this->places):
            foreach ($this->places as $vinculo => $valor):
                if($vinculo == 'limit' || $vinculo == 'offset'):
                    $valor = (int)$valor;
                endif;
                $this->Read->bindValue(":{$vinculo}", $valor, (is_int($valor) ? PDO::PARAM_INT : PDO::PARAM_STR));
                
            endforeach;
        endif;
            
    }
    
    private function executar()
    {
        $this->connect();
        try{
            $this->getSintaxe();                        //Monta a sintax.
            $this->Read->execute();                     //Executa a query.
            $this->result = $this->Read->fetchAll();    //Passa o resultado para a result em forma de array.
            
            if(!$this->result)
                $this->Msg = 'Nenhum registro encontrado.';
            
        } catch (PDOException $e) {
            $this->result = null;
            $this->Msg = $e->getMessage();
            // trigger_error($e->getMessage(), E_USER_ERROR);
        }
    }
}