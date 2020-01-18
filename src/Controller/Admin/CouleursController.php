<?php

namespace App\Controller\Admin;

use App\Entity\Couleurs;
use App\Form\CouleursType;
use App\Repository\CouleursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CouleursController extends AbstractController
{
    /**
     * @Route("/admin/couleurs", name="admin_couleurs")
     * @param CouleursRepository $repo
     * @return Response
     */
    public function index(CouleursRepository $repo) :Response
    {
        $couleurs = $repo->findAll();
        return $this->render('admin/couleurs/index.html.twig', [
            'couleurs' => $couleurs,
        ]);
    }

    /**
     * @Route("/admin/couleur/add", name="admin_couleur_add")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager) :Response
    {
        $couleur = new Couleurs();

        $form = $this->createForm(CouleursType::class, $couleur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($couleur);
            $manager->flush();
            $this->addFlash(
                "success", "La couleur <strong>{$couleur->getCouleur()} </strong> a bien été enrégistrée!"
            );

            return $this->redirectToRoute('admin_couleurs');
        }
        return $this->render('admin/couleurs/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/couleur/update/{id}", name="admin_couleur_update")
     * @param Couleurs $couleurs
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function update(Couleurs $couleurs, Request $request, EntityManagerInterface $manager) :Response
    {

        $form = $this->createForm(CouleursType::class, $couleurs);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($couleurs);
            $manager->flush();
            $this->addFlash(
                "success", "La couleur <strong>{$couleurs->getCouleur()} </strong> a bien été modifier!"
            );

            return $this->redirectToRoute('admin_couleurs');
        }
        return $this->render('admin/couleurs/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/admin/couleur/delete/{id}", name="admin_couleur_delete")
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(Couleurs $couleurs, EntityManagerInterface $manager) :Response
    {

        $manager->remove($couleurs);
        $manager->flush();
        $this->addFlash(
            "danger", "La couleur <strong>{$couleurs->getCouleur()} </strong> a bien été supprimer!"
        );
        return $this->redirectToRoute('admin_couleurs');
    }
}
