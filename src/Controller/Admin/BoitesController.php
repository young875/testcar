<?php

namespace App\Controller\Admin;

use App\Entity\Boites;
use App\Form\BoitesType;
use App\Repository\BoitesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoitesController extends AbstractController
{
    /**
     * @Route("/admin/boites", name="admin_boites")
     * @param BoitesRepository $repo
     * @return Response
     */
    public function index(BoitesRepository $repo) :Response
    {
        $boites = $repo->findAll();
        return $this->render('admin/boites/index.html.twig', [
            'boites' => $boites,
        ]);
    }

    /**
     * @Route("/admin/boite/add", name="admin_boite_add")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager) :Response
    {
        $boite = new Boites();

        $form = $this->createForm(BoitesType::class, $boite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($boite);
            $manager->flush();
            $this->addFlash(
                "success", "Le type de boite <strong>{$boite->getBoite()} </strong> a bien été enrégistrée!"
            );

            return $this->redirectToRoute('admin_boites');
        }
        return $this->render('admin/boites/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/boite/update/{id}", name="admin_boite_update")
     * @param Boites $boite
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function update(Boites $boite, Request $request, EntityManagerInterface $manager) :Response
    {

        $form = $this->createForm(BoitesType::class, $boite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($boite);
            $manager->flush();
            $this->addFlash(
                "success", "Le type de boite <strong>{$boite->getBoite()} </strong> a bien été modifier!"
            );

            return $this->redirectToRoute('admin_boites');
        }
        return $this->render('admin/boites/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/admin/boite/delete/{id}", name="admin_boite_delete")
     * @param Boites $boite
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(Boites $boite, EntityManagerInterface $manager) :Response
    {

        $manager->remove($boite);
        $manager->flush();
        $this->addFlash(
            "danger", "Le type de boite <strong>{$boite->getBoite()} </strong> a bien été supprimer!"
        );
        return $this->redirectToRoute('admin_boites');
    }
}
