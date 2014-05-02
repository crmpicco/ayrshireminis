<?php

namespace AyrshireMinis\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/about", name="ayrshireminis_about")
     * @Template()
     */
    public function aboutAction()
    {
        //use the createForm method to get a symfony form instance of our form
//        $form = $this->createForm(new ContactType());

        return array(
            //pass the form to our template, must be a form view using ->createView()
//            'form' => $form->createView()
        );
    }

}
