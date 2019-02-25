<?php 

namespace App\Factory;

use App\Factory\BeverageAbstract;

class JuiceBeverage extends BeverageAbstract
{
    public $packingVolume = 300; // Объём упаковки
    public $packingMaterial = 'Картон'; // Материал упаковки
}