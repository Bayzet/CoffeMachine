<?php

namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Service\PaymentService;

class PaymentServiceTest extends TestCase
{
    public function testCalculate()
    {
        $payment = new PaymentService();
        $result = $payment->calculate(440);

        $expected = [
            'amount' => 440,
            'note' => [
                '100' => 4.0
            ],
            'coin' => [
                '10' => 4.0
            ]
        ];
        $this->assertEquals($result, $expected);
    }
}