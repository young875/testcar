<?php

namespace App\Controller\Admin;

use App\Entity\Etats;
use App\Form\EtatsType;
use App\Repository\EtatsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtatsController extends AbstractController
{
    /**
     * @Route("/admin/etats", name="admin_etats")
     * @param EtatsRepository $repo
     * @return Response
     */
    public function index(EtatsRepository $repo) :Response
    {
        $etats = $repo->findAll();
        return $this->render('admin/etats/index.html.twig', [
            'etats' => $etats,
        ]);
    }

    /**
     * @Route("/admin/etat/add", name="admin_etat_add")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager) :Response
    {
        $etat = new Etats();

        $form = $this->createForm(EtatsType::class, $etat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($etat);
            $manager->flush();
            $this->addFlash(
                "success", "Le type d'état <strong>{$etat->getEtat()} </strong> a bien été enrégistrée!"
            );

            return $this->redirectToRoute('admin_etats');
        }
        return $this->render('admin/etats/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/etat/update/{id}", name="admin_etat_update")
     * @param Etats $etats
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function update(Etats $etats, Request $request, EntityManagerInterface $manager) :Response
    {

        $form = $this->createForm(EtatsType::class, $etats);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($etats);
            $manager->flush();
            $this->addFlash(
                "success", "Le type d'état <strong>{$etats->getEtat()} </strong> a bien été modifier!"
            );

            return $this->redirectToRoute('admin_etats');
        }
        return $this->render('admin/etats/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/admin/etat/delete/{id}", name="admin_etat_delete")
     * @param Etats $etats
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(Etats $etats, EntityManagerInterface $manager) :Response
    {

        $manager->remove($etats);
        $manager->flush();
        $this->addFlash(
            "danger", "Le type d'état <strong>{$etats->getEtat()} </strong> a bien été supprimer!"
        );
        return $this->redirectToRoute('admin_etats');
    }
}
