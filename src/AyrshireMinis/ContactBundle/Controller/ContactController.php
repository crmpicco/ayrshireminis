<?php

/**
 * Main controller for the Contact page
 *
 * @author Craig R Morton <crmpicco@aol.co.uk>
 * @date   16-01-2015
 */

namespace AyrshireMinis\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Session\Session,
    AyrshireMinis\ContactBundle\Form\ContactType,
    AyrshireMinis\ContactBundle\Entity\Contact;


class ContactController extends Controller
{

    const CONTACT_EMAIL = 'ayrshireminis@gmail.com';

    public function indexAction()
    {
        // catch legacy contact.php requests and redirect them to the new contact page at /contact
        if (strpos($_SERVER['REQUEST_URI'], 'contact.php')) {
            return $this->redirect($this->generateUrl('ayrshireminis_contact'), 301);
        }

        // use the createForm method to get a symfony form instance of our form
        $form = $this->createForm(new ContactType());

        return $this->render('AyrshireMinisContactBundle:Contact:index.html.twig', array('form' => $form->createView()));
    }

    public function submitAction()
    {
        //Create a new contact entity instance
        $contact = new Contact();
        $form    = $this->createForm(new ContactType(), $contact);
        //Bind the posted data to the form
        $form->bind($this->getRequest());
        //Make sure the form is valid before we persist the contact
        if ($form->isValid()) {
            //Get the entity manager and persist the contact
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            // send an email to the contact email admin account
            $this->sendContactEmail($contact);

            //Redirect the user and add a thank you flash message
            //The string 'ContactThanksMessage' can now be overwritten by a translation
            $message = $this->get('translator')->trans('ContactThanksMessage');
            $this->get('session')->getFlashBag()->set('contact_thanks', array('message' => $message));

            return $this->redirect($this->generateUrl("ayrshireminis_contact"));
        }

        return $this->render('AyrshireMinisContactBundle:Contact:index.html.twig', array('form' => $form->createView()));
    }

    /**
     * send contact email
     *
     * @param Contact $contact
     */
    private function sendContactEmail(Contact $contact)
    {
        $mailer = $this->get('mailer');
        $message = $mailer->createMessage()
            ->setSubject('Contact Enquiry')
            ->setFrom($contact->getEmail())
            ->setTo(self::CONTACT_EMAIL)
            ->setBody(
                $contact->getMessage()
            )
        ;
        $mailer->send($message);
    }
}
