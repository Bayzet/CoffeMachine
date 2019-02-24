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

    public function __construct($orm, $id)
    {
        $beverage = $orm->getRepository(Beverage::class)->find($id);

        $this->beverageType = $beverage->getBeverageType()->getName();
        $this->beverageColor = $beverage->getBeverageColor();
        $this->beverageName = $beverage->getName();
        $this->beveragePrice = $beverage->getPrice();
    }

} 