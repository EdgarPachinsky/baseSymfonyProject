<?php

namespace AppBundle\Entity;

use Sonata\TranslationBundle\Model\Gedmo\AbstractPersonalTranslatable;
use Gedmo\Mapping\Annotation as Gedmo;
use Sonata\TranslationBundle\Model\Gedmo\TranslatableInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="contact")
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\Translation\ContactTranslation")
 */
class Contact extends AbstractPersonalTranslatable implements TranslatableInterface
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPrimary;

    /**
     * @ORM\Column(type="integer")
     */
    private $contactOrder;

    /**
     * @ORM\Column(type="string")
     * @Gedmo\Translatable
     */
    private $contactInfo;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ContactGroup", inversedBy="contact")
     */
    private $contactGroup;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(
     *     targetEntity="AppBundle\Entity\Translation\ContactTranslation",
     *     mappedBy="object",
     *     cascade={"persist", "remove"}
     * )
     */
    protected $translations;

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
    public function getIsPrimary()
    {
        return $this->isPrimary;
    }

    /**
     * @param mixed $isPrimary
     */
    public function setIsPrimary($isPrimary)
    {
        $this->isPrimary = $isPrimary;
    }

    /**
     * @return mixed
     */
    public function getContactOrder()
    {
        return $this->contactOrder;
    }

    /**
     * @param mixed $contactOrder
     */
    public function setContactOrder($contactOrder)
    {
        $this->contactOrder = $contactOrder;
    }

    /**
     * @return mixed
     */
    public function getContactInfo()
    {
        return $this->contactInfo;
    }

    /**
     * @param mixed $contactInfo
     */
    public function setContactInfo($contactInfo)
    {
        $this->contactInfo = $contactInfo;
    }

    /**
     * @return mixed
     */
    public function getContactGroup()
    {
        return $this->contactGroup;
    }

    /**
     * @param mixed $contactGroup
     */
    public function setContactGroup($contactGroup)
    {
        $this->contactGroup = $contactGroup;
    }

}