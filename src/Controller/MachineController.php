<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Factory\BeverageFactory;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Beverage;
use App\Service\PaymentService;


class MachineController extends AbstractController
{

    /**
     * @Route("/")
     */
    public function index(PaymentService $payment)
    {
        $beverages = $this->getDoctrine()
            ->getRepository(Beverage::class)
            ->findAll();

        return $this->render('machine/index.html.twig',[
            'beverages' => $beverages,
            'money' => $payment::MONEY,
            'money_json' => json_encode($payment::MONEY)
        ]);
    }

    /**
     * @Route("/order")
     */
    public function order(Request $request, PaymentService $payment)
    {
        $id = $request->get('beverageId');
        $payDepositing = $request->get('payDepositing');

        $entityBeverage = $this->getDoctrine()->getRepository(Beverage::class)->find($id);
        $factory = new BeverageFactory();
        $beverage = $factory->createBeverage($entityBeverage);
        $fullDelivery = $payDepositing - $beverage->beveragePrice;
        $delivery = $payment->calculate($fullDelivery);

        $result = [
            'beverage' => [
                'beverageName'      => $beverage->beverageName,
                'beveragePrice'     => $beverage->beveragePrice,
                'beverageType'      => $beverage->beverageType,
                'beverageColor'     => $beverage->beverageColor,
                'packingVolume'     => $beverage->packingVolume,
                'packingMaterial'   => $beverage->packingMaterial,
            ],
            'delivery' => $delivery
        ];

        return $this->render('machine/order.html.twig',[ 
            "order" => $result
         ]);
    }

}