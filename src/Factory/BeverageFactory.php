<?php

namespace App\Factory;

use App\Factory\CoffeBeverage;
use App\Factory\TeaBeverage;
use App\Factory\JuiceBeverage;

use App\Entity\Beverage;

class BeverageFactory
{
    /** 
     * Метод создаёт нужный объект
     * 
     * @param Beverage $entityBeverage - модель напитка который оплатили
     * @return object
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