<?php

namespace Source\Models;

use \Source\Models\DataLayer;
use \PDO;

class AuthorModel
{
    public static function getAuthors()
    {
        try {
            $query = "SELECT AuthorId,
                Name

                FROM ".DL_DBNAME.".author

                WHERE IsActive = true";
        
            return (new DataLayer())->select($query)->fetchAll(PDO::FETCH_OBJ);
        } catch (\Throwable $th) {
            return null;
        }
    }
}
