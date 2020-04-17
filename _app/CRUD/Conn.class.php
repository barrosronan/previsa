<?php

/**
 * Conn.class[CONEXÃO]
 * Classe abstrata de conexão padrão singleTon.
 * Retorna um objeto PDO pelo método estático getConn();
 * 
 * @author Ronan
 */
class Conn
{
    private static $host = HOST;
    private static $user = USER;
    private static $pass = PASS;
    private static $dbsa = DBSA;
    
    /** @var PDO */
    private static $connect = null;
    
    /**
     * Conecta com o banco de dados com o pattern silgleton.
     * Retorna um objeto PDO.
     */
    private static function conectar()
    {
        try{
            
            if(self::$connect == null)
            {
                //Configura o host e a base de dados.
                $dsn = 'mysql:host='.self::$host.';dbname='.self::$dbsa;
                
                //Configura o option.
                $options = [ PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8' ];
                
                //Estabelece a conexão.
                self::$connect = new PDO($dsn, self::$user, self::$pass, $options);
            }//endif
            
        }catch (PDOException $e){
            trigger_error($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            die;
        }
        
        //Excessões de erro.
        self::$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Retorna a conexão.
        return self::$connect;
    }
    
    /** Retorna um objeto PDO SigleTon Pattern. */
    public static function getConn()
    {
        return self::conectar();
    }

    
}