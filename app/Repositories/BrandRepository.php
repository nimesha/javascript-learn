<?php

namespace App\Repositories;

use App\Core\DB;


class BrandRepository extends DB
{

    public function getAllBrands()
    {

        $query = "SELECT * FROM brands";
        $results = $this->getConnection()->query($query);
        $res = $this->fetchAll($results);
        return $res;
    }
}
