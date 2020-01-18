<?php

namespace App\Controller\Admin;


use App\Entity\Carburations;
use App\Form\CarburationType;
use App\Repository\CarburationsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarburationsController extends AbstractController
{
    /**
     * @Route("/admin/carburations", name="admin_carburations")
     * @param CarburationsRepository $repo
     * @return Response
     */
    public function index(CarburationsRepository $repo) :Response
    {
        $carburations = $repo->findAll();
        return $this->render('admin/carburations/index.html.twig', [
            'carburations' => $carburations,
        ]);
    }

    /**
     * @Route("/admin/carburation/add", name="admin_carburation_add")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager) :Response
    {
        $carburation = new Carburations();

        $form = $this->createForm(CarburationType::class, $carburation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($carburation);
            $manager->flush();
            $this->addFlash(
                "success", "Le type de carburation <strong>{$carburation->getCarburation()} </strong> a bien été enrégistrée!"
            );

            return $this->redirectToRoute('admin_carburations');
        }
        return $this->render('admin/carburations/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/carburation/update/{id}", name="admin_carburation_update")
     * @param Carburations $carburations
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function update(Carburations $carburations, Request $request, EntityManagerInterface $manager) :Response
    {

        $form = $this->createForm(CarburationType::class, $carburations);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($carburations);
            $manager->flush();
            $this->addFlash(
                "success", "Le type de carburation <strong>{$carburations->getCarburation()} </strong> a bien été modifier!"
            );

            return $this->redirectToRoute('admin_carburations');
        }
        return $this->render('admin/carburations/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/admin/carburation/delete/{id}", name="admin_carburation_delete")
     * @param Carburations $carburation
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(Carburations $carburation, EntityManagerInterface $manager) :Response
    {

        $manager->remove($carburation);
        $manager->flush();
        $this->addFlash(
            "danger", "Le type de carburation <strong>{$carburation->getCarburation()} </strong> a bien été supprimer!"
        );
        return $this->redirectToRoute('admin_carburations');
    }
}
