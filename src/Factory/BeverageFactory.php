<?php

namespace App\Factory;

use App\Factory\CoffeBeverage;
use App\Factory\TeaBeverage;
use App\Factory\JuiceBeverage;

use App\Entity\Beverage;

class BeverageFactory
{
    /**
     * @param int $id
     * @param int $type
     */
    public function createBeverage($entityBeverage)
    {
        switch($entityBeverage->getBeverageTypeId()){
            case 1:
                return new TeaBeverage($entityBeverage);
                break;
            case 2:
                return new CoffeBeverage($entityBeverage);
                break;
            case 3:
                return new JuiceBeverage($entityBeverage);
                break;
        }
    }
}