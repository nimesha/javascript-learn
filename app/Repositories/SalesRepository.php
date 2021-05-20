<?php

namespace App\Repositories;

use App\Core\DB;
use mysqli;

class SalesRepository extends DB
{


    /**
     * 
     * @param ['2018-05-01','2018-05-02', '2018-05-03']
     * @return array 
     */
    public function getTrunOverPerBrand(array $date)
    {

        $date_string =  "'" . implode("','", $date) . "'";

        //$date_string = $this->real_escape_string($date_string);

        $query = "SELECT b.id, b.name, DATE_FORMAT(g.date,'%Y-%m-%d') as date , sum(turnover) as 'turnover' FROM brands as b
                    LEFT JOIN gmv as g 
                    ON b.id = g.brand_id
                    WHERE g.date IN ($date_string)
                    GROUP BY b.id , g.date";

        $results = $this->getConnection()->query($query);
        $res = $this->fetchAll($results);
        return $res;
    }


    /**
     * 
     * @param ['2018-05-01','2018-05-02', '2018-05-03']
     * @return array 
     */
    public function getTrunOverPerDay(array $date)
    {
        $date_string =  "'" . implode("','", $date) . "'";
        //$date_string = $this->real_escape_string($date_string);
        $query = "SELECT DATE_FORMAT(g.date,'%Y-%m-%d') as date , sum(turnover) as 'turnover' FROM brands as b
        LEFT JOIN gmv as g 
        ON b.id = g.brand_id
        WHERE g.date IN ($date_string)
        GROUP BY  g.date";

        $results = $this->getConnection()->query($query);
        $res = $this->fetchAll($results);
        return $res;
    }
}
