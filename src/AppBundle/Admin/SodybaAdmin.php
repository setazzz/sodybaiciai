<?php
/**
 * Created by PhpStorm.
 * User: Matas
 * Date: 2017.05.23
 * Time: 12:53
 */

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use AppBundle\Entity\Sodyba;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class SodybaAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
//        $formMapper
//            ->add('title', 'text')
//            ->add('body', 'textarea')
//            ->add('category', 'sonata_type_model', array(
//                'class' => 'AppBundle\Entity\Category',
//                'property' => 'name',
//            ))
//        ;
        $formMapper
            ->with('Content', array('class' => 'col-md-9'))
                ->add('title', 'text')
                ->add('body', 'textarea')
            ->end()

            ->with('Meta data', array('class' => 'col-md-3'))
                ->add('category', 'sonata_type_model', array(
                    'class' => 'AppBundle\Entity\Category',
                    'property' => 'name',
            ))
            ->end()
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('category.name')
            ->add('draft')
        ;
    }

    public function toString($object)
    {
        return $object instanceof Sodyba
            ? $object->getTitle()
            : 'Blog Post'; // shown in the breadcrumb on the create view
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('category', null, array(), 'entity', array(
                'class'    => 'AppBundle\Entity\Category',
                'choice_label' => 'name', // In Symfony2: 'property' => 'name'
            ));
    }


}