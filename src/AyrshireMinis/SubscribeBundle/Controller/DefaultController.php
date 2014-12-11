<?php

/**
 * Controller for the Subscribe page
 *
 * @author Craig R Morton <crmpicco@aol.co.uk>
 * @date   11-Dec-2014
 */

namespace AyrshireMinis\SubscribeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AyrshireMinisSubscribeBundle:Default:index.html.twig');
    }

}
