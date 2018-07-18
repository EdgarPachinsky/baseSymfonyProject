<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Contact;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AdminPagesToAccessAdmin extends AbstractAdmin
{


    protected function getRoutes_(){
        return  $this->getRoutes();
    }


    public function toString($object)
    {
        return $object instanceof AdminPagesToAccess
            ? $object->getPageName()
            : 'Name';
    }

    protected function configureFormFields(FormMapper $formMapper)
    {

        $formMapper
            ->add('pageName');

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('pageName');

    }

    protected function configureListFields(ListMapper $listMapper)
    {

        $listMapper
            ->add('pageName')
            ->add('_action', null, array(
            'actions' => array(
                'edit' => array()
                )
            ))
        ;

    }

    protected $datagridValues = array(
        '_sort_order' => 'ASC',
    );

}