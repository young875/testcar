<?php

namespace App\Entity;


use Symfony\Component\Validator\Constraints as Assert;


class Contact {

    const TITRE =[
        'MME.' => 'MME.',
        'M.' => 'M.'
    ];

    const DEMAMDE =[
        "Demande de réservation du véhicule" => 'Demande de réservation du véhicule',
        'Demande d\'éssai du véhicule' => 'Demande d\'éssai du véhicule',
        'Demande d\'informations sur le véhicule' => 'Demande d\'informations sur le véhicule',
        'Réclamation sur le véhicule' => 'Réclamation sur le véhicule'
    ];


    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min="3", max="255")
     */
    private $titre;

    /**
     * @var Cars|null
     */
    private $car;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min="3", max="255")
     */
    private $prenom;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min="3", max="255")
     */
    private $nom;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $mail;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/[0-9]/"
     * )
     */
    private $telephone;


    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min="3", max="255")
     */
    private $damande;

    /**
     * @return string
     */
    public function getTitre(): ?string
    {
        return $this->titre;
    }

    /**
     * @return Cars
     */
    public function getCar(): ?Cars
    {
        return $this->car;
    }

    /**
     * @param Cars $car
     * @return Contact
     */
    public function setCar(?Cars $car): Contact
    {
        $this->car = $car;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     * @return Contact
     */
    public function setPrenom(?string $prenom): Contact
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * @return string
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return Contact
     */
    public function setNom(?string $nom): Contact
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string
     */
    public function getMail(): ?string
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     * @return Contact
     */
    public function setMail(?string $mail): Contact
    {
        $this->mail = $mail;
        return $this;
    }

    /**
     * @return string
     */
    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     * @return Contact
     */
    public function setTelephone(?string $telephone): Contact
    {
        $this->telephone = $telephone;
        return $this;
    }

    /**
     * @return string
     */
    public function getDamande(): ?string
    {
        return $this->damande;
    }

    /**
     * @param string $damande
     * @return Contact
     */
    public function setDamande(?string $damande): Contact
    {
        $this->damande = $damande;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return Contact
     */
    public function setMessage(?string $message): Contact
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @param string $titre
     * @return Contact
     */
    public function setTitre(?string $titre): Contact
    {
        $this->titre = $titre;
        return $this;
    }

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min="20")
     */
    private $message;

}