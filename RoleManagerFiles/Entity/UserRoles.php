<?php
/**
 * Created by PhpStorm.
 * User: Name
 * Date: 5/24/2018
 * Time: 3:54 PM
 */

namespace AppBundle\Entity;

use Sonata\TranslationBundle\Model\Gedmo\AbstractPersonalTranslatable;
use Gedmo\Mapping\Annotation as Gedmo;
use Sonata\TranslationBundle\Model\Gedmo\TranslatableInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_roles")
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\Translation\UserRolesTranslation")
 */

class UserRoles extends AbstractPersonalTranslatable implements TranslatableInterface{

    public function __construct()
    {
        $this->adminPagesToAccess = new ArrayCollection();
    }

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
    private $roleName;


    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\AdminPagesToAccess")
     */
    private $adminPagesToAccess;


    /**
     * @ORM\Column(type="string")
     */
    private $oldName;

    /**
     * @return mixed
     */
    public function getOldName()
    {
        return $this->oldName;
    }

    /**
     * @param mixed $oldName
     */
    public function setOldName($oldName)
    {
        $this->oldName = $oldName;
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
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getRoleName()
    {
        return $this->roleName;
    }

    /**
     * @param mixed $roleName
     */
    public function setRoleName($roleName)
    {
        $this->roleName = $roleName;
    }

    /**
     * @return mixed
     */
    public function getAdminPagesToAccess()
    {
        return $this->adminPagesToAccess;
    }

    /**
     * @param mixed $adminPagesToAccess
     */
    public function setAdminPagesToAccess($adminPagesToAccess)
    {
        $this->adminPagesToAccess = $adminPagesToAccess;
    }

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(
     *     targetEntity="AppBundle\Entity\Translation\UserRolesTranslation",
     *     mappedBy="object",
     *     cascade={"persist", "remove"}
     * )
     */
    protected $translations;
}