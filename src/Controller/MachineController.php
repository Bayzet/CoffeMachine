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
        "note" => [50,100,500,1000], // Купюры
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
        $delivery = $this->payment($payDepositing - $beverage->beveragePrice);
        $result = [
            'beverage' => $beverage,
            'delivery' => $delivery
        ];

        return $this->render('machine/order.html.twig',[ 
            "order" => $result
         ]);
    }

    /**
     * Метод расчитывает сдачу наименьшим количеством купюр и/или монет
     * 
     * @param int $delivery - размер сдачи
     * @return array
     */
    public function payment($delivery){
        static $result = [
            'amount' => 0,
            'note' => [],
            'coin' => []
        ];
        static $itteration = 0;

        // Если это первая иттерация рекурсии то сохраняем значение сдачи
        if($itteration++ == 0)
            $result['amount'] = $delivery;

        if($delivery != 0){
            $tmp = [];
            // Считаем сколько едениц каждого наминала нам понадобится
            // и добавляем в массив только подходящие
            foreach($this::MONEY as $money){
                foreach($money as $value){
                    $diff = floor($delivery/$value);
                    if($diff >= 1)
                        $tmp[$value] = $diff;
                }
            }
            ksort($tmp);

            // После ksort в $tmp всегда последний элемент это номинал
            // наименьшее количество которого нам нужно для сдачи
            $i = 1;
            $countTmp = count($tmp);
            $noteList = $this::MONEY['note'];
            $coinList = $this::MONEY['coin'];
            foreach($tmp as $key => $value){
                if($i++ == $countTmp){
                    if(in_array($key, $noteList)){
                        $result['note'][$key] = $value;
                        $delivery -= $key * $value;
                    }elseif(in_array($key, $coinList)){
                        $result['coin'][$key] = $value;
                        $delivery -= $key * $value;
                    }
                }
            }
            
            return $this->payment($delivery);
        }else{
            return $result;
        }
    }

}