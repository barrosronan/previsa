<?php
class AdminFuncionario
{
    private $table = 'Funcionario';
    private $tableFilho = 'FuncionarioFilho';
    private $execute = null;

    public function getExecuteResult()
    {
        return $this->execute->getResult();
    }

    public function getExecuteMsg()
    {
        return $this->execute->getMsg();
    }

    public function Pesquisa($texto)
    {
        $query = "SELECT f.CodFuncionario, f.Nome, f.DataNascimento, 
                        (SELECT COUNT(CodFuncionario) FROM {$this->tableFilho} ff 
                            WHERE f.CodFuncionario = ff.CodFuncionario) AS qtfilho 
                  FROM {$this->table} f 
                  WHERE f.nome LIKE CONCAT('%',:pesquisa,'%');";

        $this->execute = new Read();
        $this->execute->fullRead($query, "pesquisa={$texto}");
    }

    public function exeReadFilhos($cod)
    {
        $this->execute = new Read();
        $this->execute->exeRead($this->tableFilho, "WHERE CodFuncionario = :CodFuncionario", "CodFuncionario={$cod}");
    }

    public function exeCreateFilho($dados)
    {
        $this->execute = new Create();
        $this->execute->exeCreate($this->tableFilho, $dados);
    }

    public function exeReadFilho($cod)
    {
        $this->execute = new Read();
        $this->execute->exeRead($this->tableFilho, "WHERE CodFuncionarioFilho = :CodFuncionarioFilho", "CodFuncionarioFilho={$cod}");
    }

    public function exeUpdateFilho($dados, $cod)
    {
        $this->execute = new Update();
        $this->execute->exeUpdate($this->tableFilho, $dados, "WHERE CodFuncionarioFilho = :CodFuncionarioFilho", "CodFuncionarioFilho={$cod}");
    }

    public function exeDeleteFilho($cod)
    {
        $condicao = "WHERE CodFuncionarioFilho = :CodFuncionarioFilho";
        $this->execute = new Delete();
        $this->execute->exeDelete($this->tableFilho, $condicao, "CodFuncionarioFilho={$cod}");
    }

    public function exeCreate($dados)
    {
        $this->execute = new Create();
        $this->execute->exeCreate($this->table, $dados);
    }

    public function exeDelete($cod)
    {
        $condicao = "WHERE CodFuncionario = :CodFuncionario";
        $this->execute = new Delete();
        $this->execute->exeDelete($this->tableFilho, $condicao, "CodFuncionario={$cod}");
        $this->execute->exeDelete($this->table, $condicao, "CodFuncionario={$cod}");
    }

    public function exeReadFunc($cod)
    {
        $this->execute = new Read();
        $this->execute->exeRead($this->table, "WHERE CodFuncionario = :CodFuncionario", "CodFuncionario={$cod}");
    }

    public function exeReadFuncFilho($cod)
    {
        $this->execute = new Read();
        $this->execute->exeRead($this->tableFilho, "WHERE CodFuncionario = :CodFuncionario", "CodFuncionario={$cod}");
    }

    public function exeUpdate($dados, $cod)
    {
        $this->execute = new Update();
        $this->execute->exeUpdate($this->table, $dados, "WHERE CodFuncionario = :CodFuncionario", "CodFuncionario={$cod}");
    }
}