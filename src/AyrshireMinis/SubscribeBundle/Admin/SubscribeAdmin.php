<?php

/**
 * Sonata Admin class for user subscriptions
 *
 * @author Craig R Morton <crmpicco@aol.co.uk>
 * @date   23-Dec-2014
 */

namespace AyrshireMinis\SubscribeBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;


class SubscribeAdmin extends Admin
{

    /**
     * default sorting options for the view (show the most recent signup first)
     *
     * @var array
     */
    protected $datagridValues = array(
        '_sort_order' => 'DESC',
        '_sort_by'    => 'joinedOn',
    );

    /**
     * Fields to be shown on create/edit forms
     *
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'entity', array('class' => 'AyrshireMinis\SubscribeBundle\Entity\User'))
            ->add('body') //if no type is specified, SonataAdminBundle tries to guess it
        ;
    }

    /**
     * Fields to be shown on filter forms
     *
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('email')
            ->add('joinedOn');
    }

    /**
     * Fields to be shown on lists
     *
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('email')
            ->add('joinedOn');
    }
}