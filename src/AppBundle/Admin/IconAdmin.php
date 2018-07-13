<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Icon;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class IconAdmin extends AbstractAdmin
{

    public function toString($object)
    {
        return $object instanceof Icon
            ? $object->getIconName()
            : 'Icon'; // shown in the breadcrumb on the create view
    }
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('icon_name', 'text')
            ->add('icon_code', 'text')
            ;

    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('iconName')
            ->add('iconCode')
            ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper

            ->add('iconName')
            ->add('iconCode')
            ->add('_action', null, array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                )
            ));



    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('show');
    }

    protected $perPageOptions = array(16, 32, 64, 128, 192, 500, 1000);

    protected $datagridValues = array(
        '_sort_order' => 'ASC',
        '_sort_by' => 'iconName'
    );
}