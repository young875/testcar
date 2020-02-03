<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use App\Repository\CarsRepository;
use App\Repository\MarquesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/marques/{slug}", name="page_marque")
     * @param $slug
     * @param CarsRepository $car
     * @param MarquesRepository $marquesRepository
     * @param CarsRepository $carsRepository
     * @return Response
     */
    public function marque($slug ,CarsRepository $car,MarquesRepository $marquesRepository, CarsRepository $carsRepository):Response
    {

        $marques = $marquesRepository->findOneBySlug($slug);
        if (!$marques){
            return $this->redirectToRoute('home');
        }
        $marquesListe = $marquesRepository->findAll();

        $vehicules = $carsRepository->findByMarque($marques->getId());
        $carnb = $car->findAll();
        $nbCar = count($carnb);

        return $this->render('home/marque.html.twig', [
            'marques' => $marquesListe,
            'marque' => $marques,
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
     * @param Request $request
     * @param ContactNotification $notification
     * @return Response
     */
    public function show($slug ,CarsRepository $car,MarquesRepository $marquesRepository, CarsRepository $carsRepository,Request $request, ContactNotification $notification ):Response
    {
        $marquesListe = $marquesRepository->findAll();
        $cars = $carsRepository->findOneBySlug($slug);
        if (!$cars){
            return $this->redirectToRoute('home');
        }


        $contact = new Contact();

        $carnb = $car->findAll();
        $nbCar = count($carnb);
        $ref = uniqid();
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $contact->setCar($cars);
            $contact->setTitre($_POST['contact']['titre']);
            $contact->setPrenom($_POST['contact']['prenom']);
            $contact->setNom($_POST['contact']['nom']);
            $contact->setMail($_POST['contact']['mail']);
            $contact->setTelephone($_POST['contact']['telephone']);
            $contact->setDamande($_POST['contact']['demande']);
            $contact->setMessage($_POST['contact']['message']);
            $notification->notify($contact);
            $this->addFlash(
                "success", "Votre message à bien été envoyer"
            );
            $this->redirectToRoute('page_car',['slug' => $slug]);
        }

        return $this->render('home/show.html.twig', [
            'marques' => $marquesListe,
            'nbr' => $nbCar,
            'cars' => $cars,
            'ref' => $ref,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/contact", name="contact_page")
     * @param CarsRepository $car
     * @param MarquesRepository $marquesRepository
     * @return Response
     */
    public function contact(CarsRepository $car,MarquesRepository $marquesRepository):Response
    {
        $marquesListe = $marquesRepository->findAll();
        $carnb = $car->findAll();
        $nbCar = count($carnb);

        return $this->render('home/contact.html.twig', [
            'marques' => $marquesListe,
            'nbr' => $nbCar,

        ]);
    }

    /**
     * @Route("/mention-legales", name="legal_page")
     * @param CarsRepository $car
     * @param MarquesRepository $marquesRepository
     * @return Response
     */
    public function legal(CarsRepository $car,MarquesRepository $marquesRepository):Response
    {
        $marquesListe = $marquesRepository->findAll();
        $carnb = $car->findAll();
        $nbCar = count($carnb);

        return $this->render('home/legal.html.twig', [
            'marques' => $marquesListe,
            'nbr' => $nbCar,
        ]);
    }
}
