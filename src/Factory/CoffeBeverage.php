<?php 

namespace App\Factory;

use App\Factory\BeverageAbstract;

class CoffeBeverage extends BeverageAbstract
{
    protected $packingVolume = 150; // Объём упаковки
    protected $packingMatrial = 'paper'; // Материал упаковки
}