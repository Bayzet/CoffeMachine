<?php 

namespace App\Factory;

use App\Factory\BeverageAbstract;

class TeaBeverage extends BeverageAbstract
{
    protected $packingVolume = 250; // Объём упаковки
    protected $packingMaterial = 'Пластик'; // Материал упаковки
}