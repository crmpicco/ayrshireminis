<?php

/**
 * Gallery Image admin class for Sonata Admin
 *
 * @author Craig R Morton <crmpicco@aol.co.uk>
 * @date   09-Dec-2014
 */

namespace AyrshireMinis\GalleryBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Route\RouteCollection;


class GalleryAdmin extends Admin
{

    /**
     * Fields to be shown on create/edit forms
     *
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'entity', array('class' => 'AyrshireMinis\GalleryBundle\Entity\GalleryImage'))
            ->add('body') // if no type is specified, SonataAdminBundle tries to guess it
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
            ->add('approved')
            ->add('title')
            ->add('category')
            ->add('description')
            ->add('ipAddress')
            ->add('dateUploaded');

    }

    /**
     * Fields to be shown on lists
     *
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('approved')
            ->add('title')
            ->add('category')
            ->add('description')
            ->add('ipAddress')
            ->add('dateUploaded');

        $listMapper->add('_action', 'actions', array(
            'actions' => array(
                'approve' => array('template' => 'AyrshireMinisGalleryBundle:Default:approve.html.twig')
            )
        ));
    }

    /**
     * Add new routes (/approve and /reject)
     *
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $id = $this->getRouterIdParameter();
        $collection->add('approve',  $id . '/approve');
        $collection->add('reject', $id . '/reject');
    }

}