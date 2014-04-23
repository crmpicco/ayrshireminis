<?php

namespace AyrshireMinis\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use AyrshireMinis\ContactBundle\Form\ContactType,
    AyrshireMinis\ContactBundle\Entity\Contact;


class ContactController extends Controller
{
    /**
     * @Route("/contact", name="ayrshireminis_contact")
     * @Template()
     */
    public function indexAction()
    {
        //use the createForm method to get a symfony form instance of our form
        $form = $this->createForm(new ContactType());

        return array(
            //pass the form to our template, must be a form view using ->createView()
            'form' => $form->createView()
        );
    }


    /**
     * @Route("/contact/submit", name="ayrshireminis_submit_contact")
     * @Method("POST")
     * @Template("AyrshireMinisContactBundle:Contact:index.html.twig")
     */
    public function submitAction()
    {
        //Create a new contact entity instance
        $contact = new Contact();
        $form = $this->createForm(new ContactType(), $contact);
        //Bind the posted data to the form
        $form->bind($this->getRequest());
        //Make sure the form is valid before we persist the contact
        if($form->isValid()){
            //Get the entity manager and persist the contact
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
            //Redirect the user and add a thank you flash message
            //The string 'ContactThanksMessage' can now be overwritten by a translation
            $message = $this->get('translator')->trans('ContactThanksMessage');
            //$this->get("session")->setFlash('contact_thanks', $message);

            return $this->redirect($this->generateUrl("ayrshireminis_contact"));
        }

        return array(
            'form' => $form->createView()
        );
    }
}
