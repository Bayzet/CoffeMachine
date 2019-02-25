<?php

namespace App\Factory;

use App\Factory\BeverageInterface;
use App\Entity\Beverage;

abstract class BeverageAbstract implements BeverageInterface
{
    public $packingVolume; // Объём упаковки
    public $packingMaterial; // Материал упаковки
    public $beverageType; // Тип упоковки
    public $beverageColor; // Цвет напитка
    public $beverageName; // Название напитка
    public $beveragePrice; // Название напитка

    public function __construct($entityBeverage)
    {
        // $beverage = $orm->getRepository(Beverage::class)->find($id);

        $this->beverageType = $entityBeverage->getBeverageType()->getName();
        $this->beverageColor = $entityBeverage->getBeverageColor();
        $this->beverageName = $entityBeverage->getName();
        $this->beveragePrice = $entityBeverage->getPrice();
    }

} 