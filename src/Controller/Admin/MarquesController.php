<?php

namespace App\Controller\Admin;


use App\Entity\Marques;
use App\Form\MarqueType;
use App\Repository\MarquesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MarquesController extends AbstractController
{
    /**
     * @Route("/admin/marques", name="admin_marques")
     * @param MarquesRepository $repo
     * @return Response
     */
    public function index(MarquesRepository $repo) :Response
    {
        $marques = $repo->findAll();
        return $this->render('admin/marques/index.html.twig', [
            'marques' => $marques,
        ]);
    }

    /**
     * @Route("/admin/marque/add", name="admin_marque_add")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager) :Response
    {
        $marque = new Marques();

        $form = $this->createForm(MarqueType::class, $marque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($marque);
            $manager->flush();
            $this->addFlash(
                "success", "Le type d'état <strong>{$marque->getMarque()} </strong> a bien été enrégistrée!"
            );

            return $this->redirectToRoute('admin_marques');
        }
        return $this->render('admin/marques/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/marque/update/{id}", name="admin_marque_update")
     * @param Marques $marques
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function update(Marques $marques, Request $request, EntityManagerInterface $manager) :Response
    {

        $form = $this->createForm(MarqueType::class, $marques);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($marques);
            $manager->flush();
            $this->addFlash(
                "success", "Le type d'état <strong>{$marques->getMarque()} </strong> a bien été modifier!"
            );

            return $this->redirectToRoute('admin_marques');
        }
        return $this->render('admin/marques/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/admin/marque/delete/{id}", name="admin_marque_delete")
     * @param Marques $marques
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(Marques $marques, EntityManagerInterface $manager) :Response
    {

        $manager->remove($marques);
        $manager->flush();
        $this->addFlash(
            "danger", "Le type d'état <strong>{$marques->getMarque()} </strong> a bien été supprimer!"
        );
        return $this->redirectToRoute('admin_marques');
    }
}
