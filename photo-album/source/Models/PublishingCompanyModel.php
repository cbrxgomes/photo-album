<?php

namespace Source\Models;

use \Source\Models\DataLayer;
use \PDO;

class PublishingCompanyModel
{
    public static function getPublishingCompanys()
    {
        try {
            $query = "SELECT PublishingCompanyId,
                Name

                FROM ".DL_DBNAME.".publishingcompany

                WHERE IsActive = true";
        
            return (new DataLayer())->select($query)->fetchAll(PDO::FETCH_OBJ);
        } catch (\Throwable $th) {
            return null;
        }
    }
}
