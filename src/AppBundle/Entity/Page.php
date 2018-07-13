<?php


namespace AppBundle\Entity;

use Sonata\TranslationBundle\Model\Gedmo\AbstractPersonalTranslatable;
use Gedmo\Mapping\Annotation as Gedmo;
use Sonata\TranslationBundle\Model\Gedmo\TranslatableInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="page")
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\Translation\PageTranslation")
 */
class Page extends AbstractPersonalTranslatable implements TranslatableInterface
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="string", unique=true)
     * @Gedmo\Slug(fields={"pageTitle"})
     */
    private $pageSlug;

    /**
     * @ORM\Column(type="string")
     * @Gedmo\Translatable
     */
    private $pageTitle;

    /**
     * @ORM\Column(type="text")
     * @Gedmo\Translatable
     */
    private $pageText;

    /**
     * @ORM\Column(type="string")
     */
    private $pageOgImage;

    /**
     * @ORM\Column(type="string")
     * @Gedmo\Translatable
     */
    private $pageMetaKeywords;

    /**
     * @ORM\Column(type="string")
     * @Gedmo\Translatable
     */
    private $pageMetaDescription;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(
     *     targetEntity="AppBundle\Entity\Translation\PageTranslation",
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
    public function getPageSlug()
    {
        return $this->pageSlug;
    }

    /**
     * @param mixed $pageSlug
     */
    public function setPageSlug($pageSlug)
    {
        $this->pageSlug = $pageSlug;
    }

    /**
     * @return mixed
     */
    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    /**
     * @param mixed $pageTitle
     */
    public function setPageTitle($pageTitle)
    {
        $this->pageTitle = $pageTitle;
    }

    /**
     * @return mixed
     */
    public function getPageText()
    {
        return $this->pageText;
    }

    /**
     * @param mixed $pageText
     */
    public function setPageText($pageText)
    {
        $this->pageText = $pageText;
    }

    /**
     * @return mixed
     */
    public function getPageOgImage()
    {
        return $this->pageOgImage;
    }

    /**
     * @param mixed $pageOgImage
     */
    public function setPageOgImage($pageOgImage)
    {
        $this->pageOgImage = $pageOgImage;
    }

    /**
     * @return mixed
     */
    public function getPageMetaKeywords()
    {
        return $this->pageMetaKeywords;
    }

    /**
     * @param mixed $pageMetaKeywords
     */
    public function setPageMetaKeywords($pageMetaKeywords)
    {
        $this->pageMetaKeywords = $pageMetaKeywords;
    }

    /**
     * @return mixed
     */
    public function getPageMetaDescription()
    {
        return $this->pageMetaDescription;
    }

    /**
     * @param mixed $pageMetaDescription
     */
    public function setPageMetaDescription($pageMetaDescription)
    {
        $this->pageMetaDescription = $pageMetaDescription;
    }


}