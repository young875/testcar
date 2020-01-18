<?php

namespace App\Controller\Admin;

use App\Entity\Cars;
use App\Form\CarsType;
use App\Repository\CarsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    /**
     * @Route("/admin/cars", name="admin_cars")
     * @param CarsRepository $repository
     * @return Response
     */
    public function index(CarsRepository $repository):Response
    {
        $cars = $repository->findAll();
        return $this->render('admin/car/index.html.twig', [
            'cars' => $cars,
        ]);
    }

    /**
     * @Route("/admin/car/pulie/{id}", name="admin_car_pulie")
     * @param Cars $cars
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function publie(Cars $cars, EntityManagerInterface $manager):Response
    {
        if ($cars->getPublie() == 0){
            $cars = $cars->setPublie(true);
            $manager->persist($cars);
            $manager->flush();
            $this->addFlash(
                "success", "La voiture <strong>{$cars->getModel()} </strong> a bien été bien publier sur le site!"
            );
        }else{
            $cars = $cars->setPublie(false);
            $manager->persist($cars);
            $manager->flush();
            $this->addFlash(
                "warning", "La voiture <strong>{$cars->getModel()} </strong> a bien été bien retirer du site!" );
        }

        return $this->redirectToRoute('admin_cars');
    }

    /**
     * @Route("/admin/car/add", name="admin_car_add")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function addCar(Request $request, EntityManagerInterface $manager):Response
    {
        $car = new Cars();

        $form = $this->createForm(CarsType::class, $car);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            foreach ($car->getImages() as $image ){
                $image->setCars($car);
                $manager->persist($image);
            }
            $manager->persist($car);
            $manager->flush();
            $this->addFlash(
                "success", "La voiture <strong>{$car->getSlug()} </strong> a bien été enrégistrée!"
            );
            return $this->redirectToRoute('admin_cars');
        }

        return $this->render('admin/car/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/car/update/{id}", name="admin_car_update")
     * @param Cars $car
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function update(Cars $car, Request $request, EntityManagerInterface $manager) :Response
    {

        $form = $this->createForm(CarsType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($car);
            $manager->flush();
            $this->addFlash(
                "success", "La voiture <strong>{$car->getModel()} </strong> a bien été modifier!"
            );

            return $this->redirectToRoute('admin_cars');
        }
        return $this->render('admin/car/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
