<?php

namespace AyrshireMinis\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\Session\Session;

use AyrshireMinis\GalleryBundle\Form\GalleryImageType,
    AyrshireMinis\GalleryBundle\Entity\GalleryImage;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AyrshireMinisGalleryBundle:Default:index.html.twig');
    }

    /**
     * @Template("AyrshireMinisGalleryBundle:Default:add.html.twig")
     */
    public function addAction()
    {
        //use the createForm method to get a symfony form instance of our form
        $form = $this->createForm(new GalleryImageType());

        return array(
            //pass the form to our template, must be a form view using ->createView()
            'form' => $form->createView()
        );

        //return $this->render('AyrshireMinisGalleryBundle:Default:add.html.twig');
    }
}
