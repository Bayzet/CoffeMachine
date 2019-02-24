<?php

namespace App\Factory;

use App\Factory\CoffeBeverage;
use App\Factory\TeaBeverage;
use App\Factory\JuiceBeverage;

class BeverageFactory
{
    /**
     * @param int $id
     * @param int $type
     */
    public function createBeverage($orm, $id, $type)
    {
        switch($type){
            case 1:
                return new TeaBeverage($orm, $id);
                break;
            case 2:
                return new CoffeBeverage($orm, $id);
                break;
            case 3:
                return new JuiceBeverage($orm, $id);
                break;
        }
    }
}