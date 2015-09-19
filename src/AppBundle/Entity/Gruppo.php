<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gruppo
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Gruppo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255)
     */
    private $nome;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Utenti", mappedBy="gruppo")
     */
    private $utenti;

     /**
     * Creates a Doctrine Collection for members.
     */
    public function __construct()
    {
        $this->utenti = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Override __toString() method to return the name of the group
     * @return mixed
     */
    public function __toString()
    {
       return $this->nome;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return Gruppo
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }


    public function setUtenti($utenti)
    {
        $this->utenti = $utenti;
    }

    public function getUtenti()
    {
        return $this->utenti;
    }
}

