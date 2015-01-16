<?php

/**
 * Main controller for the Gallery Bundle
 *
 * @author Craig R Morton <crmpicco@aol.co.uk>
 * @date   21-Nov-2014
 */

namespace AyrshireMinis\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Session\Session,
    AyrshireMinis\GalleryBundle\Form\GalleryImageType,
    AyrshireMinis\GalleryBundle\Entity\GalleryImage;


class DefaultController extends Controller
{
    /**
     * default view for the /gallery page - only show approved images
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        // catch legacy galleries.php requests and redirect them to the new gallery homepage at /gallery
        if (strpos($_SERVER['REQUEST_URI'], 'galleries.php')) {
            return $this->redirect($this->generateUrl('ayrshireminis_gallery_homepage'), 301);
        }

        return $this->render('AyrshireMinisGalleryBundle:Default:index.html.twig', array('images' => $this->getApprovedImages()));
    }

    /**
     * get approved images only
     *
     * @return array
     */
    private function getApprovedImages()
    {
        return $this->getDoctrine()->getRepository('AyrshireMinisGalleryBundle:GalleryImage')->findBy(array('approved' => 1));
    }

    /**
     * @Template("AyrshireMinisGalleryBundle:Default:add.html.twig")
     */
    public function addAction()
    {
        // catch legacy addmini.php requests and redirect them to the new gallery add page at /gallery/add
        if (strpos($_SERVER['REQUEST_URI'], 'addmini.php')) {
            return $this->redirect($this->generateUrl('ayrshireminis_gallery_add'), 301);
        }

        // use the createForm method to get a symfony form instance of our form
        $form = $this->createForm(new GalleryImageType());

        return array(
            // pass the form to our template, must be a form view using ->createView()
            'form' => $form->createView()
        );

    }

    /**
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
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

            $em->persist($gallery_image);
            $em->flush();

            $gallery_image->upload();

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
