<?php 

namespace App\Factory;

use App\Factory\BeverageAbstract;

class CoffeBeverage extends BeverageAbstract
{
    public $packingVolume = 150; // Объём упаковки
    public $packingMaterial = 'Бумага'; // Материал упаковки
}