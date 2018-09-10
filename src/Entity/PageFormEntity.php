<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PageFormEntityRepository")
 */
class PageFormEntity
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
     * @ORM\Column(type="float")
     */
    
    private $portable;

    /**
     * @var \DateTime
     * @ORM\Column(name="create_at", type="datetime", nullable=false)
     */

    private $date;

    public function __construct()
    {
        $this->date = new \DateTime();
    }

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
    public function getPortable()
    {
        return $this->portable;
    }

    /**
     * @param mixed $portable
     *
     * @return self
     */
    public function setPortable($portable)
    {
        $this->portable = $portable;

        return $this;
    }
}
