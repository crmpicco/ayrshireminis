<?php

/**
 * CRUD controller for approving the image
 *
 * @author Craig R Morton <crmpicco@aol.co.uk>
 * @date   09-Dec-2014
 */

namespace AyrshireMinis\GalleryBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Sonata\AdminBundle\Controller\CRUDController as Controller,
    Symfony\Component\HttpFoundation\RedirectResponse;


class CRUDController extends Controller
{
    /**
     * approve the image by marking it as approved in the DB
     *
     * @return RedirectResponse
     */
    public function approveAction()
    {
        // work out which image we are approving based on the ID in the URL
        $id = $this->get('request')->get($this->admin->getIdParameter());

        $object = $this->admin->getObject($id);

        // couldn't find the object
        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        // set it as approved
        $object->setApproved(1);

        // Get the entity manager and persist the image
        $em = $this->getDoctrine()->getManager();
        $em->persist($object);
        $em->flush();

        // add a flash message at the top to show it's approved
        $this->addFlash('sonata_flash_success', 'Approved!');

        // redirect back to the list view
        return new RedirectResponse($this->admin->generateUrl('list'));
    }
}