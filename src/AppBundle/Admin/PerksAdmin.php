<?php
/**
 * Created by PhpStorm.
 * User: Matas
 * Date: 2017.05.25
 * Time: 12:27
 */

namespace AppBundle\Admin;

use AppBundle\Entity\Perks;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PerksAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', 'text');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name');
    }

    public function toString($object)
    {
        return $object instanceof Perks
            ? $object->getName()
            : 'perks'; // shown in the breadcrumb on the create view
    }
}