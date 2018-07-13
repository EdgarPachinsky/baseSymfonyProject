<?php

namespace AppBundle\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Yaml\Yaml;

class UserRolesAdmin extends AbstractAdmin
{

    public function toString($object)
    {
        return $object instanceof UserRoles
            ? $object->getRoleName()
            : 'Role Name';
    }

    protected function configureFormFields(FormMapper $formMapper)
    {

        $formMapper
            ->add('roleName')

            ->add('adminPagesToAccess', 'entity', array(
                'class' => 'AppBundle\Entity\AdminPagesToAccess',
                'choice_label' => "pageName",
                'required' => true,
                'multiple'=>true
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('roleName');

    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('roleName')
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

    /**
     * @param $object
     * done + working
     * needs some optimization
     */
    public function prePersist($object){
        $container = $this->getConfigurationPool()->getContainer();
        $rootDir = $container->get('kernel')->getRootDir();
        $file = sprintf(
            "%s/config/security.yml",
            $rootDir
        );
        $parsed = Yaml::parse(file_get_contents($file));

        //TODO: need to think about using key in second foreach , need to be removed , but now it is not working
        // without key
        foreach ($object->getAdminPagesToAccess() as $accessPage){
            $pagePath = $accessPage->getPagePath();

            foreach ($parsed['security']['access_control'] as $key => $accessControlItem){

                if($accessControlItem['path'] == $pagePath){
                    array_push($parsed['security']['access_control'][$key]['roles'],$object->getRoleName());
                }
            }
        }

        $object->setOldName($object->getRoleName());

        /**
         * Add new role to role hierarchy
         */
        $parsed['security']['role_hierarchy'][$object->getRoleName()] = $object->getRoleName();


        /**
         * Rewrite in security yml
         */
        $modifiedFile = Yaml::dump($parsed);
        file_put_contents($rootDir.'/config/security.yml', $modifiedFile);
    }


    /**
     * @param mixed $object
     */
    public function preRemove($object)
    {
        $objectRoleName            = $object->getRoleName();
        $objectAdminPagesToAccess  = $object->getAdminPagesToAccess();
        $container = $this->getConfigurationPool()->getContainer();
        $rootDir = $container->get('kernel')->getRootDir();


        $file = sprintf(
            "%s/config/security.yml",
            $rootDir
        );
        $parsed = Yaml::parse(file_get_contents($file));


        /** Manipulations to remove role from security yml */
        if(in_array($objectRoleName,$parsed['security']['role_hierarchy']))
            unset($parsed['security']['role_hierarchy'][$objectRoleName]);


        foreach ($objectAdminPagesToAccess  as $accessPage){
            $pagePath = $accessPage->getPagePath();

            foreach ($parsed['security']['access_control'] as $key => $accessControlItem){

                if($accessControlItem['path'] == $pagePath){

                    foreach ($parsed['security']['access_control'][$key]['roles'] as $keyOfRole => $role){
                        if($role == $objectRoleName){
                            unset($parsed['security']['access_control'][$key]['roles'][$keyOfRole]);
                        }
                    }
                }
            }
        }

        /**
         * Rewrite in security yml
         */
        $modifiedFile = Yaml::dump($parsed);
        file_put_contents($rootDir.'/config/security.yml', $modifiedFile);

        /** Manipulations to remove role from security yml end */


        $em = $this->modelManager->getEntityManager("AppBundle:User");
        $qb = $em->createQueryBuilder();
        $roles = $qb
            ->select('u')
            ->from('AppBundle:User','u')
            ->where('u.roles like ?3')
            ->setParameter(3, '%'.$objectRoleName.'%')
            ->getQuery();
        $users = $roles->getResult();

        foreach ($users as $user){
            $user->removeRole($objectRoleName);
            $user->setRoleChange(1);
            $em->persist($user);
        }$em->flush();

    }


    /**
     * @param mixed $object
     * @return bool|JsonResponse|void
     */
    public function preUpdate($object){
        $objectRoleName            = $object->getRoleName();
        $objectOldName             = $object->getOldName();
        $objectAdminPagesToAccess  = $object->getAdminPagesToAccess();

        $container = $this->getConfigurationPool()->getContainer();
        $rootDir = $container->get('kernel')->getRootDir();

        $file = sprintf(
            "%s/config/security.yml",
            $rootDir
        );
        $parsed = Yaml::parse(file_get_contents($file));

        /** Manipulations to remove role from security yml */
        if(in_array($objectOldName,$parsed['security']['role_hierarchy'])) {
            unset($parsed['security']['role_hierarchy'][$objectOldName]);
            $parsed['security']['role_hierarchy'][$objectRoleName] = $objectRoleName;
        }

        foreach ($objectAdminPagesToAccess  as $accessPage){
            $pagePath = $accessPage->getPagePath();

            foreach ($parsed['security']['access_control'] as $key => $accessControlItem){

                if($accessControlItem['path'] == $pagePath){

                    foreach ($parsed['security']['access_control'][$key]['roles'] as $keyOfRole => $role){
                        if($role == $objectOldName){
                            $parsed['security']['access_control'][$key]['roles'][$keyOfRole] = $objectRoleName;
                        }
                    }
                }
            }
        }

        /**
         * Rewrite in security yml
         */
        $modifiedFile = Yaml::dump($parsed);
        file_put_contents($rootDir.'/config/security.yml', $modifiedFile);

        /** Manipulations to remove role from security yml end */


        $em = $this->modelManager->getEntityManager("AppBundle:User");
        $qb = $em->createQueryBuilder();
        $roles = $qb
            ->select('u')
            ->from('AppBundle:User','u')
            ->where('u.roles like ?3')
            ->setParameter(3, '%'.$objectOldName.'%')
            ->getQuery();
        $users = $roles->getResult();

        foreach ($users as $user){
            $user->removeRole($objectOldName);
            $user->addRole($objectRoleName);
            $user->setRoleChange(1);
            $em->persist($user);
        }$em->flush();

        $object->setOldName($objectRoleName);
    }
}