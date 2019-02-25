<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Factory\BeverageFactory;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Beverage;


class MachineController extends AbstractController
{
    // Поддерживаемые номиналы
    const MONEY = [
        "note" => [10,50,100,500,1000], // Купюры
        "coin" => [1,2,5,10] // Монеты
    ];

    /**
     * @Route("/")
     */
    public function index()
    {
        $beverages = $this->getDoctrine()
            ->getRepository(Beverage::class)
            ->findAll();

        return $this->render('machine/index.html.twig',[
            'beverages' => $beverages,
            'money' => $this::MONEY,
            'money_json' => json_encode($this::MONEY)
        ]);
    }

    /**
     * @Route("/order")
     */
    public function order(Request $request)
    {
        $id = $request->get('beverageId');
        $payDepositing = $request->get('payDepositing');

        $entityBeverage = $this->getDoctrine()->getRepository(Beverage::class)->find($id);
        $factory = new BeverageFactory();
        $beverage = $factory->createBeverage($entityBeverage);
        $result = [
            'beverage' => $beverage,
            'delivery' => $this->payment($payDepositing, $beverage->beveragePrice)
        ];

        return $this->render('machine/order.html.twig',[ 
            "order" => $result
         ]);
    }

    
    public function payment($payDepositing, $beveragePrice){
        return $payDepositing - $beveragePrice;
    }

}