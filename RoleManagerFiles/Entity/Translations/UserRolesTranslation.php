<?php
/**
 * Created by PhpStorm.
 * User: Name
 * Date: 5/24/2018
 * Time: 4:03 PM
 */

namespace AppBundle\Entity\Translation;

use Doctrine\ORM\Mapping as ORM;
use Sonata\TranslationBundle\Model\Gedmo\AbstractPersonalTranslation;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_roles_translation",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="user_roles_translation_idx", columns={
 *         "locale", "object_id", "field"
 *     })}
 * )
 */
class UserRolesTranslation extends AbstractPersonalTranslation
{

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\UserRoles", inversedBy="translations")
     * @ORM\JoinColumn(name="object_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $object;

}