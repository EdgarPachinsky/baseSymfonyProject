<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/4/2017
 * Time: 2:13 PM
 */

namespace AppBundle\Admin;

use AppBundle\Entity\Page;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use ToolBox\FileBrowserBundle\Form\Type\FileBrowserType;

class PageAdmin extends AbstractAdmin
{
    public function toString($object)
    {
        return $object instanceof Page
            ? $object->getPageTitle()
            : 'Page'; // shown in the breadcrumb on the create view
    }

    public $tbOptions = array(
        'multiple' => false,
        'image_directory' => '/images/page',
        'thumbWidth' => 1920,
        'thumbHeight' => 1200,
        'cropOptions' => array(
            0 => array(
                'og' => array(
                    "title" => "Open Graph (facebook)",
                    "type" => "pixel",
                    "width" => 1200,
                    "height" => 630
                ),
                'thumb' => array(
                    "title" => "Thumbnail",
                    "type" => "pixel",
                    "width" => 1920,
                    "height" => 1200
                )
            ),
            1 => array(
                'history' => array(
                    "title" => "About us image size",
                    "type" => "pixel",
                    "width" => 480,
                    "height" => 349
                ),
            )
        )
    );

    public function configure()
    {
        parent::configure();
        $this->setTemplate('edit', 'SonataAdminBundle:CRUD:tb_file_browser_edit.html.twig');
    }


    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('pageTitle')
            ->add('pageText', CKEditorType::class)
            ->add('pageMetaKeywords', 'text')
            ->add('pageMetaDescription', 'text')
            ->add('pageOgImage', FileBrowserType::class, array(
                'options' => array(
                    'multiple' => false
                )
            ))
        ;

    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper

            ->add('pageTitle')
            ->add('pageMetaKeywords')
            ->add('pageMetaDescription')
            ->add('advantageGroup.advantage_group_title',null, array('label' => 'Advantage Group Title'))
            ->add('_action', null, array(
                'actions' => array(
                    'edit' => array(),
                )
            ));
    }

    protected function configureRoutes(RouteCollection $collection)
    {
       // $collection->remove('create');
        $collection->remove('delete');
        $collection->remove('show');
    }

    protected $datagridValues = array(
        '_sort_order' => 'ASC',
        '_sort_by' => 'pageTitle'
    );

}