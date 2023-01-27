<?php

namespace App\Entity;

use App\Repository\BlogRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: 
BlogRepository::class)]
Class Blog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length:100)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT, nullable:true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $publie = null;

    #[ORM\Column(type: 'boolean')]
    private $activ = true;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $miseAJour = null;

    #[ORM\Column(length:255)]
    private ?string $fichier = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of titre
     */ 
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */ 
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of publie
     */ 
    public function getPublie()
    {
        return $this->publie;
    }

    /**
     * Set the value of publie
     *
     * @return  self
     */ 
    public function setPublie($publie)
    {
        $this->publie = $publie;

        return $this;
    }

    /**
     * Get the value of activ
     */ 
    public function getActiv()
    {
        return $this->activ;
    }

    /**
     * Set the value of activ
     *
     * @return  self
     */ 
    public function setActiv($activ)
    {
        $this->activ = $activ;

        return $this;
    }

    /**
     * Get the value of miseAJour
     */ 
    public function getMiseAJour()
    {
        return $this->miseAJour;
    }

    /**
     * Set the value of miseAJour
     *
     * @return  self
     */ 
    public function setMiseAJour($miseAJour)
    {
        $this->miseAJour = $miseAJour;

        return $this;
    }

    /**
     * Get the value of fichier
     */ 
    public function getFichier()
    {
        return $this->fichier;
    }

    /**
     * Set the value of fichier
     *
     * @return  self
     */ 
    public function setFichier($fichier)
    {
        $this->fichier = $fichier;

        return $this;
    }
}