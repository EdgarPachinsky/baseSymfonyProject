<?php
/**
 * Created by PhpStorm.
 * User: Name
 * Date: 5/24/2018
 * Time: 4:41 PM
 */

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;


class UserPermissionsAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {

        $formMapper
            ->add('username')
            ->add('adminAccessRoles', 'entity', array(
                'class' => 'AppBundle\Entity\UserRoles',
                'choice_label' => "roleName",
                'required' => true,
                'multiple'=>true
            ))
        ;
        ;

    }


    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('username');

    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('username')
            ->add('_action', null, array(
                'actions' => array(
                    'edit' => array()
                )
            ))
        ;

    }

    public function preUpdate($object)
    {
        $rolesArray = [];
        foreach ($object->getAdminAccessRoles() as $role){
            array_push($rolesArray,$role->getRoleName());
        }

        dump($object->getRoles());die;
        $object->setRoles($rolesArray);
        $object->setRoleChange(1);
    }


    protected $datagridValues = array(
        '_sort_order' => 'ASC',
    );
}