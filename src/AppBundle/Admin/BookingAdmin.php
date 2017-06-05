<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use AppBundle\Entity\BookingRequest;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Sonata\BlockBundle\Block\Service\AbstractBlockService;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;


class BookingAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Rezervacija', array('class' => 'col-md-12'))
            ->add('start', 'datetime', ['label' => 'Nuo', 'format' => 'm/d/Y'])
            ->add('end', 'datetime', ['label' => 'Iki', 'format' => 'm/d/Y'])
            ->add('item',  'sonata_type_model', array(
                'class' => 'AppBundle\Entity\Sodyba',
                'property' => 'title',
            ))
            ->end()
        ;


    }


    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('user')
            ->add('start', 'date', ['label' => 'Nuo', 'format' => 'm/d/Y'])
            ->add('end', 'date', ['label' => 'Iki', 'format' => 'm/d/Y'])
            ->add('item')
            ->add('_action', null, array(
                    'actions' => array(
//                    'show' => array(),
                        'delete' => array(),
                        'edit' => array(),
                    ))
            )
        ;
    }

    public function toString($object)
    {
        return $object instanceof BookingRequest
            ? $object->getUser()
            : 'Rezervacija'; // shown in the breadcrumb on the create view
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
    }


}