<?php 

namespace App\Factory;

use App\Factory\BeverageAbstract;

class TeaBeverage extends BeverageAbstract
{
    public $packingVolume = 250; // Объём упаковки
    public $packingMaterial = 'Пластик'; // Материал упаковки
}