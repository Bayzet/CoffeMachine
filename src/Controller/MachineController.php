<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class MachineController extends AbstractController
{

    /**
     * @Route("/{name}")
     */
    public function index($name)
    {
        return $this->render('machine/index.html.twig',[
            'title' => 'Добро пожаловать в приложение Coffe Machine',
            'name' => $name
        ]);
    }

}