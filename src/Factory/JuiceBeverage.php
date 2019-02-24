<?php 

namespace App\Factory;

use App\Factory\BeverageAbstract;

class JuiceBeverage extends BeverageAbstract
{
    protected $packingVolume = 300; // Объём упаковки
    protected $packingMatrial = 'cardboard'; // Материал упаковки
}