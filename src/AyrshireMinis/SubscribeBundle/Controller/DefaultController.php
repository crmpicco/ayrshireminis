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
    Symfony\Component\Validator\Constraints\Email as EmailConstraint,
    Symfony\Component\HttpFoundation\JsonResponse,
    Symfony\Component\HttpFoundation\Session\Session;


class DefaultController extends Controller
{
    /**
     * @TODO make an AJAX call to here and return a valid response
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {

        $request = $this->get('request');

        // ensure the request is an AJAX request
        if ($request->isXMLHttpRequest()) {

            // pull the email address out the POST variable
            $email = $request->request->get('email');

            // validate the email address
            $emailConstraint          = new EmailConstraint();
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

                $this->get('session')->getFlashBag()->set('subscribe_thanks', array('message' => 'Thank you for joining.'));

                return new JsonResponse(array('data' => array('success' => true, 'msg' => 'Thank you for joining.')));
            } else {
                return new JsonResponse(array('data' => array('success' => false, 'msg' => 'There were validation errors')));
            }

        } else {
            return new JsonResponse(array('data' => array('success' => false, 'msg' => 'The request was not a AJAX request.')));
        }

    }

}
