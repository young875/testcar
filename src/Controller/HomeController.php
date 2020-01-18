<?php

namespace App\Controller;

use App\Entity\Marques;
use App\Repository\CarsRepository;
use App\Repository\MarquesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{


    /**
     * @Route("/", name="home")
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

        return $this->render('home/index.html.twig', [
            'marques' => $marques,
            'nbr' => $nbCar,
            'lastCars' => $lastCars
        ]);
    }

    /**
     * @Route("/marques/{marque}", name="page_marque")
     * @param $marque
     * @param CarsRepository $car
     * @param MarquesRepository $marquesRepository
     * @param CarsRepository $carsRepository
     * @return Response
     */
    public function marque($marque ,CarsRepository $car,MarquesRepository $marquesRepository, CarsRepository $carsRepository):Response
    {
        $marquesListe = $marquesRepository->findAll();
        $marques = $marquesRepository->findByMarque($marque);
        $vehicules = $carsRepository->findByMarque($marques[0]->getId());
        $carnb = $car->findAll();
        $nbCar = count($carnb);

        return $this->render('home/marque.html.twig', [
            'marques' => $marquesListe,
            'marque' => $marque,
            'vehicules' => $vehicules,
            'nbr' => $nbCar,
        ]);
    }


    /**
     * @Route("/show/{slug}", name="page_car")
     * @param $slug
     * @param CarsRepository $car
     * @param MarquesRepository $marquesRepository
     * @param CarsRepository $carsRepository
     * @return Response
     */
    public function show($slug ,CarsRepository $car,MarquesRepository $marquesRepository, CarsRepository $carsRepository):Response
    {
        $marquesListe = $marquesRepository->findAll();
        $cars = $carsRepository->findOneBySlug($slug);
        $carnb = $car->findAll();
        $nbCar = count($carnb);
        $ref = uniqid();

        return $this->render('home/show.html.twig', [
            'marques' => $marquesListe,
            'nbr' => $nbCar,
            'cars' => $cars,
            'ref' => $ref,
        ]);
    }



    /**
     * @Route("/contact", name="contact_page")
     */
    public function contact()
    {
        return $this->render('home/contact.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/mention-legales", name="legal_page")
     */
    public function legal()
    {
        return $this->render('home/legal.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
