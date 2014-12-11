<?php

/**
 * Controller for the Subscribe page
 *
 * @author Craig R Morton <crmpicco@aol.co.uk>
 * @date   11-Dec-2014
 */

namespace AyrshireMinis\SubscribeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    AyrshireMinis\SubscribeBundle\Entity\User,
    Symfony\Component\Validator\Constraints\Email as EmailConstraint;


class DefaultController extends Controller
{
    /**
     * @TODO make an AJAX call to here and return a valid response
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        // pull the email address out the POST variable
        $email = $this->get('request')->request->get('email');

        // validate the email address
        $emailConstraint = new EmailConstraint();
        $emailConstraint->message = 'Please check your email address';

        $errors = $this->get('validator')->validateValue($email, $emailConstraint);
        
        if (count($errors) == 0) {
            // create a new user
            $user = new User();
            $user->setEmail($email);
            $user->setJoinedOn(new \DateTime());
            $user->setUnsubscribed(0);

            // get the entity manager and persist the user
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }


        return $this->render('AyrshireMinisSubscribeBundle:Default:index.html.twig');
    }

}
