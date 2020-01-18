<?php

namespace App\Controller;

use App\Repository\CarsRepository;
use App\Repository\MarquesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    /**
     * @Route("/car", name="car")
     * @param CarsRepository $car
     * @param MarquesRepository $marques
     * @return Response
     */
    public function index(CarsRepository $car,MarquesRepository $marques):Response
    {
        $marques = $marques->findAll();
        $carnb = $car->findAll();
        $lastCars = $car->findFour();
        $nbCar = count($carnb);
        return $this->render('car/index.html.twig', [
            'marques' => $marques,
            'nbr' => $nbCar,
            'lastCars' => $lastCars
        ]);
    }
}
