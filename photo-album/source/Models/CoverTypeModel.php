<?php

namespace Source\Models;

use \Source\Models\DataLayer;
use \PDO;

class CoverTypeModel
{
    public static function getCoverTypes()
    {
        try {
            $query = "SELECT CoverTypeId,
                Name

                FROM ".DL_DBNAME.".covertype

                WHERE IsActive = true";
        
            return (new DataLayer())->select($query)->fetchAll(PDO::FETCH_OBJ);
        } catch (\Throwable $th) {
            return null;
        }
    }
}
