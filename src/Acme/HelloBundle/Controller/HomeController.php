<?php
// src/Acme/HelloBundle/Controller/HelloController.php
namespace Acme\HelloBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    public function indexAction()
    {
        return new Response('<html><body>Good morning!</body></html>');
    }
}