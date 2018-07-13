<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="icon")
 */
class Icon
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /*
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Advantage", mappedBy="icon")
     */
   // private $advantage;


    /**
     * @ORM\Column(type="string")
     */
    private $iconCode;

    /**
     * @ORM\Column(type="string")
     */
    private $iconName;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getIconCode()
    {
        return $this->iconCode;
    }

    /**
     * @param mixed $iconCode
     */
    public function setIconCode($iconCode)
    {
        $this->iconCode = $iconCode;
    }

    /**
     * @return mixed
     */
    public function getIconName()
    {
        return $this->iconName;
    }

    /**
     * @param mixed $iconName
     */
    public function setIconName($iconName)
    {
        $this->iconName = $iconName;
    }

}