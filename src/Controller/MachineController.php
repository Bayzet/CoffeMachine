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
            foreach($this::MONEY['note'] as $note){
                $diff = floor($delivery/$note);
                if($diff >= 1)
                    $tmp['note'][$note] = $diff;
            }
            foreach($this::MONEY['coin'] as $coin){
                $diff = floor($delivery/$coin);
                if($diff >= 1)
                    $tmp['coin'][$coin] = $diff;
            }
            // За счёт того, что в константе MONEY наминал расположен упорядоченно
            // достаточно ksort и последнего элемента массива для понимания
            ksort($tmp);
            $tmp2 = [];
            foreach($tmp as $key => $money){
                // dump($value);
                foreach($money as $key => $value){
                    if(count($value) > 0){
                        $tmp2[$key] = $value;
                    }
                }
            }
            ksort($tmp2);

            // На этом этапе в $tmp2 всегда последний элемент самый подходящий
            // И последний элемент всегда тот номинал которого нужно меньше всего чтобы вернуть сдачу
            $i = 1;
            $countTmp2 = count($tmp2);
            $noteList = $this::MONEY['note'];
            $coinList = $this::MONEY['coin'];
            foreach($tmp2 as $key => $value){
                if($i++ == $countTmp2){
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