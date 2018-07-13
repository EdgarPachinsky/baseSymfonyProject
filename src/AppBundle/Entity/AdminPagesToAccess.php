<?php
/**
 * Created by PhpStorm.
 * User: Name
 * Date: 5/24/2018
 * Time: 3:56 PM
 */

namespace AppBundle\Entity;

use Sonata\TranslationBundle\Model\Gedmo\AbstractPersonalTranslatable;
use Gedmo\Mapping\Annotation as Gedmo;
use Sonata\TranslationBundle\Model\Gedmo\TranslatableInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="admin_pages_to_access")
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\Translation\PageTranslation")
 */

class AdminPagesToAccess extends AbstractPersonalTranslatable implements TranslatableInterface{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Gedmo\Translatable
     */
    private $pageName;


    /**
     * @ORM\Column(type="string")
     * @Gedmo\Translatable
     */
    private $pagePath;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPageName()
    {
        return $this->pageName;
    }

    /**
     * @param mixed $pageName
     */
    public function setPageName($pageName)
    {
        $this->pageName = $pageName;
    }

    /**
     * @return mixed
     */
    public function getPagePath()
    {
        return $this->pagePath;
    }

    /**
     * @param mixed $pagePath
     */
    public function setPagePath($pagePath)
    {
        $this->pagePath = $pagePath;
    }

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(
     *     targetEntity="AppBundle\Entity\Translation\AdminPagesToAccessTranslation",
     *     mappedBy="object",
     *     cascade={"persist", "remove"}
     * )
     */
    protected $translations;
}
