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
    protected $beveragePrice; // Название напитка

    public function __construct($entityBeverage)
    {
        // $beverage = $orm->getRepository(Beverage::class)->find($id);

        $this->beverageType = $entityBeverage->getBeverageType()->getName();
        $this->beverageColor = $entityBeverage->getBeverageColor();
        $this->beverageName = $entityBeverage->getName();
        $this->beveragePrice = $entityBeverage->getPrice();
    }

    /**
     * @param string $name
     *
     * @return mixed|null
     */
    public function __get($name){
        return $this->$name;
    }

} 