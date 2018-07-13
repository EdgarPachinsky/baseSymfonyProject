<?php

namespace AppBundle\Entity\Translation;

use Doctrine\ORM\Mapping as ORM;
use Sonata\TranslationBundle\Model\Gedmo\AbstractPersonalTranslation;

/**
 * @ORM\Entity
 * @ORM\Table(name="page_translation",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="page_translation_idx", columns={
 *         "locale", "object_id", "field"
 *     })}
 * )
 */
class PageTranslation extends AbstractPersonalTranslation
{

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Page", inversedBy="translations")
     * @ORM\JoinColumn(name="object_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $object;

}