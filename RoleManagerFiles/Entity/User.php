<?php
namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\UserRoles")
     */
    protected $adminAccessRoles;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $roleChange = 0;

    /**
     * @return mixed
     */
    public function getAdminAccessRoles()
    {
        return $this->adminAccessRoles;
    }

    /**
     * @param mixed $adminAccessRoles
     */
    public function setAdminAccessRoles($adminAccessRoles)
    {
        $this->adminAccessRoles = $adminAccessRoles;
    }

    /**
     * @return mixed
     */
    public function getRoleChange()
    {
        return $this->roleChange;
    }

    /**
     * @param mixed $roleChange
     */
    public function setRoleChange($roleChange)
    {
        $this->roleChange = $roleChange;
    }

    public function __construct()
    {
        parent::__construct();

    }
}