<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TemoignagesRepository")
 */
class Temoignages
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $nom;

    /**
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $nomentreprise;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $siteentreprise;

    /**
     * @ORM\Column(type="string")
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $temoignage;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     *
     * @return self
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNomentreprise()
    {
        return $this->nomentreprise;
    }

    /**
     * @param mixed $nomentreprise
     *
     * @return self
     */
    public function setNomentreprise($nomentreprise)
    {
        $this->nomentreprise = $nomentreprise;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSiteentreprise()
    {
        return $this->siteentreprise;
    }

    /**
     * @param mixed $siteentreprise
     *
     * @return self
     */
    public function setSiteentreprise($siteentreprise)
    {
        $this->siteentreprise = $siteentreprise;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     *
     * @return self
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTemoignage()
    {
        return $this->temoignage;
    }

    /**
     * @param mixed $temoignage
     *
     * @return self
     */
    public function setTemoignage($temoignage)
    {
        $this->temoignage = $temoignage;

        return $this;
    }
}
