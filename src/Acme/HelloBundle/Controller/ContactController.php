<?php
// src/Acme/HelloBundle/Controller/HelloController.php
namespace Acme\HelloBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class ContactController
{
    public function indexAction()
    {
        return new Response('<html><body>Contact Yoself</body></html>');
    }
}