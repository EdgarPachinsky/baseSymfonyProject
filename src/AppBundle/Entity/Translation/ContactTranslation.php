<?php

namespace AppBundle\Entity\Translation;

use Doctrine\ORM\Mapping as ORM;
use Sonata\TranslationBundle\Model\Gedmo\AbstractPersonalTranslation;

/**
 * @ORM\Entity
 * @ORM\Table(name="contact_translation",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="contact_translation_idx", columns={
 *         "locale", "object_id", "field"
 *     })}
 * )
 */
class ContactTranslation extends AbstractPersonalTranslation
{

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Contact", inversedBy="translations")
     * @ORM\JoinColumn(name="object_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $object;

}