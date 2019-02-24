<?php

namespace App\Factory;

use App\Factory\BeverageInterface;
use App\Entity\Beverage;

abstract class BeverageAbstract implements BeverageInterface
{
    protected $packingVolume; // Объём упаковки
    protected $packingMatrial; // Материал упаковки
    protected $beverageType; // Тип упоковки
    protected $beverageColor; // Цвет напитка
    protected $beverageName; // Название напитка

    public function __construct($orm, $id)
    {
        $beverage = $orm->getRepository(Beverage::class)->find($id);

        $this->beverageType = $beverage->getBeverageType()->getName();
        $this->beverageColor = $beverage->getBeverageColor();
        $this->beverageName = $beverage->getName();
    }

} 