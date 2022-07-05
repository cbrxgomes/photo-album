<?php

namespace Source\Models;

use \PDO;
use PDOException;

class DataLayer
{
    private $connection;

    public function __construct()
    {
        $this->connection();
    }

    /**
     * Metodo responsável por criar uma conexão com o banco de dados.
     */
    public function connection()
    {
        try {
            $this->connection = new PDO("mysql:host=".DL_HOST.";dbname=".DL_DBNAME, DL_USER, DL_PASSWORD);
            
            //Aqui o PDO é configurado para caso ocorra alguma erro de banco de dados o sistemas sejá interrompido.
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }

    /**
     * Metodo responsável por executar as queries no banco de dados.
     */
    private function execute($query, $params = []) 
    {
        try {
           $statement = $this->connection->prepare($query);
           $statement->execute($params);
            
           //Retorna o resultado do SQL Insert no banco de dados.
           return $statement;
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }

    public function select($query) 
    {
        return $this->execute($query);
    }

    public function insert($tableName, $values, $isPrintQuery = false)
    {   
        $query = "INSERT INTO " . DL_DBNAME . "." . $tableName . " 
            (" . join(",", array_keys($values)) . ") 
            VALUES (" . join(",", array_pad([], count($values), "?")) . ")";

        // Imprimir query que será executada no banco de dados.
        if ($isPrintQuery) {
            echo "<pre>"; print_r($query); echo "</pre>"; exit;
        }

        $this->Execute($query, array_values($values));

        return $this->connection->lastInsertId();
    }
}
