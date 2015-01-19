<?php

/**
 * Common bundle controller to handle homepage, about page and links page
 *
 * @author Craig R Morton <crmpicco@aol.co.uk>
 * @date   19-Jan-2015
 */

namespace AyrshireMinis\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    /**
     * Homepage
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        // catch legacy newsletter unsubscribe requests and redirect them to the homepage for the time being
        if (strpos($_SERVER['REQUEST_URI'], 'newsunsub.php')) {
            return $this->redirect($this->generateUrl('ayrshireminis_common_default_index'), 301);
        }

        return $this->render('AyrshireMinisCommonBundle:Default:index.html.twig');
    }

    /**
     * About page
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function aboutAction()
    {
        // catch legacy forum (PHPBB2) requests and redirect them to the about page for the time being
        if (strpos($_SERVER['REQUEST_URI'], 'phpBB2')) {
            return $this->redirect($this->generateUrl('ayrshireminis_about'), 301);
        }

        return $this->render('AyrshireMinisCommonBundle:Default:about.html.twig');
    }

    /**
     * Get all the links and display them on the /links page
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function linksAction()
    {
        // catch legacy links.php requests and redirect them to the new links page at /links
        if (strpos($_SERVER['REQUEST_URI'], 'links.php')) {
            return $this->redirect($this->generateUrl('ayrshireminis_links'), 301);
        }

        $links = $this->getDoctrine()->getRepository('AyrshireMinisCommonBundle:Link')->findAll();

        return $this->render('AyrshireMinisCommonBundle:Default:links.html.twig', array('links' => $links));
    }
}
