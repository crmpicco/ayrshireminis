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

    }

    /**
     * @Template("AyrshireMinisGalleryBundle:Default:add.html.twig")
     */
    public function submitAction()
    {
        // Create a new GalleryImage entity instance
        $gallery_image = new GalleryImage();
        $form          = $this->createForm(new GalleryImageType(), $gallery_image);
        // Bind the posted data to the form
        $form->bind($this->getRequest());
        // Make sure the form is valid before we persist the image
        if ($form->isValid()) {
            // Get the entity manager and persist the contact
            $em = $this->getDoctrine()->getManager();

            $gallery_image->upload();

            $em->persist($gallery_image);
            $em->flush();



            // Redirect the user and add a thank you flash message
            // The string 'GalleryThanksMessage' can now be overwritten by a translation
            $message = $this->get('translator')->trans('GalleryThanksMessage');
            $this->get('session')->getFlashBag()->set('gallery_thanks', array('message' => $message));

            return $this->redirect($this->generateUrl("ayrshireminis_gallery_submit"));
        }

        return array(
            'form' => $form->createView()
        );
    }
}
