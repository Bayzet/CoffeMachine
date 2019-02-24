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

    /**
     * @Route("/")
     */
    public function index()
    {
        $beverages = $this->getDoctrine()
            ->getRepository(Beverage::class)
            ->findAll();

        return $this->render('machine/index.html.twig',[
            'beverages' => $beverages
        ]);
    }

    /**
     * @Route("/order")
     */
    public function order(Request $request)
    {
        $id = $request->get('beverageId');
        $type = $request->get('beverageTypeId');
        $factory = new BeverageFactory();
        dump($factory->createBeverage($this->getDoctrine(), $id, $type));
        $order = [
            'beverage' => 'test'
        ];
        return $this->render('machine/order.html.twig',[
            'order' => $order
        ]);
    }

}