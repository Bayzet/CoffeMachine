<?php

namespace App\Factory;

use App\Factory\BeverageInterface;
use App\Entity\Beverage;

abstract class BeverageAbstract implements BeverageInterface
{
    protected $packingVolume; // Объём упаковки
    protected $packingMaterial; // Материал упаковки
    protected $beverageType; // Тип упоковки
    protected $beverageColor; // Цвет напитка
    protected $beverageName; // Название напитка
    protected $beveragePrice; // Стоймость напитка

    public function __construct($entityBeverage)
    {
        $this->beverageType = $entityBeverage->getBeverageType()->getName();
        $this->beverageColor = $entityBeverage->getBeverageColor();
        $this->beverageName = $entityBeverage->getName();
        $this->beveragePrice = $entityBeverage->getPrice();
    }

    /**
     * @param string $name
     *
     * @return string|integer
     */
    public function __get($name){
        return $this->$name;
    }

} 