<?php

namespace AyrshireMinis\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AyrshireMinisGalleryBundle:Default:index.html.twig');
    }

    public function addAction()
    {
        return $this->render('AyrshireMinisGalleryBundle:Default:index.html.twig');
    }
}
