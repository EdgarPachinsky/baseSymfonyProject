<?php

namespace AppBundle\Entity\Translation;

use Doctrine\ORM\Mapping as ORM;
use Sonata\TranslationBundle\Model\Gedmo\AbstractPersonalTranslation;

/**
 * @ORM\Entity
 * @ORM\Table(name="admin_pages_to_access_translation",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="admin_pages_to_access_translation_idx", columns={
 *         "locale", "object_id", "field"
 *     })}
 * )
 */
class AdminPagesToAccessTranslation extends AbstractPersonalTranslation
{

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AdminPagesToAccess", inversedBy="translations")
     * @ORM\JoinColumn(name="object_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $object;

}