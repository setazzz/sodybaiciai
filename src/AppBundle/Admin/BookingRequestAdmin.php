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


class BookingRequestAdmin extends AbstractAdmin
{
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('confirm', $this->getRouterIdParameter().'/confirm');
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Rezervacija', array('class' => 'col-md-12'))
            ->add('start', 'sonata_type_datetime_picker', array('horizontal_input_wrapper_class' => 'start-field'))
            ->add('end', 'sonata_type_datetime_picker')
            ->add('item',  'sonata_type_model', array(
                'class' => 'AppBundle\Entity\Sodyba',
                'property' => 'title',
            ))
            ->end();


    }


    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('user')
            ->add('start', 'datetime', ['label' => 'Nuo', 'format' => 'Y-m-d'])
            ->add('end', 'datetime', ['label' => 'Iki', 'format' => 'Y-m-d'])
            ->add('item')
            ->add('confirmed')
            ->add('_action', null, array(
                'actions' => array(
                    'delete' => array(),
                    'edit' => array(),
                    'confirm' => array(
                        'template' => 'CRUD/confirm_booking_request.html.twig'
                    )
                ))
            )
        ;
    }

    public function toString($object)
    {
        return $object instanceof BookingRequest
            ? $object->getUser()
            : 'Užklausa'; // shown in the breadcrumb on the create view
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
//        $datagridMapper
//            ->add('title')
//            ->add('category', null, array(), 'entity', array(
//                'class'    => 'AppBundle\Entity\Category',
//                'choice_label' => 'name', // In Symfony2: 'property' => 'name'
//            ));
    }


}